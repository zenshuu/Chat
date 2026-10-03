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
                    <a href="#"
                       class="px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100 hover:text-gray-900">
                        Sign In
                    </a>

                    <a href="#"
                       class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Sign Up
                    </a>
                </div>

            </div>
        </div>
    </nav>


    <!-- Main -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 py-8">

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
