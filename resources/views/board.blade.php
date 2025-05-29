<x-layouts.app :title="__('Dashboard')">
    @livewire('board.board-component', ['board' => $board], key($board->id))
</x-layouts.app>
