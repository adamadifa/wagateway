    <!-- Sidebar -->
    <aside
        class="sidebar fixed inset-y-0 left-0 z-50 w-64 bg-dark-blue-900 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:static lg:inset-0">
        <div class="flex items-center justify-between h-16 px-6 bg-dark-blue-800 border-b border-dark-blue-700">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/images/logo-icon.png') }}" class="w-8 h-8" alt="logo icon">
                <h4 class="text-white font-semibold text-lg">My Gateway</h4>
            </div>
            <button class="lg:hidden text-white hover:text-gray-300">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="mt-6 px-4">
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->is('home') ? 'bg-dark-blue-700 text-white' : '' }}">
                        <i class="bi bi-house-fill w-5 h-5 mr-3"></i>
                        <span class="font-medium">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <!-- File Manager -->
                <li>
                    <a href="{{ route('file-manager') }}"
                        class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->is('file-manager') ? 'bg-dark-blue-700 text-white' : '' }}">
                        <i class="bi bi-file-earmark-fill w-5 h-5 mr-3"></i>
                        <span class="font-medium">{{ __('File Manager') }}</span>
                    </a>
                </li>

                <!-- Phone Book -->
                <li>
                    <a href="{{ route('phonebook') }}"
                        class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->is('phonebook') ? 'bg-dark-blue-700 text-white' : '' }}">
                        <i class="bi bi-telephone-fill w-5 h-5 mr-3"></i>
                        <span class="font-medium">{{ __('Phone Book') }}</span>
                    </a>
                </li>
                <!-- Reports Dropdown -->
                <li>
                    <button
                        class="flex items-center justify-between w-full px-4 py-3 text-gray-300 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-colors duration-200"
                        onclick="toggleDropdown('reports')">
                        <div class="flex items-center">
                            <i class="bi bi-file-earmark-bar-graph-fill w-5 h-5 mr-3"></i>
                            <span class="font-medium">{{ __('Reports') }}</span>
                        </div>
                        <i class="bi bi-chevron-down transition-transform duration-200" id="reports-arrow"></i>
                    </button>
                    <ul class="mt-2 space-y-1 ml-6 hidden" id="reports-dropdown">
                        <li>
                            <a href="{{ route('campaigns') }}"
                                class="flex items-center px-3 py-2.5 text-gray-400 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-all duration-200 {{ request()->is('campaigns') ? 'bg-dark-blue-700 text-white border-l-2 border-blue-400' : '' }}">
                                <i class="bi bi-broadcast w-4 h-4 mr-3"></i>
                                <span class="text-sm font-medium">{{ __('Campaign / Blast') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('messages.history') }}"
                                class="flex items-center px-3 py-2.5 text-gray-400 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-all duration-200 {{ request()->is('messages.history') ? 'bg-dark-blue-700 text-white border-l-2 border-blue-400' : '' }}">
                                <i class="bi bi-chat-left-text w-4 h-4 mr-3"></i>
                                <span class="text-sm font-medium">{{ __('Messages History') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Device Selector -->
                <x-select-device></x-select-device>

                <!-- Conditional Menus (only show if device selected) -->
                @if (Session::has('selectedDevice'))
                    <!-- Plugins -->
                    <li>
                        <a href="{{ route('plugins') }}"
                            class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->is('plugins') ? 'bg-dark-blue-700 text-white' : '' }}">
                            <i class="bi bi-plug-fill w-5 h-5 mr-3"></i>
                            <span class="font-medium">{{ __('Plugins') }}</span>
                        </a>
                    </li>

                    <!-- Auto Reply -->
                    <li>
                        <a href="{{ route('autoreply') }}"
                            class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->is('autoreply') ? 'bg-dark-blue-700 text-white' : '' }}">
                            <i class="bi bi-chat-left-dots-fill w-5 h-5 mr-3"></i>
                            <span class="font-medium">{{ __('Auto Reply') }}</span>
                        </a>
                    </li>

                    <!-- Create Campaign -->
                    <li>
                        <a href="{{ route('campaign.create') }}"
                            class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-colors duration-200 {{ url()->current() == route('campaign.create') ? 'bg-dark-blue-700 text-white' : '' }}">
                            <i class="bi bi-plus-circle-fill w-5 h-5 mr-3"></i>
                            <span class="font-medium">{{ __('Create Campaign') }}</span>
                        </a>
                    </li>

                    <!-- Test Message -->
                    <li>
                        <a href="{{ route('messagetest') }}"
                            class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-colors duration-200 {{ url()->current() == route('messagetest') ? 'bg-dark-blue-700 text-white' : '' }}">
                            <i class="bi bi-chat-left-dots-fill w-5 h-5 mr-3"></i>
                            <span class="font-medium">{{ __('Test Message') }}</span>
                        </a>
                    </li>
                @endif

                {{-- Api Documentation --}}

                <!-- API Documentation -->
                <li>
                    <a href="{{ route('rest-api') }}"
                        class="flex items-center px-4 py-3 text-gray-300 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-colors duration-200 {{ url()->current() == route('rest-api') ? 'bg-dark-blue-700 text-white' : '' }}">
                        <i class="bi bi-code-square w-5 h-5 mr-3"></i>
                        <span class="font-medium">{{ __('API Docs') }}</span>
                    </a>
                </li>
                {{-- end api documentation --}}

                <!-- Admin Menu (only for admin users) -->
                @if (Auth::user()->level == 'admin')
                    <li>
                        <button
                            class="flex items-center justify-between w-full px-4 py-3 text-gray-300 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-colors duration-200"
                            onclick="toggleDropdown('admin')">
                            <div class="flex items-center">
                                <i class="bi bi-person-lines-fill w-5 h-5 mr-3"></i>
                                <span class="font-medium">{{ __('Admin') }}</span>
                            </div>
                            <i class="bi bi-chevron-down transition-transform duration-200" id="admin-arrow"></i>
                        </button>
                        <ul class="mt-2 space-y-1 ml-6 hidden" id="admin-dropdown">
                            <li>
                                <a href="{{ route('admin.settings') }}"
                                    class="flex items-center px-3 py-2.5 text-gray-400 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-all duration-200 {{ request()->is('admin.settings') ? 'bg-dark-blue-700 text-white border-l-2 border-blue-400' : '' }}">
                                    <i class="bi bi-gear w-4 h-4 mr-3"></i>
                                    <span class="text-sm font-medium">{{ __('Setting Server') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('update') }}"
                                    class="flex items-center px-3 py-2.5 text-gray-400 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-all duration-200 {{ request()->is('update') ? 'bg-dark-blue-700 text-white border-l-2 border-blue-400' : '' }}">
                                    <i class="bi bi-arrow-up-circle w-4 h-4 mr-3"></i>
                                    <span class="text-sm font-medium">{{ __('Update') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.manage-users') }}"
                                    class="flex items-center px-3 py-2.5 text-gray-400 hover:bg-dark-blue-800 hover:text-white rounded-lg transition-all duration-200 {{ request()->is('admin.manage-users') ? 'bg-dark-blue-700 text-white border-l-2 border-blue-400' : '' }}">
                                    <i class="bi bi-people w-4 h-4 mr-3"></i>
                                    <span class="text-sm font-medium">{{ __('Manage User') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


                {{-- <li class="menu-label">UI Elements</li> --}}



            </ul>
        </nav>
    </aside>

    <!-- Dropdown Toggle Script -->
    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId + '-dropdown');
            const arrow = document.getElementById(dropdownId + '-arrow');

            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                arrow.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
            }
        }
    </script>
