<?php

namespace App\Livewire\Components;

use App\Services\BoardServices;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddBoard extends Component
{
    public $title = '';
    public $description = '';

    public function create(BoardServices $boardServices)
    {
        $data = ['title' => $this->title, 'description' => $this->description];
        $boardServices->store($data, Auth::user());

        Flux::modal('add-board')->close();

        $this->dispatch('board-created');
    }

    public function render()
    {
        return view('livewire.components.add-board');
    }
}
