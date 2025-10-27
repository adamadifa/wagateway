<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center justify-between h-16 px-6">
        <!-- Mobile menu button -->
        <button class="lg:hidden text-gray-600 hover:text-gray-900 mobile-toggle-icon">
            <i class="bi bi-list text-xl"></i>
        </button>

        <!-- Search Bar -->
        <div class="hidden md:flex flex-1 max-w-md mx-6">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="bi bi-search text-gray-400"></i>
                </div>
                <input type="text"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-dark-blue-500 focus:border-transparent"
                    placeholder="{{ __('Type here to search') }}">
                <button class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="bi bi-x-lg text-gray-400 hover:text-gray-600"></i>
                </button>
            </div>
        </div>

        <!-- Right side items -->
        <div class="flex items-center space-x-4">
            <!-- Search toggle for mobile -->
            <button class="md:hidden text-gray-600 hover:text-gray-900">
                <i class="bi bi-search text-xl"></i>
            </button>

            <!-- Language Dropdown -->
            <div class="relative">
                <button
                    class="flex items-center space-x-2 text-gray-600  hover:text-gray-900  px-3 py-2 rounded-lg hover:bg-gray-100  transition-colors duration-200"
                    onclick="toggleLanguageDropdown()">
                    <i class="bi bi-globe"></i>
                    <span class="text-sm font-medium">{{ __('Language') }}</span>
                    <i class="bi bi-chevron-down text-xs"></i>
                </button>
                <div id="languageDropdown"
                    class="hidden absolute right-0 mt-2 w-48 bg-white  rounded-lg shadow-lg border border-gray-200  z-50">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700  hover:bg-gray-100  transition-colors duration-200">
                            <span class="flag-icon flag-icon-{{ strtolower($localeCode) }} mr-3"></span>
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="relative">
                <button
                    class="flex items-center space-x-3 text-gray-600  hover:text-gray-900  px-3 py-2 rounded-lg hover:bg-gray-100  transition-colors duration-200"
                    onclick="toggleUserDropdown()">
                    <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" class="w-8 h-8 rounded-full"
                        alt="User Avatar">
                    <i class="bi bi-chevron-down text-xs"></i>
                </button>
                <div id="userDropdown"
                    class="hidden absolute right-0 mt-2 w-64 bg-white  rounded-lg shadow-lg border border-gray-200  z-50">
                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-gray-200 ">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" class="w-12 h-12 rounded-full"
                                alt="User Avatar">
                            <div>
                                <h6 class="text-sm font-semibold text-gray-900 ">
                                    {{ Auth::user()->username }}</h6>
                                <p class="text-xs text-gray-500 ">{{ __(Auth::user()->level) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="py-2">
                        <a href="{{ route('user.settings') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700  hover:bg-gray-100  transition-colors duration-200">
                            <i class="bi bi-gear-fill mr-3"></i>
                            {{ __('Setting') }}
                        </a>

                        <form action="{{ route('logout') }}" method="post" class="block">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center px-4 py-2 text-sm text-gray-700  hover:bg-gray-100  transition-colors duration-200">
                                <i class="bi bi-lock-fill mr-3"></i>
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Dropdown Scripts -->
<script>
    function toggleLanguageDropdown() {
        const dropdown = document.getElementById('languageDropdown');
        const userDropdown = document.getElementById('userDropdown');
        userDropdown.classList.add('hidden');
        dropdown.classList.toggle('hidden');
    }

    function toggleUserDropdown() {
        const dropdown = document.getElementById('userDropdown');
        const languageDropdown = document.getElementById('languageDropdown');
        languageDropdown.classList.add('hidden');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const languageDropdown = document.getElementById('languageDropdown');
        const userDropdown = document.getElementById('userDropdown');

        if (!event.target.closest('.relative')) {
            languageDropdown.classList.add('hidden');
            userDropdown.classList.add('hidden');
        }
    });
</script>
