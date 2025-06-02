<?php

namespace App\Livewire\Board;

use App\Models\Task;
use App\Services\TaskServices;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskComponent extends Component
{
    public Task $task;

    public function mount(Task $task)
    {
        $this->task = $task;
    }
    public function deleteTask(TaskServices $taskServices)
    {
        $taskServices->destroy($this->task, Auth::user());

        Flux::modals()->close();

        $this->dispatch("task-created.{$this->task->section_id}");
    }

    public function render()
    {
        return view('livewire.board.task-component');
    }
}
