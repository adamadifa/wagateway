                               <li class="my-4">
                                   <div class="relative">
                                       <div class="flex items-center justify-between bg-dark-blue-800 hover:bg-dark-blue-700 rounded-lg px-4 py-3 cursor-pointer transition-colors duration-200 border border-dark-blue-600"
                                           onclick="toggleDeviceDropdown()">
                                           <div class="flex items-center">
                                               <i class="bi bi-phone text-gray-300 mr-3"></i>
                                               <span class="text-gray-300 font-medium" id="selected-device-text">
                                                   @if (Session::has('selectedDevice'))
                                                       @php
                                                           $selectedDevice = Session::get('selectedDevice');
                                                           $deviceBody =
                                                               $selectedDevice['device_body'] ?? 'Unknown Device';
                                                           $deviceStatus =
                                                               $selectedDevice['device_status'] ?? 'Unknown';
                                                       @endphp
                                                       {{ $deviceBody }} ({{ $deviceStatus }})
                                                   @else
                                                       Select Device
                                                   @endif
                                               </span>
                                           </div>
                                           <i class="bi bi-chevron-down text-gray-400 transition-transform duration-200"
                                               id="device-dropdown-icon"></i>
                                       </div>

                                       <!-- Dropdown Menu -->
                                       <div class="absolute top-full left-0 right-0 mt-1 bg-dark-blue-800 border border-dark-blue-600 rounded-lg shadow-lg z-50 hidden"
                                           id="device-dropdown">
                                           <div class="py-2">
                                               @foreach ($numbers as $device)
                                                   <div class="px-4 py-3 hover:bg-dark-blue-700 cursor-pointer transition-colors duration-200 flex items-center justify-between"
                                                       onclick="selectDevice('{{ $device->id }}', '{{ $device->body }}', '{{ $device->status }}')">
                                                       <div class="flex items-center">
                                                           <div
                                                               class="w-2 h-2 rounded-full mr-3 {{ $device->status == 'Connected' ? 'bg-green-400' : 'bg-red-400' }}">
                                                           </div>
                                                           <span class="text-gray-300">{{ $device->body }}</span>
                                                       </div>
                                                       <span
                                                           class="text-xs px-2 py-1 rounded-full {{ $device->status == 'Connected' ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' }}">
                                                           {{ $device->status }}
                                                       </span>
                                                   </div>
                                               @endforeach

                                               @if (count($numbers) == 0)
                                                   <div class="px-4 py-3 text-gray-400 text-center">
                                                       <i class="bi bi-exclamation-circle mr-2"></i>
                                                       No devices available
                                                   </div>
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </li>

                               <script>
                                   // Toggle device dropdown
                                   function toggleDeviceDropdown() {
                                       const dropdown = document.getElementById('device-dropdown');
                                       const icon = document.getElementById('device-dropdown-icon');

                                       if (dropdown.classList.contains('hidden')) {
                                           dropdown.classList.remove('hidden');
                                           icon.style.transform = 'rotate(180deg)';
                                       } else {
                                           dropdown.classList.add('hidden');
                                           icon.style.transform = 'rotate(0deg)';
                                       }
                                   }

                                   // Select device function
                                   function selectDevice(deviceId, deviceBody, deviceStatus) {
                                       // Update UI immediately
                                       document.getElementById('selected-device-text').textContent = `${deviceBody} (${deviceStatus})`;

                                       // Close dropdown
                                       document.getElementById('device-dropdown').classList.add('hidden');
                                       document.getElementById('device-dropdown-icon').style.transform = 'rotate(0deg)';

                                       // Make AJAX request
                                       $.ajax({
                                           url: "{{ route('home.setSessionSelectedDevice') }}",
                                           type: "POST",
                                           data: {
                                               _token: "{{ csrf_token() }}",
                                               device: deviceId
                                           },
                                           success: function(data) {
                                               if (data.error) {
                                                   showNotification('error', 'Error', data.msg);
                                                   setTimeout(function() {
                                                       location.reload();
                                                   }, 1000);
                                               } else {
                                                   showNotification('success', 'Success', data.msg);
                                                   setTimeout(function() {
                                                       location.reload();
                                                   }, 1000);
                                               }
                                           },
                                           error: function() {
                                               showNotification('error', 'Error', 'Something went wrong!');
                                           }
                                       });
                                   }

                                   // Close dropdown when clicking outside
                                   document.addEventListener('click', function(event) {
                                       const dropdown = document.getElementById('device-dropdown');
                                       const trigger = event.target.closest('[onclick="toggleDeviceDropdown()"]');

                                       if (!trigger && !dropdown.contains(event.target)) {
                                           dropdown.classList.add('hidden');
                                           document.getElementById('device-dropdown-icon').style.transform = 'rotate(0deg)';
                                       }
                                   });
                               </script>
