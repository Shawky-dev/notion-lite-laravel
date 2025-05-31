<?php

namespace App\Livewire\Board;

use App\Http\Requests\Task\ChangeTaskStatusRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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

        $validator = Validator::make($data, (new ChangeTaskStatusRequest())->rules());

        if ($validator->fails()) {
            $this->addError('status', $validator->errors()->first('status'));
            return;
        }

        $taskServices->update($data, $this->task, Auth::user());
    }

    public function render()
    {
        return view('livewire.board.task-card');
    }
}
