<x-layout-dashboard title="{{ __('Update Version') }}">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ __('Update Version') }}</h1>
            <p class="text-gray-600 mt-1">Check for updates and manage your application version</p>
        </div>
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <i class="bi bi-arrow-clockwise w-4 h-4"></i>
            <span>System Update</span>
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
    <!-- Update Status Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="p-6">
            <div class="flex items-center mb-6">
                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                    <i class="bi bi-arrow-clockwise text-blue-600 w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('System Update') }}</h3>
                    <p class="text-sm text-gray-600">Check and install application updates</p>
                </div>
            </div>

            <!-- Status Messages -->
            @if (session('status'))
                <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 border border-green-200">
                    <div class="flex items-center">
                        <i class="bi bi-check-circle mr-2"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                </div>
            @endif

            @if ($updateAvailable)
                <!-- Update Available -->
                <div class="mb-6 p-4 rounded-lg bg-blue-100 text-blue-800 border border-blue-200">
                    <div class="flex items-start">
                        <i class="bi bi-info-circle mr-2 mt-0.5"></i>
                        <div>
                            <h4 class="font-semibold mb-2">{{ __('A new version is available:') }}
                                <span class="text-red-600 font-bold">v{{ $newVersion }}</span>
                            </h4>
                            <div class="text-sm space-y-2">
                                <p class="text-red-600">
                                    <strong>Note:</strong> Turn off <span
                                        class="font-semibold text-blue-600">Node.js</span> before continuing with the
                                    update,
                                    after the update is complete you can turn it back on.
                                </p>
                                @if ($whatsNew)
                                    <div class="mt-3">
                                        <h5 class="font-semibold mb-2">What's New:</h5>
                                        <div class="text-gray-700">{!! $whatsNew !!}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Form -->
                <form method="POST" action="{{ route('update.install') }}" class="space-y-4">
                    @csrf

                    <!-- SSL Warning -->
                    @if ($serverProtocol == 'https')
                        <div class="p-4 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-200">
                            <div class="flex items-start">
                                <i class="bi bi-exclamation-triangle mr-2 mt-0.5"></i>
                                <div>
                                    <h5 class="font-semibold mb-1">SSL Configuration Detected</h5>
                                    <p class="text-sm">
                                        You are using SSL in the <span
                                            class="font-semibold text-blue-600">server.js</span> file,
                                        but don't worry, <span class="font-semibold text-blue-600">Smart Update</span>
                                        will update
                                        and run your site with SSL, just click update.
                                    </p>
                                    @if ($updateSSL)
                                        <input type="hidden" name="ssl" value="ssl" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Hidden Fields -->
                    @if ($before)
                        <input type="hidden" name="before" value="1" />
                    @endif
                    @if ($after)
                        <input type="hidden" name="after" value="1" />
                    @endif
                    <input type="hidden" name="version" value="{{ $newVersion }}" />

                    <!-- Update Button -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div class="text-sm text-gray-600">
                            <i class="bi bi-shield-check mr-1"></i>
                            Update will be installed automatically
                        </div>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center">
                            <i class="bi bi-download mr-2"></i>
                            {{ __('Install Update') }}
                        </button>
                    </div>
                </form>
            @else
                <!-- Latest Version -->
                <div class="text-center py-12">
                    <div class="mb-4">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-100">
                            <i class="bi bi-check text-3xl text-green-600"></i>
                        </div>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ __('You are using the latest version') }}
                    </h4>
                    <p class="text-gray-600 mb-6">Your application is up to date with the latest features and security
                        patches.</p>

                    <!-- Refresh Button -->
                    <button onclick="window.location.reload()"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        <i class="bi bi-arrow-clockwise mr-2"></i>
                        Check Again
                    </button>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Update button loading state
            $('form').on('submit', function(e) {
                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');

                // Add loading state
                submitBtn.prop('disabled', true);
                submitBtn.html('<i class="bi bi-hourglass-split mr-2"></i>Installing Update...');

                // Show progress message
                const progressDiv = $(
                    '<div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">' +
                    '<div class="flex items-center">' +
                    '<div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600 mr-3"></div>' +
                    '<span class="text-blue-800">Update is being installed. Please wait...</span>' +
                    '</div>' +
                    '</div>');

                form.after(progressDiv);

                // Prevent form submission if there are validation errors
                // The form will still submit normally for actual update process
            });

            // Auto-refresh page every 30 seconds if no update is available
            @if (!$updateAvailable)
                setInterval(function() {
                    console.log('Checking for updates...');
                    // You can add AJAX call here to check for updates without full page reload
                }, 30000);
            @endif

            // Smooth scroll to top when page loads
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</x-layout-dashboard>
