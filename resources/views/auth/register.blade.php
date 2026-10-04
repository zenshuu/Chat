<x-layout>
    <x-slot name="title">
        Chat - Register
    </x-slot>

    <div class="mx-auto flex w-full max-w-md flex-col gap-6">

        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-900">
                Create your account
            </h1>

            <form method="POST" action="{{ route('register') }}" class="mt-6 flex flex-col gap-4">

                @csrf

                <div class="flex flex-col gap-1">
                    <label for="name" class="text-sm font-medium text-gray-700">
                        Name
                    </label>

                    <input id="name"
                           name="name"
                           type="text"
                           value="{{ old('name') }}"
                           required
                           autofocus
                           autocomplete="name"
                           class="w-full rounded-md border border-gray-300 p-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500">

                    @error('name')
                        <p class="text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <input id="email"
                           name="email"
                           type="email"
                           value="{{ old('email') }}"
                           required
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
                           autocomplete="new-password"
                           class="w-full rounded-md border border-gray-300 p-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500">

                    @error('password')
                        <p class="text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password_confirmation" class="text-sm font-medium text-gray-700">
                        Confirm password
                    </label>

                    <input id="password_confirmation"
                           name="password_confirmation"
                           type="password"
                           required
                           autocomplete="new-password"
                           class="w-full rounded-md border border-gray-300 p-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500">

                    @error('password_confirmation')
                        <p class="text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Register
                </button>

            </form>
        </div>

        <p class="text-center text-sm text-gray-500">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800">
                Sign in
            </a>
        </p>

    </div>
</x-layout>