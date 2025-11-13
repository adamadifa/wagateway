<x-layout-dashboard title="Scan QR Code">
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
                                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                            <i class="bi bi-qr-code-scan text-green-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h1 class="text-2xl font-bold text-gray-900">WhatsApp QR Code Scanner</h1>
                                            <p class="text-sm text-gray-600">Account: {{ $number->body }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">Status</p>
                                            <p class="text-lg font-semibold text-gray-900" id="connection-status">
                                                Connecting...</p>
                                        </div>
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="bi bi-whatsapp text-blue-600 text-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Alert -->
                            <div class="px-6 py-4">
                                <div class="bg-blue-50 border-l-4 border-blue-400 rounded-lg p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-info-circle-fill text-blue-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-blue-800">Important Instructions</h3>
                                            <div class="mt-2 text-sm text-blue-700">
                                                <p>{{ __('Dont leave your phone before connected') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="row">
                    <!-- QR Code Section -->
                    <div class="col-lg-8 mb-4">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900">QR Code Scanner</h3>
                                    <div class="logoutbutton"></div>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="text-center">
                                    <div class="imageee mb-4">
                                        @if (Auth::user()->is_expired_subscription)
                                            <div class="w-80 h-80 mx-auto bg-red-50 rounded-xl flex items-center justify-center">
                                                <img src="{{ asset('images/other/expired.png') }}" class="max-w-full max-h-full rounded-lg"
                                                    alt="Subscription Expired">
                                            </div>
                                        @else
                                            <div class="w-80 h-80 mx-auto bg-gray-50 rounded-xl flex items-center justify-center">
                                                <img src="{{ asset('assets/images/waiting.jpg') }}" class="max-w-full max-h-full rounded-lg"
                                                    alt="Waiting for QR Code">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="statusss">
                                        @if (Auth::user()->is_expired_subscription)
                                            <button
                                                class="inline-flex items-center px-6 py-3 bg-red-600 text-white text-sm font-medium rounded-lg cursor-not-allowed opacity-75"
                                                disabled>
                                                <i class="bi bi-exclamation-triangle mr-2"></i>
                                                {{ __('Your subscription is expired. Please renew your subscription.') }}
                                            </button>
                                        @else
                                            <button
                                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg cursor-not-allowed opacity-75"
                                                disabled>
                                                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2">
                                                </div>
                                                {{ __('Waiting For node server..') }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp Info Section -->
                    <div class="col-lg-4 mb-4">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900">WhatsApp Info</h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="bi bi-clock mr-1"></i>
                                        Updated 5 min ago
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                                <i class="bi bi-person text-gray-600"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">Name</span>
                                        </div>
                                        <span class="name text-sm text-gray-900 font-medium">-</span>
                                    </div>

                                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                                <i class="bi bi-telephone text-gray-600"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">Number</span>
                                        </div>
                                        <span class="number text-sm text-gray-900 font-medium">-</span>
                                    </div>

                                    <div class="flex items-center justify-between py-3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                                <i class="bi bi-phone text-gray-600"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">Device</span>
                                        </div>
                                        <span class="device text-sm text-gray-900 font-medium">-</span>
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
        /* Custom animations */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* QR Code container styling */
        .imageee img {
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Status button styling */
        .statusss button {
            transition: all 0.3s ease;
        }

        /* Info cards styling */
        .bg-white {
            transition: box-shadow 0.3s ease;
        }

        .bg-white:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</x-layout-dashboard>
<script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+"
    crossorigin="anonymous"></script>
<script>
    // if subscription not expired
    const is_expired_subscription = '{{ Auth::user()->is_expired_subscription }}';
    if (!is_expired_subscription) {
        let socket;
        let device = '{{ $number->body }}';
        let socketUrl = '{{ env('WA_URL_SERVER') }}';
        let portNode = '{{ env('PORT_NODE') }}';

        // Jika TYPE_SERVER=hosting, pastikan menggunakan URL dengan port yang benar
        if ('{{ env('TYPE_SERVER') }}' === 'hosting') {
            // Jika WA_URL_SERVER tidak mengandung port, tambahkan PORT_NODE
            if (socketUrl && !socketUrl.includes(':' + portNode) && !socketUrl.match(/:\d+$/)) {
                // Hapus trailing slash jika ada
                socketUrl = socketUrl.replace(/\/$/, '');
                // Tambahkan port
                socketUrl = socketUrl + ':' + portNode;
            }
            socket = io(socketUrl, {
                transports: ['websocket', 'polling'],
                reconnection: true,
                reconnectionDelay: 2000, // Increased from 1000 to 2000
                reconnectionDelayMax: 10000, // Max delay between reconnection attempts
                reconnectionAttempts: 10, // Increased from 5 to 10
                timeout: 30000, // Connection timeout
                forceNew: false, // Reuse existing connection if available
                upgrade: true, // Allow transport upgrades
                rememberUpgrade: true, // Remember transport upgrade
            });
        } else {
            socket = io(socketUrl, {
                transports: ['websocket', 'polling', 'flashsocket'],
                reconnection: true,
                reconnectionDelay: 2000,
                reconnectionDelayMax: 10000,
                reconnectionAttempts: 10,
                timeout: 30000,
            });
        }

        // Handle connection errors
        socket.on('connect_error', (error) => {
            console.error('Socket connection error:', error);
            $('#connection-status').text('Connection Error');
            $('.statusss').html(`<button class="inline-flex items-center px-6 py-3 bg-red-600 text-white text-sm font-medium rounded-lg cursor-not-allowed opacity-75" disabled>
                <i class="bi bi-exclamation-triangle mr-2"></i>
                Connection Error: ${error.message || 'Service Unavailable. Retrying...'}
            </button>`);
        });

        socket.on('connect', () => {
            console.log('Socket connected successfully');
            $('#connection-status').text('Connected');
            // Emit StartConnection after successful connection
            socket.emit('StartConnection', '{{ $number->body }}');
        });

        socket.on('disconnect', (reason) => {
            console.log('Socket disconnected:', reason);
            if (reason === 'io server disconnect') {
                // Server disconnected, need to reconnect manually
                socket.connect();
            }
        });

        socket.on('error', (error) => {
            console.error('Socket error:', error);
            $('#connection-status').text('Error');
            $('.statusss').html(`<button class="inline-flex items-center px-6 py-3 bg-red-600 text-white text-sm font-medium rounded-lg cursor-not-allowed opacity-75" disabled>
                <i class="bi bi-exclamation-triangle mr-2"></i>
                ${error.message || 'An error occurred. Please refresh the page.'}
            </button>`);
        });

        // Wait for connection before emitting
        if (socket.connected) {
            socket.emit('StartConnection', '{{ $number->body }}');
        }
        socket.on('qrcode', ({
            token,
            data,
            message
        }) => {
            if (token == device) {
                let url = data
                $('.imageee').html(`<div class="w-80 h-80 mx-auto bg-white rounded-xl flex items-center justify-center shadow-lg">
                    <img src="${url}" class="max-w-full max-h-full rounded-lg" alt="QR Code">
                </div>`)
                $('#connection-status').text('QR Code Ready')
                $('.statusss').html(`<button class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white text-sm font-medium rounded-lg cursor-not-allowed opacity-75" disabled>
                    <i class="bi bi-qr-code mr-2"></i>
                    ${message}
                </button>`)
            }
        })
        socket.on('connection-open', ({
            token,
            user,
            ppUrl
        }) => {
            if (token == device) {
                $('.name').text(user.name)
                $('.number').text(user.id)
                $('.device').text(`Not detected - ${token}`)
                $('#connection-status').text('Connected')
                $('.imageee').html(`<div class="w-80 h-80 mx-auto bg-white rounded-xl flex items-center justify-center shadow-lg">
                    <img src="${ppUrl}" class="max-w-full max-h-full rounded-lg" alt="Profile Picture">
                </div>`)
                $('.statusss').html(`<button class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-sm font-medium rounded-lg cursor-not-allowed opacity-75" disabled>
                    <i class="bi bi-check-circle mr-2"></i>
                    {{ __('Connected') }}
                </button>`)
                $('.logoutbutton').html(`<button class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors" onclick="logout({{ $number->body }})">
                    <i class="bi bi-box-arrow-right mr-2"></i>
                    {{ __('Logout') }}
                </button>`)
            }
        })

        socket.on('Unauthorized', ({
            token
        }) => {
            if (token == device) {
                $('#connection-status').text('Unauthorized')
                $('.statusss').html(`<button class="inline-flex items-center px-6 py-3 bg-red-600 text-white text-sm font-medium rounded-lg cursor-not-allowed opacity-75" disabled>
                    <i class="bi bi-exclamation-triangle mr-2"></i>
                    {{ __('Unauthorized') }}
                </button>`)
            }
        })
        socket.on('message', ({
            token,
            message
        }) => {
            if (token == device) {
                $('#connection-status').text('Connected')
                $('.statusss').html(`<button class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-sm font-medium rounded-lg cursor-not-allowed opacity-75" disabled>
                    <i class="bi bi-check-circle mr-2"></i>
                    ${message}
                </button>`);
                //if there is text connection close in message
                if (message.includes('Connection closed')) {
                    // count 5 second
                    let count = 5;
                    //set interval
                    let interval = setInterval(() => {
                        //if count is 0
                        if (count == 0) {
                            //clear interval
                            clearInterval(interval);
                            //reload page
                            location.reload();
                        }
                        //change text
                        $('#connection-status').text('Disconnecting')
                        $('.statusss').html(`<button class="inline-flex items-center px-6 py-3 bg-orange-600 text-white text-sm font-medium rounded-lg cursor-not-allowed opacity-75" disabled>
                            <i class="bi bi-hourglass-split mr-2"></i>
                            ${message} in ${count} second
                        </button>`);
                        //count down
                        count--;
                    }, 1000);
                }
            }
        });

        function logout(device) {
            socket.emit('LogoutDevice', device)
        }
    }
</script>
