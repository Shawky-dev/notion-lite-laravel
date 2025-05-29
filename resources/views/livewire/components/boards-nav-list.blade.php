<div>
        <ul class="space-y-1.5">
            @foreach($boards as $board)
                @livewire('components.boards-nav-card',['board'=>$board,'isSelected'=>false], key($board->id))
            @endforeach
        </ul>
</div>