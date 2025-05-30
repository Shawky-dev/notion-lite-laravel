<x-layouts.app :title="__('Board')">
    @livewire('board.board-component', ['board' => $board], key($board->id))
</x-layouts.app>
