<x-layout-dashboard title="User Settings">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-dark-blue-600">
                        <i class="bi bi-house-fill mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400 mx-1"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">User Settings</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Alert Messages -->
    @if (session()->has('alert'))
        <div class="mb-6">
            <div
                class="bg-{{ session('alert')['type'] == 'success' ? 'green' : (session('alert')['type'] == 'error' ? 'red' : 'blue') }}-50 border border-{{ session('alert')['type'] == 'success' ? 'green' : (session('alert')['type'] == 'error' ? 'red' : 'blue') }}-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i
                            class="bi bi-{{ session('alert')['type'] == 'success' ? 'check-circle' : (session('alert')['type'] == 'error' ? 'exclamation-circle' : 'info-circle') }}-fill text-{{ session('alert')['type'] == 'success' ? 'green' : (session('alert')['type'] == 'error' ? 'red' : 'blue') }}-400"></i>
                    </div>
                    <div class="ml-3">
                        <p
                            class="text-sm font-medium text-{{ session('alert')['type'] == 'success' ? 'green' : (session('alert')['type'] == 'error' ? 'red' : 'blue') }}-800">
                            {{ session('alert')['msg'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-dark-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="bi bi-gear-fill text-dark-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">User Settings</h1>
                        <p class="text-gray-600 mt-1">Manage your account settings and API key</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- API Key Settings -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="bi bi-key-fill text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">API Key</h3>
                            <p class="text-sm text-gray-600">Manage your API authentication key</p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <form action="{{ route('generateNewApiKey') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="api-key" class="block text-sm font-medium text-gray-700 mb-2">Current API Key</label>
                                <div class="flex">
                                    <input type="text" id="api-key"
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg bg-gray-50 text-gray-500 text-sm font-mono"
                                        value="{{ Auth::user()->api_key }}" readonly>
                                    <button type="button" onclick="copyApiKey()"
                                        class="px-3 py-2 bg-gray-100 border border-l-0 border-gray-300 rounded-r-lg hover:bg-gray-200 transition-colors duration-200">
                                        <i class="bi bi-clipboard text-gray-600"></i>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Click the clipboard icon to copy your API key</p>
                            </div>
                            <div>
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <i class="bi bi-arrow-clockwise mr-2"></i>
                                    Generate New API Key
                                </button>
                                <p class="text-xs text-gray-500 mt-1 text-center">Warning: This will invalidate your current API key</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Settings -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="bi bi-shield-lock-fill text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Change Password</h3>
                            <p class="text-sm text-gray-600">Update your account password</p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <form action="{{ route('changePassword') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="current-password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                <input type="password" name="current" id="current-password"
                                    class="w-full px-3 py-2 border {{ $errors->has('current') ? 'border-red-300 bg-red-50' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                                    placeholder="Enter your current password" required>
                                @if ($errors->has('current'))
                                    <p class="text-red-600 text-xs mt-1">{{ $errors->first('current') }}</p>
                                @endif
                            </div>

                            <div>
                                <label for="new-password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input type="password" name="password" id="new-password"
                                    class="w-full px-3 py-2 border {{ $errors->has('password') ? 'border-red-300 bg-red-50' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                                    placeholder="Enter your new password" required>
                                @if ($errors->has('password'))
                                    <p class="text-red-600 text-xs mt-1">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <div>
                                <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="confirm-password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                                    placeholder="Confirm your new password" required>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <i class="bi bi-check-circle mr-2"></i>
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Additional Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="bi bi-info-circle-fill text-blue-600 text-lg"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Security Tips</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Keep your API key secure and never share it publicly</li>
                            <li>Use a strong password with at least 8 characters</li>
                            <li>Consider changing your password regularly</li>
                            <li>If you suspect your account is compromised, change your password immediately</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for API Key Copy -->
    <script>
        function copyApiKey() {
            const apiKeyInput = document.getElementById('api-key');
            apiKeyInput.select();
            apiKeyInput.setSelectionRange(0, 99999); // For mobile devices

            try {
                document.execCommand('copy');
                // Show success message
                showNotification('success', 'Copied!', 'API key copied to clipboard');
            } catch (err) {
                // Fallback for older browsers
                navigator.clipboard.writeText(apiKeyInput.value).then(function() {
                    showNotification('success', 'Copied!', 'API key copied to clipboard');
                }).catch(function() {
                    showNotification('error', 'Error', 'Failed to copy API key');
                });
            }
        }
    </script>
</x-layout-dashboard>
