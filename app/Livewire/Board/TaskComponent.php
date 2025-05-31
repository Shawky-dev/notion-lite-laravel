<?php

namespace App\Livewire\Board;

use App\Models\Task;
use Livewire\Component;

class TaskComponent extends Component
{
    public Task $task;

    public function mount(Task $task)
    {
        $this->task = $task;
    }

    public function render()
    {
        return view('livewire.board.task-component');
    }
}
