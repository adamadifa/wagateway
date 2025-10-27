<x-layout-dashboard title="API Documentation">

    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-dark-blue-600">
                        <i class="bi bi-house-fill mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400 mx-1"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">API Documentation</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- API Documentation -->
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-dark-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="bi bi-code-square text-dark-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">API Documentation</h1>
                        <p class="text-gray-600 mt-1">Complete guide to integrate with our WhatsApp API</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 sticky top-6">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">API Endpoints</h3>
                    </div>
                    <nav class="p-4">
                        <div class="space-y-1">
                            <!-- Messaging APIs -->
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Messaging
                                </h4>
                                <div class="space-y-1">
                                    <a href="#sendmessage"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 active-tab"
                                        data-tab="sendmessage">
                                        <i class="bi bi-chat-text mr-3 text-gray-400"></i>
                                        Send Message
                                    </a>
                                    <a href="#sendmedia"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="sendmedia">
                                        <i class="bi bi-image mr-3 text-gray-400"></i>
                                        Send Media
                                    </a>
                                    <a href="#sendpoll"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="sendpoll">
                                        <i class="bi bi-bar-chart mr-3 text-gray-400"></i>
                                        Send Poll
                                    </a>
                                    <a href="#sendsticker"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="sendsticker">
                                        <i class="bi bi-emoji-smile mr-3 text-gray-400"></i>
                                        Send Sticker
                                    </a>
                                    <a href="#sendbutton"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="sendbutton">
                                        <i class="bi bi-hand-index mr-3 text-gray-400"></i>
                                        Send Button
                                    </a>
                                    <a href="#sendlist"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="sendlist">
                                        <i class="bi bi-list-ul mr-3 text-gray-400"></i>
                                        Send List
                                    </a>
                                    <a href="#sendlocation"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="sendlocation">
                                        <i class="bi bi-geo-alt mr-3 text-gray-400"></i>
                                        Send Location
                                    </a>
                                    <a href="#sendvcard"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="sendvcard">
                                        <i class="bi bi-person mr-3 text-gray-400"></i>
                                        Send Vcard
                                    </a>
                                </div>
                            </div>

                            <!-- Device Management -->
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Device
                                    Management</h4>
                                <div class="space-y-1">
                                    <a href="#generateqr"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="generateqr">
                                        <i class="bi bi-qr-code mr-3 text-gray-400"></i>
                                        Generate QR
                                    </a>
                                    <a href="#disconnectdevice"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="disconnectdevice">
                                        <i class="bi bi-x-circle mr-3 text-gray-400"></i>
                                        Disconnect Device
                                    </a>
                                    <a href="#createdevice"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="createdevice">
                                        <i class="bi bi-plus-circle mr-3 text-gray-400"></i>
                                        Create Device
                                    </a>
                                    <a href="#deviceinfo"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="deviceinfo">
                                        <i class="bi bi-info-circle mr-3 text-gray-400"></i>
                                        Device Info
                                    </a>
                                </div>
                            </div>

                            <!-- User Management -->
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">User
                                    Management</h4>
                                <div class="space-y-1">
                                    <a href="#createuser"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="createuser">
                                        <i class="bi bi-person-plus mr-3 text-gray-400"></i>
                                        Create User
                                    </a>
                                    <a href="#userinfo"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="userinfo">
                                        <i class="bi bi-person-check mr-3 text-gray-400"></i>
                                        User Info
                                    </a>
                                </div>
                            </div>

                            <!-- Utilities -->
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Utilities
                                </h4>
                                <div class="space-y-1">
                                    <a href="#checknumber"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="checknumber">
                                        <i class="bi bi-telephone mr-3 text-gray-400"></i>
                                        Check Number
                                    </a>
                                    <a href="#examplewebhook"
                                        class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                        data-tab="examplewebhook">
                                        <i class="bi bi-webhook mr-3 text-gray-400"></i>
                                        Example Webhook
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Content Area -->
            <div class="lg:col-span-3">
                <div class="tab-content">
                    {{-- send message --}}
                    @include('pages.api-docs.send-message')
                    {{-- end send message --}}
                    {{-- send media --}}
                    @include('pages.api-docs.send-media')
                    @include('pages.api-docs.send-poll')

                    @include('pages.api-docs.send-sticker')
                    {{-- end send media --}}
                    {{-- send button --}}
                    @include('pages.api-docs.send-button')
                    {{-- end send button --}}
                    {{-- send template --}}

                    {{-- end send template --}}
                    {{-- send list --}}
                    @include('pages.api-docs.send-list')
                    {{-- end send list --}}
                    {{-- send location --}}
                    @include('pages.api-docs.send-location')
                    {{-- end send location --}}
                    {{-- send vcard --}}
                    @include('pages.api-docs.send-vcard')
                    {{-- end send vcard --}}

                    {{-- generate qr code --}}
                    @include('pages.api-docs.generateqr')
                    @include('pages.api-docs.disconnectdevice')

                    {{-- create user --}}
                    @include('pages.api-docs.createuser')
                    {{-- end create user --}}
                    {{-- user info --}}
                    @include('pages.api-docs.user-info')
                    {{-- end user info --}}
                    @include('pages.api-docs.create-device')
                    {{-- device info --}}
                    @include('pages.api-docs.device-info')
                    {{-- end device info --}}
                    {{-- check number --}}
                    @include('pages.api-docs.check-number')
                    {{-- end check number --}}
                    {{-- send location --}}

                    {{-- end generate qr code --}}
                    {{-- example webhook --}}
                    @include('pages.api-docs.examplewebhook')
                    {{-- end example webhook --}}

                </div>
            </div>
        </div>
    </div>






    <style>
        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }
    </style>

    <script>
        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabLinks = document.querySelectorAll('[data-tab]');
            const tabContents = document.querySelectorAll('.tab-pane');

            // Show first tab by default
            if (tabContents.length > 0) {
                tabContents[0].classList.add('active');
                // Also show the first tab link as active
                const firstLink = document.querySelector('[data-tab]');
                if (firstLink) {
                    firstLink.classList.add('active-tab', 'bg-dark-blue-50', 'text-dark-blue-700');
                }
            }

            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetTab = this.getAttribute('data-tab');

                    // Remove active class from all links
                    tabLinks.forEach(l => l.classList.remove('active-tab', 'bg-dark-blue-50',
                        'text-dark-blue-700'));

                    // Add active class to clicked link
                    this.classList.add('active-tab', 'bg-dark-blue-50', 'text-dark-blue-700');

                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.remove('active');
                        content.style.display = 'none';
                    });

                    // Show target tab content
                    const targetContent = document.getElementById(targetTab);
                    if (targetContent) {
                        targetContent.classList.add('active');
                        targetContent.style.display = 'block';
                    }
                });
            });
        });
    </script>
</x-layout-dashboard>
