@if ($contacts->total() == 0)
    <div class="text-center py-12">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="bi bi-person text-2xl text-gray-400"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No Contacts Found</h3>
        <p class="text-gray-500 mb-4">This phonebook doesn't have any contacts yet</p>
        <button type="button" onclick="addContact()"
            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
            <i class="bi bi-person-plus mr-2"></i>
            Add Contact
        </button>
    </div>
@else
    <!-- Header -->
    <div class="bg-gray-50 rounded-lg p-4 mb-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <div class="flex items-center space-x-2">
                    <i class="bi bi-person text-gray-600"></i>
                    <span class="text-sm font-medium text-gray-700">Name</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="bi bi-whatsapp text-gray-600"></i>
                    <span class="text-sm font-medium text-gray-700">WhatsApp Number</span>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                Total: {{ $contacts->total() }} contacts
            </div>
        </div>
    </div>

    <!-- Contacts List -->
    <div class="space-y-3">
        @foreach ($contacts as $contact)
            <div id="contact-{{ $contact->id }}" class="contact-item">
                <div
                    class="bg-white rounded-lg border border-gray-200 hover:border-green-300 hover:shadow-md transition-all duration-200 group">
                    <div class="flex items-center justify-between p-4">
                        <!-- Contact Info -->
                        <div class="flex items-center space-x-3 flex-1">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center text-white font-semibold text-sm">
                                {{ strtoupper(substr($contact->name, 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4
                                    class="text-sm font-semibold text-gray-900 group-hover:text-green-600 transition-colors truncate">
                                    {{ $contact->name }}
                                </h4>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $contact->number }}
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center space-x-2">
                            <!-- WhatsApp Status Badge -->
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                <i class="bi bi-whatsapp mr-1"></i>
                                WhatsApp
                            </span>

                            <!-- Delete Button -->
                            <button onclick="deleteContact({{ $contact->id }})"
                                class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-200 group/delete"
                                title="Delete Contact">
                                <i class="bi bi-trash text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Additional Info (Hidden by default, shown on hover) -->
                    <div class="px-4 pb-3 border-t border-gray-100 group-hover:block hidden">
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span class="flex items-center">
                                <i class="bi bi-calendar mr-1"></i>
                                Added: {{ $contact->created_at ? $contact->created_at->format('M d, Y') : 'Unknown' }}
                            </span>
                            <span class="flex items-center">
                                <i class="bi bi-clock mr-1"></i>
                                Updated: {{ $contact->updated_at ? $contact->updated_at->diffForHumans() : 'Never' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Info -->
    @if ($contacts->hasPages())
        <div class="mt-6 text-center">
            <div class="inline-flex items-center space-x-2 text-sm text-gray-500">
                <span>Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of {{ $contacts->total() }}
                    contacts</span>
            </div>
        </div>
    @endif
@endif

<style>
    /* Contact Item Styling */
    .contact-item {
        position: relative;
    }

    .contact-item:hover .group-hover\:block {
        display: block !important;
    }

    /* Smooth transitions */
    .contact-item .bg-white {
        transition: all 0.2s ease-in-out;
    }

    .contact-item:hover .bg-white {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Delete button hover effect */
    .group\/delete:hover {
        background-color: #fef2f2;
        color: #dc2626;
    }

    /* Contact name hover effect */
    .contact-item:hover h4 {
        color: #16a34a !important;
    }

    /* Gradient background for avatar */
    .contact-item .bg-gradient-to-br {
        background-image: linear-gradient(135deg, #22c55e, #16a34a);
    }

    /* Custom scrollbar for contacts list */
    .contacts-list::-webkit-scrollbar {
        width: 4px;
    }

    .contacts-list::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 2px;
    }

    .contacts-list::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 2px;
    }

    .contacts-list::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* WhatsApp badge styling */
    .bg-green-100 {
        background-color: #dcfce7;
    }

    .text-green-700 {
        color: #15803d;
    }

    /* Header styling */
    .bg-gray-50 {
        background-color: #f9fafb;
    }
</style>
