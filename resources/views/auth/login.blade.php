<x-layout>
    <x-slot name="title">
        Chat - Login
    </x-slot>

    <div class="mx-auto flex w-full max-w-md flex-col gap-6">

        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-900">
                Sign in
            </h1>

            <form method="POST" action="{{ route('login') }}" class="mt-6 flex flex-col gap-4">

                @csrf

                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <input id="email"
                           name="email"
                           type="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="email"
                           class="w-full rounded-md border border-gray-300 p-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500">

                    @error('email')
                        <p class="text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password" class="text-sm font-medium text-gray-700">
                        Password
                    </label>

                    <input id="password"
                           name="password"
                           type="password"
                           required
                           autocomplete="current-password"
                           class="w-full rounded-md border border-gray-300 p-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500">

                    @error('password')
                        <p class="text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox"
                           name="remember"
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    Remember me
                </label>

                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Sign in
                </button>

            </form>
        </div>

        <p class="text-center text-sm text-gray-500">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-800">
                Sign up
            </a>
        </p>

    </div>
</x-layout>