<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Web Admin - {{ config('app.name', 'GNS') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/gnslogo.png') }}" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'sans-serif'],
                    },
                },
            },
        }
    </script>

    <style>
        @keyframes rainbow-bg {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: rainbow-bg 15s ease infinite;
        }
    </style>
</head>

<body class="font-sans antialiased">
    
    <div class="relative min-h-screen flex items-center justify-center p-4 animated-gradient">
        
        <div class="relative w-full max-w-md p-8 lg:p-10 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-2xl shadow-2xl">
            
            <div class="flex justify-center mb-6">
                <svg class="h-14 w-auto text-blue-600 dark:text-blue-400" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M32.5 0C14.5492 0 0 14.5492 0 32.5C0 50.4508 14.5492 65 32.5 65C50.4508 65 65 50.4508 65 32.5C65 14.5492 50.4508 0 32.5 0ZM43.8333 46.2083L31.6667 38.8333V16.25H37.5V34.6667L46.2083 40.1667L43.8333 46.2083Z" fill="currentColor"/>
                </svg>
            </div>
            
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Web Admin Control Panel
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Please sign in to continue.
                </p>
            </div>

            @if (Route::has('login'))
                <div class="flex flex-col space-y-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="w-full text-center rounded-lg px-6 py-3 text-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-transform hover:scale-105"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="w-full text-center rounded-lg px-6 py-3 text-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-transform hover:scale-105"
                        >
                            Log In
                        </a>

                        {{-- @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="w-full text-center rounded-lg px-6 py-3 text-lg font-semibold text-blue-600 ring-2 ring-blue-600 hover:bg-blue-50 dark:text-blue-300 dark:ring-blue-400 dark:hover:bg-blue-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all"
                            >
                                Register
                            </a>
                        @endif --}}
                    @endauth
                </div>
            @endif

        </div>
    </div>
</body>
</html>