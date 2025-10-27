<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-blue': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#172554'
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <!-- Custom Notification Styles -->
    <style>
        .custom-notification {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-left: 4px solid;
            padding: 16px;
            margin: 8px;
            max-width: 400px;
            position: relative;
            overflow: hidden;
            animation: slideInRight 0.3s ease-out;
        }

        .custom-notification.success {
            border-left-color: #10b981;
        }

        .custom-notification.error {
            border-left-color: #ef4444;
        }

        .custom-notification.warning {
            border-left-color: #f59e0b;
        }

        .custom-notification.info {
            border-left-color: #3b82f6;
        }

        .custom-notification .icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }

        .custom-notification.success .icon {
            background: #d1fae5;
            color: #059669;
        }

        .custom-notification.error .icon {
            background: #fee2e2;
            color: #dc2626;
        }

        .custom-notification.warning .icon {
            background: #fef3c7;
            color: #d97706;
        }

        .custom-notification.info .icon {
            background: #dbeafe;
            color: #2563eb;
        }

        .custom-notification .content {
            flex: 1;
        }

        .custom-notification .title {
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .custom-notification .message {
            color: #6b7280;
            font-size: 14px;
        }

        .custom-notification .close-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .custom-notification .close-btn:hover {
            background: #f3f4f6;
            color: #374151;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title }} | My Gateway</title>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Notification Container -->
    <div id="notification-container" class="notification-container"></div>
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <x-aside></x-aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <x-header></x-header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-6 py-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>


    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // Custom Notification System
        function showNotification(type, title, message, duration = 5000) {
            const container = document.getElementById('notification-container');
            const notification = document.createElement('div');
            notification.className = `custom-notification ${type}`;

            const iconMap = {
                success: 'bi bi-check-circle-fill',
                error: 'bi bi-exclamation-circle-fill',
                warning: 'bi bi-exclamation-triangle-fill',
                info: 'bi bi-info-circle-fill'
            };

            notification.innerHTML = `
                <div class="flex items-center">
                    <div class="icon">
                        <i class="${iconMap[type]}"></i>
                    </div>
                    <div class="content">
                        <div class="title">${title}</div>
                        <div class="message">${message}</div>
                    </div>
                    <button class="close-btn" onclick="closeNotification(this)">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            `;

            container.appendChild(notification);

            // Auto remove after duration
            setTimeout(() => {
                if (notification.parentNode) {
                    closeNotification(notification.querySelector('.close-btn'));
                }
            }, duration);
        }

        function closeNotification(button) {
            const notification = button.closest('.custom-notification');
            notification.style.animation = 'slideOutRight 0.3s ease-in';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }

        // Toastr Configuration (fallback)
        toastr.options = {
            closeButton: false,
            debug: false,
            newestOnTop: false,
            progressBar: false,
            positionClass: "toast-top-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
        };

        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.querySelector('.mobile-toggle-icon');
            const sidebar = document.querySelector('.sidebar');

            if (mobileToggle && sidebar) {
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                });
            }
        });
    </script>
</body>

</html>
{{-- <script src="{{asset('plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/perfectscroll/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('plugins/pace/pace.min.js')}}"></script>
<script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('plugins/blockUI/jquery.blockUI.min.js')}}"></script>
<script src="{{asset('js/main.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/pages/blockui.js')}}"></script>
</body>

</html> --}}
