<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login | MPWA MD version</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': {
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

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
        }

        .glass-effect {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.2);
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .blue-glow {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 floating-animation">
        </div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-25 floating-animation"
            style="animation-delay: 2s;"></div>
        <div class="absolute top-40 left-40 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation"
            style="animation-delay: 4s;"></div>
        <div class="absolute bottom-20 right-20 w-60 h-60 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-15 floating-animation"
            style="animation-delay: 1s;"></div>
    </div>

    <!-- Login Card -->
    <div class="relative w-full max-w-md">
        <!-- Glass Card -->
        <div class="glass-effect rounded-3xl p-8 shadow-2xl">
            <!-- Logo/Brand -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="bi bi-whatsapp text-3xl text-green-500"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Welcome Back</h1>

            </div>

            <!-- Alert Messages -->
            @if (session()->has('alert'))
                <div
                    class="mb-6 p-4 rounded-xl {{ session('alert')['type'] === 'success' ? 'bg-green-500/20 border border-green-500/30' : 'bg-red-500/20 border border-red-500/30' }} text-white">
                    <div class="flex items-center">
                        <i class="bi {{ session('alert')['type'] === 'success' ? 'bi-check-circle' : 'bi-exclamation-triangle' }} mr-2"></i>
                        {{ session('alert')['msg'] }}
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Username Field -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-medium text-white/90">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-person text-white/60"></i>
                        </div>
                        <input type="text" id="username" name="username"
                            class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('username') ? 'border-red-400' : '' }}"
                            placeholder="Enter your username" required>
                    </div>
                    @error('username')
                        <p class="text-red-300 text-sm mt-1 flex items-center">
                            <i class="bi bi-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-white/90">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-lock text-white/60"></i>
                        </div>
                        <input type="password" id="password" name="password"
                            class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-300 input-focus {{ $errors->has('password') ? 'border-red-400' : '' }}"
                            placeholder="Enter your password" required>
                    </div>
                    @error('password')
                        <p class="text-red-300 text-sm mt-1 flex items-center">
                            <i class="bi bi-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-white text-primary-600 font-semibold py-3 px-4 rounded-xl hover:bg-white/90 focus:outline-none focus:ring-2 focus:ring-white/30 transition-all duration-300 btn-hover">
                    <i class="bi bi-box-arrow-in-right mr-2"></i>
                    Sign In
                </button>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-white/80 text-sm">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-white font-semibold hover:text-white/80 transition-colors duration-200">
                            Sign up here
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-white/60 text-sm">© 2025 All rights reserved.</p>
        </div>
    </div>
</body>

</html>

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WA Gateway</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", Arial, sans-serif;
        }

        .center {
            text-align: center;
        }

        .wa-icon {
            font-size: 96px;
            color: #22c55e;
            /* green-500 */
            filter: drop-shadow(0 8px 24px rgba(0, 0, 0, 0.35));
        }

        .title {
            margin-top: 16px;
            color: #ffffff;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <meta name="robots" content="noindex,nofollow">
    <meta name="color-scheme" content="dark light">
    <meta name="theme-color" content="#1e3a8a">
</head>

<body>
    <div class="center" role="status" aria-live="polite">
        <i class="bi bi-whatsapp wa-icon" aria-hidden="true"></i>
        <div class="title">WA GATEWAY IS ONLINE</div>
    </div>
</body>

</html> --}}
