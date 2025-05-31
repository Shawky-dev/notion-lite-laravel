<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class BoardsNavList extends Component
{
    public $boards = [];
    public $selectedBoardId = null;

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->boards = $user->boards()->get();
    }


    #[On('board-created')]
    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->boards = $user->boards()->get();
        return view('livewire.components.boards-nav-list', [
            'boards' => $this->boards
        ]);
    }
}
