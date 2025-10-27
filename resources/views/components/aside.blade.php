    <!--start sidebar -->
    <aside class="w-64 shadow-lg border-r flex flex-col h-full" style="background-color: #1E3A8A;">
        <!-- Sidebar Header -->
        <div class="p-6 border-b" style="border-color: #1E40AF;">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                    <i class="bi bi-whatsapp text-lg" style="color: #1E3A8A;"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white">{{ __('GATEWAY') }}</h2>
                    {{-- <p class="text-xs" style="color: #60A5FA;">v{{ config('app.version') }}</p> --}}
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-2 space-y-1 overflow-y-auto">
            <!-- Dashboard -->
            <a href="{{ route('home') }}"
                class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->is('home') ? 'text-white' : '' }}"
                style="color: #93C5FD;" onmouseover="this.style.backgroundColor='#1E40AF'; this.style.color='white';"
                onmouseout="this.style.backgroundColor=''; this.style.color='{{ request()->is('home') ? 'white' : '#93C5FD' }}';">
                <i class="bi bi-house text-lg mr-3"></i>
                <span class="font-medium">{{ __('Dashboard') }}</span>
            </a>

            <!-- File Manager -->
            <a href="{{ route('file-manager') }}"
                class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->is('file-manager') ? 'text-white' : '' }}"
                style="color: #93C5FD;" onmouseover="this.style.backgroundColor='#1E40AF'; this.style.color='white';"
                onmouseout="this.style.backgroundColor=''; this.style.color='{{ request()->is('file-manager') ? 'white' : '#93C5FD' }}';">
                <i class="bi bi-folder text-lg mr-3"></i>
                <span class="font-medium">{{ __('File Manager') }}</span>
            </a>

            <!-- Phone Book -->
            <a href="{{ route('phonebook') }}"
                class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->is('phonebook') ? 'text-white' : '' }}"
                style="color: #93C5FD;" onmouseover="this.style.backgroundColor='#1E40AF'; this.style.color='white';"
                onmouseout="this.style.backgroundColor=''; this.style.color='{{ request()->is('phonebook') ? 'white' : '#93C5FD' }}';">
                <i class="bi bi-telephone text-lg mr-3"></i>
                <span class="font-medium">{{ __('Phone Book') }}</span>
            </a>
            <!-- Reports Section -->
            <div class="space-y-1">
                <div class="flex items-center justify-between px-3 py-1 text-sm font-semibold uppercase tracking-wider cursor-pointer transition-colors duration-200"
                    style="color: #60A5FA;" onmouseover="this.style.color='white';" onmouseout="this.style.color='#60A5FA';"
                    onclick="toggleDropdown('reports-dropdown', 'reports-icon')">
                    <span>{{ __('Reports') }}</span>
                    <i class="bi bi-chevron-down text-xs transition-transform duration-200" id="reports-icon"></i>
                </div>
                <div class="space-y-1 hidden" id="reports-dropdown">
                    <a href="{{ route('campaigns') }}"
                        class="flex items-center px-5 py-1 rounded-lg transition-colors duration-200 {{ request()->is('campaigns') ? 'text-white' : '' }}"
                        style="color: #93C5FD;" onmouseover="this.style.backgroundColor='#1E40AF'; this.style.color='white';"
                        onmouseout="this.style.backgroundColor=''; this.style.color='{{ request()->is('campaigns') ? 'white' : '#93C5FD' }}';">
                        <i class="bi bi-circle text-xs mr-3"></i>
                        <span class="text-sm">{{ __('Campaign / Blast') }}</span>
                    </a>
                    <a href="{{ route('messages.history') }}"
                        class="flex items-center px-5 py-1 rounded-lg transition-colors duration-200 {{ request()->is('messages.history') ? 'text-white' : '' }}"
                        style="color: #93C5FD;" onmouseover="this.style.backgroundColor='#1E40AF'; this.style.color='white';"
                        onmouseout="this.style.backgroundColor=''; this.style.color='{{ request()->is('messages.history') ? 'white' : '#93C5FD' }}';">
                        <i class="bi bi-circle text-xs mr-3"></i>
                        <span class="text-sm">{{ __('Messages History') }}</span>
                    </a>
                </div>
            </div>

            <x-select-device></x-select-device>

            <!-- Device Management Section -->
            @if (Session::has('selectedDevice'))
                <div class="space-y-1 mt-4">
                    <div class="flex items-center px-3 py-1 text-sm font-semibold uppercase tracking-wider" style="color: #60A5FA;">
                        {{ __('Device Management') }}
                    </div>

                    <!-- Plugins -->
                    <a href="{{ route('plugins') }}"
                        class="flex items-center px-3 py-2 text-blue-100 rounded-lg hover:bg-blue-500 hover:text-white transition-colors duration-200 {{ request()->is('plugins') ? 'bg-blue-500 text-white' : '' }}">
                        <i class="bi bi-plug text-lg mr-3"></i>
                        <span class="font-medium">{{ __('Plugins') }}</span>
                    </a>

                    <!-- Auto Reply -->
                    <a href="{{ route('autoreply') }}"
                        class="flex items-center px-3 py-2 text-blue-100 rounded-lg hover:bg-blue-500 hover:text-white transition-colors duration-200 {{ request()->is('autoreply') ? 'bg-blue-500 text-white' : '' }}">
                        <i class="bi bi-chat-dots text-lg mr-3"></i>
                        <span class="font-medium">{{ __('Auto Reply') }}</span>
                    </a>

                    <!-- Create Campaign -->
                    <a href="{{ route('campaign.create') }}"
                        class="flex items-center px-3 py-2 text-blue-100 rounded-lg hover:bg-blue-500 hover:text-white transition-colors duration-200 {{ url()->current() == route('campaign.create') ? 'bg-blue-500 text-white' : '' }}">
                        <i class="bi bi-plus-circle text-lg mr-3"></i>
                        <span class="font-medium">{{ __('Create Campaign') }}</span>
                    </a>

                    <!-- Test Message -->
                    <a href="{{ route('messagetest') }}"
                        class="flex items-center px-3 py-2 text-blue-100 rounded-lg hover:bg-blue-500 hover:text-white transition-colors duration-200 {{ url()->current() == route('messagetest') ? 'bg-blue-500 text-white' : '' }}">
                        <i class="bi bi-chat-dots text-lg mr-3"></i>
                        <span class="font-medium">{{ __('Test Message') }}</span>
                    </a>
                </div>
            @endif

            <!-- API Documentation -->
            <a href="{{ route('rest-api') }}"
                class="flex items-center px-3 py-2 text-blue-100 rounded-lg hover:bg-blue-500 hover:text-white transition-colors duration-200 {{ url()->current() == route('rest-api') ? 'bg-blue-500 text-white' : '' }}">
                <i class="bi bi-code-square text-lg mr-3"></i>
                <span class="font-medium">{{ __('API Docs') }}</span>
            </a>

            <!-- Admin Section -->
            @if (Auth::user()->level == 'admin')
                <div class="space-y-1 mt-4">
                    <div class="flex items-center justify-between px-3 py-1 text-sm font-semibold uppercase tracking-wider cursor-pointer transition-colors duration-200"
                        style="color: #60A5FA;" onmouseover="this.style.color='white';" onmouseout="this.style.color='#60A5FA';"
                        onclick="toggleDropdown('admin-dropdown', 'admin-icon')">
                        <span>{{ __('Administration') }}</span>
                        <i class="bi bi-chevron-down text-xs transition-transform duration-200" id="admin-icon"></i>
                    </div>
                    <div class="space-y-1 hidden" id="admin-dropdown">
                        <a href="{{ route('admin.settings') }}"
                            class="flex items-center px-5 py-1 text-blue-100 rounded-lg hover:bg-blue-500 hover:text-white transition-colors duration-200 {{ request()->is('admin.settings') ? 'bg-blue-500 text-white' : '' }}">
                            <i class="bi bi-circle text-xs mr-3"></i>
                            <span class="text-sm">{{ __('Setting Server') }}</span>
                        </a>

                        <a href="{{ route('update') }}"
                            class="flex items-center px-5 py-1 text-blue-100 rounded-lg hover:bg-blue-500 hover:text-white transition-colors duration-200 {{ request()->is('update') ? 'bg-blue-500 text-white' : '' }}">
                            <i class="bi bi-circle text-xs mr-3"></i>
                            <span class="text-sm">{{ __('Update') }}</span>
                        </a>

                        <a href="{{ route('admin.manage-users') }}"
                            class="flex items-center px-5 py-1 text-blue-100 rounded-lg hover:bg-blue-500 hover:text-white transition-colors duration-200 {{ request()->is('admin.manage-users') ? 'bg-blue-500 text-white' : '' }}">
                            <i class="bi bi-circle text-xs mr-3"></i>
                            <span class="text-sm">{{ __('Manage User') }}</span>
                        </a>
                    </div>
                </div>
            @endif
        </nav>
    </aside>

    <!--end sidebar -->

    <script>
        // Toggle dropdown function
        function toggleDropdown(dropdownId, iconId) {
            const dropdown = document.getElementById(dropdownId);
            const icon = document.getElementById(iconId);

            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Auto-open dropdowns if current page is in submenu
        document.addEventListener('DOMContentLoaded', function() {
            // Check if current page is in Reports section
            if (window.location.pathname.includes('/campaigns') || window.location.pathname.includes('/messages/history')) {
                const reportsDropdown = document.getElementById('reports-dropdown');
                const reportsIcon = document.getElementById('reports-icon');
                if (reportsDropdown && reportsIcon) {
                    reportsDropdown.classList.remove('hidden');
                    reportsIcon.style.transform = 'rotate(180deg)';
                }
            }

            // Check if current page is in Admin section
            if (window.location.pathname.includes('/admin/settings') ||
                window.location.pathname.includes('/update') ||
                window.location.pathname.includes('/admin/manage-users')) {
                const adminDropdown = document.getElementById('admin-dropdown');
                const adminIcon = document.getElementById('admin-icon');
                if (adminDropdown && adminIcon) {
                    adminDropdown.classList.remove('hidden');
                    adminIcon.style.transform = 'rotate(180deg)';
                }
            }
        });
    </script>
