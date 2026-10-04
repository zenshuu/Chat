<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ isset($title) ? $title : 'Chat' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">

                <!-- Logo -->
                <div>
                    <a href="/" class="text-xl font-bold text-gray-800 hover:text-gray-600">
                        � Chat
                    </a>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-2">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                    class="px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100 hover:text-gray-900">
                                Sign Out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100 hover:text-gray-900">
                            Sign In
                        </a>

                        <a href="{{ route('register') }}"
                           class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Sign Up
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>


    <!-- Main -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 py-8">

        @if (session('success'))
            <div role="status" aria-live="polite"
                 class="fixed top-4 left-1/2 z-50 -translate-x-1/2 animate-fade-out">
                <div class="flex items-center gap-3 rounded-lg bg-green-600 px-4 py-3 text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{ $slot }}

    </main>


    <!-- Footer -->
    <footer class="bg-gray-200 text-gray-700 text-xs text-center p-5">

        <p>
            © 2025 Chat.
        </p>

    </footer>


</body>
</html>
