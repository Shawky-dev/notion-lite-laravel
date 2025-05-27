<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskComment;
use App\Models\User;
use App\Services\utils\BoardRelatedServices;

class TaskCommentServices extends BoardRelatedServices
{
    public function store(array $data, Task $task, User $user): TaskComment
    {
        $board = $task->section->board;
        $this->AuthUserForBoard($board, $user, 'user not authorized to comment on this board');
        $data['task_id'] = $task->id;
        $comment = TaskComment::create($data);
        $task->addTaskComment($comment);
        return $comment;
    }
    public function destroy(TaskComment $taskComment, User $user): void
    {
        $task = $taskComment->task;
        $board = $task->section->board;
        $this->AuthUserForBoard($board, $user, 'user not authorized to delete comment on this board');
        $taskComment->delete();
    }
}
