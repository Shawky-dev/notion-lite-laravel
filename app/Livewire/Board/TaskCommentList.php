<?php

namespace App\Livewire\Board;

use App\Models\Task;
use App\Services\TaskCommentServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskCommentList extends Component
{
    public Task $task;
    public $parent_comments;
    public $parent = null;
    public $text = '';
    public $replying = false;

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->parent_comments = $task->comments()->whereNull('parent_id')->get();
    }
    #[On('reply-to-comment')]
    public function reply($comment)
    {
        $this->parent = $comment;
        $this->replying = true;
    }

    public function postComment(TaskCommentServices $taskCommentServices)
    {
        $data = [
            'text' => $this->text,
            'parent_id' => $this->parent ? $this->parent['id'] : null,
        ];

        $taskCommentServices->store($data, $this->task, Auth::user());

        $this->parent_comments = $this->task->comments()->whereNull('parent_id')->get();
        $this->dispatch('comments-update');
        $this->text = '';
    }

    public function render()
    {
        return view('livewire.board.task-comment-list');
    }
}
