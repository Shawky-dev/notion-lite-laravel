<?php

namespace App\Livewire\Board;

use App\Models\Board;
use App\Models\User;
use Livewire\Component;

class MembersList extends Component
{
    public Board $board;
    public $user_bubbles;

    public function mount(Board $board)
    {
        $this->board = $board;
        $this->user_bubbles = $board->users()->take(4)->get();
    }
    public function render()
    {
        return view('livewire.board.members-list');
    }
}
