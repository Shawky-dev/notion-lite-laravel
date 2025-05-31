<?php

namespace App\Livewire\Board;

use App\Models\Task;
use App\Models\User;
use App\Services\TaskServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskCard extends Component
{
    public Task $task;
    public User $user;
    public bool $showArchive = false;

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->user = User::find($task->user_id);
    }

    public function changeTaskStatus(TaskServices $taskServices)
    {
        $data = ['status' => !$this->task->status];
        $newTask = $taskServices->update($data, $this->task, Auth::user());
    }

    public function render()
    {
        return view('livewire.board.task-card');
    }
}
