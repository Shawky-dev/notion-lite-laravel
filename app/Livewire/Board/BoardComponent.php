<?php

namespace App\Livewire\Board;

use App\Models\Board;
use Livewire\Component;

class BoardComponent extends Component
{
    public Board $board;

    public function mount(Board $board)
    {
        $this->board = $board;
    }

    public function render()
    {
        return view('livewire.board.board-component');
    }
}
