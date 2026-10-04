@props([
    'chats'
])

<div {{ $attributes->merge(['class' => 'flex w-full flex-col gap-4']) }}>

    @forelse ($chats as $chat)
        <div class="flex items-start gap-4 bg-white rounded-lg shadow-md p-6 w-full">

            <img src="{{ $chat->avatar_url }}"
                 alt="{{ $chat->user?->name ?? 'Unknown User' }}"
                 loading="lazy"
                 class="size-12 shrink-0 rounded-full object-cover">

            <div class="min-w-0">
                <h2 class="text-lg font-semibold text-gray-900">
                    {{ $chat->user?->name ?? 'Unknown User' }}
                </h2>

                <p class="mt-1 text-gray-500">
                    {{ $chat->message }}
                </p>

                <p class="mt-2 text-sm text-gray-400">
                    {{ $chat->created_at->diffForHumans() }}
                    @if($chat->updated_at && $chat->updated_at->gt($chat->created_at))

                     ... edited

                @endif
                </p>

      @can('update', $chat)
        <div class="mt-3 flex items-center gap-4">
                    <a href="{{ route('chats.edit', $chat) }}"
                       class="text-sm font-medium text-gray-600 hover:text-gray-900">
                        Edit
                    </a>

                    <form method="POST" action="{{ route('chats.destroy', $chat) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" onclick="return confirm('Are you sure you want to delete this chat?')"
                                class="text-sm font-medium text-red-600 hover:text-red-800">
                            Delete
                        </button>
                    </form>

                </div>
      @endcan

            </div>

        </div>
    @empty
        <p class="text-gray-500">No chats available.</p>
    @endforelse

</div>
