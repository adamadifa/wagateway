<x-layout-dashboard title="Settings Server">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Server Settings</h1>
            <p class="text-gray-600 mt-1">Configure your WhatsApp server settings and SSL certificates</p>
        </div>
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <i class="bi bi-gear w-4 h-4"></i>
            <span>Admin Panel</span>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session()->has('alert'))
        <div
            class="mb-6 p-4 rounded-lg {{ session('alert')['type'] === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
            <div class="flex items-center">
                <i
                    class="bi bi-{{ session('alert')['type'] === 'success' ? 'check-circle' : 'exclamation-triangle' }} mr-2"></i>
                <span>{{ session('alert')['msg'] }}</span>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200">
            <div class="flex items-start">
                <i class="bi bi-exclamation-triangle mr-2 mt-0.5"></i>
                <div>
                    <h4 class="font-semibold mb-2">Please fix the following errors:</h4>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Server Configuration Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Server Settings Form -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-blue-100 rounded-lg mr-3">
                        <i class="bi bi-server text-blue-600 w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Server Configuration</h3>
                        <p class="text-sm text-gray-600">Configure your WhatsApp server settings</p>
                    </div>
                </div>

                <form action="{{ route('setServer') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Server Type -->
                    <div>
                        <label for="typeServer" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Server Type') }}
                        </label>
                        <select name="typeServer" id="server" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 transition-colors">
                            @if (env('TYPE_SERVER') === 'localhost')
                                <option value="localhost" selected>{{ __('Localhost') }}</option>
                                <option value="hosting">{{ __('Hosting Shared') }}</option>
                                <option value="other">{{ __('Other') }}</option>
                            @elseif(env('TYPE_SERVER') === 'hosting')
                                <option value="localhost">{{ __('Localhost') }}</option>
                                <option value="hosting" selected>{{ __('Hosting Shared') }}</option>
                                <option value="other">{{ __('Other') }}</option>
                            @else
                                <option value="other" selected>{{ __('Other') }}</option>
                                <option value="localhost">{{ __('Localhost') }}</option>
                                <option value="hosting">{{ __('Hosting Shared') }}</option>
                            @endif
                        </select>
                    </div>

                    <!-- Port Configuration -->
                    <div>
                        <label for="Port" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Port Node JS') }}
                        </label>
                        <input type="number" name="portnode" id="Port" value="{{ env('PORT_NODE') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 transition-colors"
                            placeholder="Enter port number">
                    </div>

                    <!-- URL Node (for Other server type) -->
                    <div class="formUrlNode {{ env('TYPE_SERVER') === 'other' ? 'block' : 'hidden' }}">
                        <label for="settingsInputUserName" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('URL Node') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">{{ __('URL') }}</span>
                            </div>
                            <input type="text" name="urlnode" id="settingsInputUserName"
                                value="{{ env('WA_URL_SERVER') }}"
                                class="w-full pl-16 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 transition-colors"
                                placeholder="https://your-domain.com">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center">
                            <i class="bi bi-check-circle mr-2"></i>
                            {{ __('Update Settings') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Server Status -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <div class="p-2 {{ $isConnected ? 'bg-green-100' : 'bg-red-100' }} rounded-lg mr-3">
                        <i
                            class="bi bi-{{ $isConnected ? 'check-circle' : 'x-circle' }} {{ $isConnected ? 'text-green-600' : 'text-red-600' }} w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Server Status</h3>
                        <p class="text-sm text-gray-600">Current connection status</p>
                    </div>
                </div>

                <div class="text-center py-8">
                    <div class="mb-4">
                        <div
                            class="inline-flex items-center justify-center w-20 h-20 rounded-full {{ $isConnected ? 'bg-green-100' : 'bg-red-100' }}">
                            <i
                                class="bi bi-{{ $isConnected ? 'check' : 'x' }} text-3xl {{ $isConnected ? 'text-green-600' : 'text-red-600' }}"></i>
                        </div>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">
                        Port {{ $port }} is {{ $isConnected ? __('Connected') : __('Disconnected') }}
                    </h4>
                    <p class="text-gray-600">
                        {{ $isConnected ? 'Your server is running properly' : 'Unable to connect to the server' }}
                    </p>
                </div>

                <!-- Additional Status Info -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Protocol Match:</span>
                        <span class="font-medium {{ $protocolMatch ? 'text-green-600' : 'text-red-600' }}">
                            {{ $protocolMatch ? 'Valid' : 'Invalid' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SSL Certificate Section -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="p-6">
            <div class="flex items-center mb-6">
                <div class="p-2 bg-purple-100 rounded-lg mr-3">
                    <i class="bi bi-shield-check text-purple-600 w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">SSL Certificate</h3>
                    <p class="text-sm text-gray-600">Generate SSL certificate for secure connections</p>
                </div>
            </div>

            <form action="{{ route('generateSsl') }}" method="POST" class="max-w-2xl mx-auto">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Domain Field -->
                    <div>
                        <label for="domain" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Domain') }}
                        </label>
                        <input type="text" name="domain" id="domain" value="{{ $host }}" required
                            readonly
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white text-gray-900 transition-colors {{ $host === 'localhost' ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                            @if ($host === 'localhost') disabled @endif>
                        @if ($host === 'localhost')
                            <p class="text-xs text-gray-500 mt-1">SSL not available for localhost</p>
                        @endif
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Email') }}
                        </label>
                        <input type="email" name="email" id="email" value="" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white text-gray-900 transition-colors {{ $host === 'localhost' ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                            placeholder="your-email@domain.com"
                            @if ($host === 'localhost') readonly disabled @endif>
                        @if ($host === 'localhost')
                            <p class="text-xs text-gray-500 mt-1">Email not required for localhost
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    @if ($host == 'localhost' || $host == 'hosting')
                        <button type="submit" disabled
                            class="inline-flex items-center px-6 py-3 bg-gray-400 text-white font-medium rounded-lg cursor-not-allowed">
                            <i class="bi bi-info-circle mr-2"></i>
                            {{ __('SSL only required in VPS if you want to access via SSL') }}
                        </button>
                        <p class="text-sm text-gray-500 mt-2">
                            SSL certificates are only needed for VPS/dedicated servers with custom domains
                        </p>
                    @else
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="bi bi-shield-check mr-2"></i>
                            {{ __('Generate SSL Certificate') }}
                        </button>
                        <p class="text-sm text-gray-500 mt-2">
                            This will generate a free SSL certificate using Let's Encrypt
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Server type change handler
            $('#server').on('change', function() {
                let type = $(this).val();
                console.log('Server type changed to:', type);

                if (type === 'other') {
                    $('.formUrlNode').removeClass('hidden').addClass('block');
                } else {
                    $('.formUrlNode').removeClass('block').addClass('hidden');
                }
            });

            // Form validation
            $('form').on('submit', function(e) {
                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');

                // Add loading state
                submitBtn.prop('disabled', true);
                submitBtn.html('<i class="bi bi-hourglass-split mr-2"></i>Processing...');

                // Re-enable button after 3 seconds (in case of errors)
                setTimeout(() => {
                    submitBtn.prop('disabled', false);
                    submitBtn.html('<i class="bi bi-check-circle mr-2"></i>Update Settings');
                }, 3000);
            });

            // Auto-refresh server status every 30 seconds
            setInterval(function() {
                // You can add AJAX call here to refresh server status
                console.log('Checking server status...');
            }, 30000);
        });
    </script>
</x-layout-dashboard>
