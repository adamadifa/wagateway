<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UpdateSelectedDeviceSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Update selectedDevice session if it exists but doesn't have device_status
        if (Session::has('selectedDevice')) {
            $selectedDevice = Session::get('selectedDevice');
            if (!isset($selectedDevice['device_status'])) {
                // Get the device from database to get current status
                $device = $request->user()->devices()->whereId($selectedDevice['device_id'])->first();
                if ($device) {
                    Session::put('selectedDevice', [
                        'device_id' => $device->id,
                        'device_body' => $device->body,
                        'device_status' => $device->status ?? 'Unknown',
                    ]);
                } else {
                    // Device not found, clear session
                    Session::forget('selectedDevice');
                }
            }
        }

        return $next($request);
    }
}
