{{-- filepath: e:\Coding\Laravel\livewire-notion-lite\resources\views\components\task-comment.blade.php --}}
<div class="mb-4 pl-4 border-l-2 border-gray-300">
    {{-- Comment Content --}}
    <div class="flex justify-between items-start">
        <div>
            <p class="text-gray-100">{{ $comment->text }}</p>
            <small class="text-gray-100">Posted on {{ $comment->created_at->format('M d, Y') }}</small>
        </div>
        <button class="text-blue-2  00 hover:underline" wire:click="reply({{ $comment->id }})">Reply</button>
    </div>

    {{-- Nested Comments --}}
    @if($children)
    <div class="mt-4">
        @foreach ($children as $childComment)
        @livewire('board.task-comment', ['comment'=> $childComment], key($childComment->id))
        @endforeach
    </div>
    @endif
</div>