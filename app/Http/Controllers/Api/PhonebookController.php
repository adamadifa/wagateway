<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Tag;
use App\Services\WhatsappService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class PhonebookController extends Controller
{
    protected $wa;

    public function __construct(WhatsappService $whatsappService)
    {
        $this->wa = $whatsappService;
    }

    /**
     * Fetch groups from device and return as API response
     */
    public function fetchGroups(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'number' => 'required|string',
                'api_key' => 'required|string'
            ]);

            // Get user by API key
            $user = Cache::remember('user_by_api_key_' . $request->api_key, 60 * 60 * 12, function () use ($request) {
                return User::where('api_key', $request->api_key)->first();
            });

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid API key'
                ], 401);
            }

            // Check if device belongs to user
            $device = Device::where('body', $request->number)
                ->where('user_id', $user->id)
                ->first();

            if (!$device) {
                return response()->json([
                    'status' => false,
                    'message' => 'Device not found or not authorized'
                ], 404);
            }

            // Check device status
            if ($device->status != 'Connected') {
                return response()->json([
                    'status' => false,
                    'message' => 'Device is not connected'
                ], 400);
            }

            // Fetch groups with cache
            $response = Cache::remember('groups_' . $device->body, 60, function () use ($device) {
                return $this->wa->fetchGroups($device);
            });

            if ($response->status === false) {
                return response()->json([
                    'status' => false,
                    'message' => $response->message
                ], 400);
            }

            if (count($response->data) < 1) {
                Cache::forget('groups_' . $device->body);
                return response()->json([
                    'status' => false,
                    'message' => 'No groups found, try again in a few minutes'
                ], 404);
            }

            // Process groups and save to database
            $savedGroups = [];
            foreach ($response->data as $group) {
                $namePhoneBook = $group->subject . ' (ID: ' . $group->id . ')';
                $validNamePhoneBook = preg_replace('/[^a-zA-Z0-9():\s@.-]+/', '', $namePhoneBook);

                $tag = $user->phonebooks()->firstOrCreate(['name' => $validNamePhoneBook]);

                $contacts = [];
                foreach ($group->participants as $member) {
                    $memberId = $member->phoneNumber ?? $member->id;
                    $number = str_replace('@s.whatsapp.net', '', $memberId);

                    $existingContact = $user->contacts()
                        ->where('tag_id', $tag->id)
                        ->where('number', $number)
                        ->first();

                    if (!$existingContact) {
                        $contact = $tag->contacts()->create([
                            'user_id' => $user->id,
                            'name' => $number,
                            'number' => $number
                        ]);
                        $contacts[] = $contact;
                    } else {
                        $contacts[] = $existingContact;
                    }
                }

                $savedGroups[] = [
                    'group_id' => $group->id,
                    'group_name' => $group->subject,
                    'tag_id' => $tag->id,
                    'tag_name' => $tag->name,
                    'participants_count' => count($group->participants),
                    'contacts' => $contacts
                ];
            }

            return response()->json([
                'status' => true,
                'message' => 'Groups fetched successfully',
                'data' => [
                    'groups' => $savedGroups,
                    'total_groups' => count($savedGroups),
                    'device_number' => $device->body,
                    'device_name' => $device->body
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $th->getMessage()
            ], 500);
        }
    }

    /**
     * Get phonebook data
     */
    public function getPhonebook(Request $request)
    {
        try {
            $request->validate([
                'api_key' => 'required|string'
            ]);

            // Get user by API key
            $user = Cache::remember('user_by_api_key_' . $request->api_key, 60 * 60 * 12, function () use ($request) {
                return User::where('api_key', $request->api_key)->first();
            });

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid API key'
                ], 401);
            }

            $phonebooks = $user->phonebooks()
                ->with(['contacts' => function ($query) {
                    $query->select('id', 'tag_id', 'name', 'number', 'created_at');
                }])
                ->when($request->search, function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->latest()
                ->paginate($request->per_page ?? 15);

            return response()->json([
                'status' => true,
                'message' => 'Phonebook data retrieved successfully',
                'data' => [
                    'phonebooks' => $phonebooks->items(),
                    'pagination' => [
                        'current_page' => $phonebooks->currentPage(),
                        'last_page' => $phonebooks->lastPage(),
                        'per_page' => $phonebooks->perPage(),
                        'total' => $phonebooks->total(),
                        'from' => $phonebooks->firstItem(),
                        'to' => $phonebooks->lastItem()
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $th->getMessage()
            ], 500);
        }
    }

    /**
     * Clear all phonebook data
     */
    public function clearPhonebook(Request $request)
    {
        try {
            $request->validate([
                'api_key' => 'required|string'
            ]);

            // Get user by API key
            $user = Cache::remember('user_by_api_key_' . $request->api_key, 60 * 60 * 12, function () use ($request) {
                return User::where('api_key', $request->api_key)->first();
            });

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid API key'
                ], 401);
            }

            $deletedGroups = $user->phonebooks()->count();
            $deletedContacts = $user->phonebooks()->withCount('contacts')->get()->sum('contacts_count');

            $user->phonebooks()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Phonebook cleared successfully',
                'data' => [
                    'deleted_groups' => $deletedGroups,
                    'deleted_contacts' => $deletedContacts
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $th->getMessage()
            ], 500);
        }
    }

    /**
     * Get specific group contacts
     */
    public function getGroupContacts(Request $request)
    {
        try {
            $request->validate([
                'group_id' => 'required|integer|exists:tags,id',
                'api_key' => 'required|string'
            ]);

            // Get user by API key
            $user = Cache::remember('user_by_api_key_' . $request->api_key, 60 * 60 * 12, function () use ($request) {
                return User::where('api_key', $request->api_key)->first();
            });

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid API key'
                ], 401);
            }

            $tag = $user->phonebooks()
                ->where('id', $request->group_id)
                ->with(['contacts' => function ($query) {
                    $query->select('id', 'tag_id', 'name', 'number', 'created_at');
                }])
                ->first();

            if (!$tag) {
                return response()->json([
                    'status' => false,
                    'message' => 'Group not found or not authorized'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Group contacts retrieved successfully',
                'data' => [
                    'group' => [
                        'id' => $tag->id,
                        'name' => $tag->name,
                        'created_at' => $tag->created_at
                    ],
                    'contacts' => $tag->contacts,
                    'total_contacts' => $tag->contacts->count()
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $th->getMessage()
            ], 500);
        }
    }
}
