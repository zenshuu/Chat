<x-layout>
    <x-slot name="title">
        Chat - Home
    </x-slot>

    <div class="mx-auto flex w-full max-w-5xl flex-col gap-8">

        <form method="POST" action="{{ route('chats.store') }}"
              class="mx-auto flex w-full max-w-2xl flex-col gap-2 bg-white rounded-lg shadow-md p-6">

            @csrf

            <label for="message" class="text-sm font-medium text-gray-700">
                Your message
            </label>

            <textarea id="message"
                      name="message"
                      rows="3"
                      maxlength="1000"
                      required
                      placeholder="Write something..."
                      class="w-full rounded-md border border-gray-300 p-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500">{{ old('message') }}</textarea>

            @error('message')
                <p class="text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

            <button type="submit"
                    class="self-end px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Send
            </button>

        </form>

        <x-Chats :chats="$chats" class="mx-auto w-full" />

    </div>
</x-layout>
