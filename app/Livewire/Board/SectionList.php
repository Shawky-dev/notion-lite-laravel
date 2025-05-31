<?php

namespace App\Livewire\Board;


use App\Models\Board;
use Livewire\Attributes\On;
use Livewire\Component;

class SectionList extends Component
{
    public Board $board;

    public function mount(Board $board)
    {
        $this->board = $board;
    }

    #[On('section-created')]
    public function refreshSections()
    {
        // The component will automatically re-render
    }

    public function render()
    {
        return view('livewire.board.section-list', [
            'sections' => $this->board->sections()->get()
        ]);
    }
}
