<x-layout>
    <x-slot name="title">
        Chat - Edit message
    </x-slot>

    <div class="mx-auto flex w-full max-w-5xl flex-col gap-8">

        <form method="POST" action="{{ route('chats.update', $chat) }}"
              class="flex w-full flex-col gap-2 bg-white rounded-lg shadow-md p-6">

            @csrf
            @method('PATCH')

            <label for="message" class="text-sm font-medium text-gray-700">
                Your message
            </label>

            <textarea id="message"
                      name="message"
                      rows="3"
                      maxlength="255"
                      required
                      class="w-full rounded-md border border-gray-300 p-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500">{{ old('message', $chat->message) }}</textarea>

            @error('message')
                <p class="text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('home') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-100">
                    Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Save
                </button>
            </div>

        </form>

    </div>
</x-layout>