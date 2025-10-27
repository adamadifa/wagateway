<x-layout-dashboard title="File Manager">
    <div class="app-content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Header Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div
                                            class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                            <i class="bi bi-folder2-open text-blue-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h1 class="text-2xl font-bold text-gray-900">File Manager</h1>
                                            <p class="text-sm text-gray-600">Manage your files and media assets</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">Total Files</p>
                                            <p class="text-lg font-semibold text-gray-900">-</p>
                                        </div>
                                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                            <i class="bi bi-cloud-upload text-green-600 text-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="px-6 py-4">
                                <div class="flex flex-wrap items-center gap-3">
                                    <button
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                        <i class="bi bi-upload mr-2"></i>
                                        Upload Files
                                    </button>
                                    <button
                                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                        <i class="bi bi-folder-plus mr-2"></i>
                                        New Folder
                                    </button>
                                    <button
                                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                        <i class="bi bi-download mr-2"></i>
                                        Download
                                    </button>
                                    <button
                                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                        <i class="bi bi-trash mr-2"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                <div class="row mb-4">
                    <div class="col-12">
                        @if (session()->has('alert'))
                            <x-alert>
                                @slot('type', session('alert')['type'])
                                @slot('msg', session('alert')['msg'])
                            </x-alert>
                        @endif
                        @if ($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-400 rounded-lg p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-exclamation-triangle-fill text-red-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Please correct the following
                                            errors:</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <ul class="list-disc list-inside space-y-1">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- File Manager Container -->
                <div class="row">
                    <div class="col-12">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                            <!-- File Manager Header -->
                            <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <h3 class="text-lg font-semibold text-gray-900">File Browser</h3>
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="bi bi-shield-check mr-1"></i>
                                                Secure
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors"
                                            title="Refresh">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors"
                                            title="Settings">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- File Manager Iframe -->
                            <div class="relative">
                                <iframe src="{{ url('/laravel-filemanager') }}" class="w-full border-0"
                                    style="height: calc(100vh - 300px); min-height: 600px;" frameborder="0"
                                    allowfullscreen>
                                </iframe>

                                <!-- Loading Overlay -->
                                <div id="loading-overlay"
                                    class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center hidden">
                                    <div class="text-center">
                                        <div
                                            class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4">
                                        </div>
                                        <p class="text-gray-600">Loading file manager...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styles for file manager */
        .file-manager-container {
            position: relative;
        }

        /* Ensure iframe takes full width and height */
        iframe {
            width: 100% !important;
            height: calc(100vh - 300px) !important;
            min-height: 600px !important;
            border: none !important;
        }

        /* Loading animation */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iframe = document.querySelector('iframe');
            const loadingOverlay = document.getElementById('loading-overlay');

            // Show loading overlay initially
            loadingOverlay.classList.remove('hidden');

            // Hide loading overlay when iframe loads
            iframe.addEventListener('load', function() {
                setTimeout(() => {
                    loadingOverlay.classList.add('hidden');
                }, 1000);
            });

            // Handle iframe errors
            iframe.addEventListener('error', function() {
                loadingOverlay.innerHTML = `
                    <div class="text-center">
                        <i class="bi bi-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                        <p class="text-red-600">Failed to load file manager</p>
                        <button onclick="location.reload()" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Retry
                        </button>
                    </div>
                `;
            });
        });

        // Legacy script for server selection (if needed)
        $('#server').on('change', function() {
            let type = $('#server :selected').val();
            console.log(type);
            if (type === 'other') {
                $('.formUrlNode').removeClass('d-none')
            } else {
                $('.formUrlNode').addClass('d-none')
            }
        });
    </script>
</x-layout-dashboard>
