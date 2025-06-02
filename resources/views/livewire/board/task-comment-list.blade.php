<div class="flex flex-col space-y-3">
    <div class="overflow-y-scroll">
        @foreach ($parent_comments as $comment)
        @livewire('board.task-comment', ['comment' => $comment], key($comment->id))
        @endforeach
    </div>
    <flux:separator />
    @if($replying)
    <h1>replying to {{$parent['text']}}</h1>
    @endif
    <flux:field>
        <flux:label>post a comment</flux:label>
        <flux:input wire:model="text" />
        <flux:error name="username" />
    </flux:field>


    <flux:button wire:click="postComment">add comment</flux:button>
</div>