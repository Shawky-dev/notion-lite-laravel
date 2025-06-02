<?php

namespace App\Livewire\Board;

use App\Models\Board;
use App\Models\User;
use Livewire\Attributes\On;
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

    #[On('user-added-to-board')]
    public function updateMembersList($boardId)
    {
        if ($this->board->id === $boardId) {
            $this->user_bubbles = $this->board->users()->take(4)->get();
        }
    }

    public function render()
    {
        return view('livewire.board.members-list');
    }
}
