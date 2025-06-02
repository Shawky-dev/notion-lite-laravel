<?php

namespace App\Livewire\Board;

use App\Models\Board;
use App\Models\User;
use App\Services\BoardServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddUser extends Component
{
    public Board $board;
    public $users;
    public $members;

    public function mount(Board $board)
    {
        $this->board = $board;
        $this->users = User::whereNotIn('id', $this->board->users->pluck('id'))->get();
        $this->members = $board->users()
            ->where('users.id', '!=', Auth::id())
            ->get();
    }

    public function addUser(User $user, BoardServices $boardServices)
    {
        $boardServices->addUser($this->board, Auth::user(), $user);

        $this->users = User::whereNotIn('id', $this->board->users->pluck('id'))->get();
        $this->members = $this->board->users()
            ->where('users.id', '!=', Auth::id())
            ->get();

        $this->dispatch('user-added-to-board', boardId: $this->board->id);
    }

    public function removeUser(User $user, BoardServices $boardServices)
    {
        $boardServices->removeUser($this->board, Auth::user(), $user);

        $this->users = User::whereNotIn('id', $this->board->users->pluck('id'))->get();
        $this->members = $this->board->users()
            ->where('users.id', '!=', Auth::id())
            ->get();

        $this->dispatch('user-added-to-board', boardId: $this->board->id);
    }


    public function render()
    {
        return view('livewire.board.add-user');
    }
}
