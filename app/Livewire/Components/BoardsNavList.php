<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
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

    public function render()
    {
        return view('livewire.components.boards-nav-list');
    }
}
