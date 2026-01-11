<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Management System - Education Department</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Tailwind with custom config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                        secondary: {
                            600: '#16a34a',
                            700: '#15803d',
                        }
                    },
                    boxShadow: {
                        'card': '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                        'button': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                        'button-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            background-attachment: fixed;
            background-size: cover;
            background-image: url('{{ asset("assets/background.png") }}');
            
        }
        .btn-transition {
            transition: all 0.3s ease;
        }
        .btn-transition:hover {
            transform: translateY(-1px);
        }
        .card {
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.95);
        }
        .logo-icon {
            background: linear-gradient(135deg, #ffffffff 0%, #ffffffff 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-10 animate-fade-in-down">
            <div class="flex justify-center ">
                <x-application-logo class="h-20 w-auto" />
            </div>
            <div class="flex justify-center mb-4">
                <h1 class="text-5xl font-extrabold logo-icon">
                    ESDFP
                </h1>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                Project Management System
            </h1>
            <p class="text-gray-600 text-lg">
                Education Department -  Southern Province
            </p>
        </div>

        <!-- Card -->
        <div class="card bg-white rounded-xl shadow-card border border-gray-100 p-8 animate-fade-in-up">
            @if (Route::has('login') || Route::has('register'))
                @auth
                    <div class="text-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="text-gray-700 mb-6">
                            You are already logged in
                        </p>

                        <a href="{{ url('/dashboard') }}"
                            class="block w-full py-3 px-4 text-center bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg shadow-button hover:shadow-button-hover btn-transition">
                            Go to Dashboard
                        </a>
                    </div>
                @else
                    <div class="space-y-5">
                        <a href="{{ route('login') }}"
                            class="block w-full py-3 px-4 text-center bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg shadow-button hover:shadow-button-hover btn-transition">
                            Log In
                        </a>

                        @if (Route::has('register'))
                            <p class="text-center text-sm text-gray-500 mt-4 mb-2">
                                Don't have an account?
                            </p>

                            <a href="{{ route('register') }}"
                                class="block w-full py-3 px-4 text-center bg-secondary-600 hover:bg-secondary-700 text-white font-medium rounded-lg shadow-button hover:shadow-button-hover btn-transition">
                                Register
                            </a>
                        @endif
                    </div>
                @endauth
            @endif
        </div>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-500 mt-8 animate-fade-in">
            © {{ date('Y') }} Education Department • Project Management System
        </p>
    </div>

    <!-- Animation script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Add animation classes
            const elements = document.querySelectorAll('.animate-fade-in-down, .animate-fade-in-up, .animate-fade-in');
            elements.forEach(el => {
                el.classList.add('opacity-0');
                setTimeout(() => {
                    el.classList.remove('opacity-0');
                    el.classList.add('transition-opacity', 'duration-500');
                }, 100);
            });
            
            // Button hover effects
            const buttons = document.querySelectorAll('.btn-transition');
            buttons.forEach(btn => {
                btn.addEventListener('mouseenter', () => {
                    btn.classList.add('transform', 'transition', 'duration-200');
                });
                btn.addEventListener('mouseleave', () => {
                    btn.classList.remove('transform', 'transition', 'duration-200');
                });
            });
        });
    </script>
</body>
</html>