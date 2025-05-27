<?php

namespace App\Services;

use App\Models\Board;
use App\Models\Section;
use App\Models\Task;
use App\Models\User;
use App\Services\utils\BoardRelatedServices;

class TaskServices extends BoardRelatedServices
{
    public function store(array $data, Section $section, User $user): Task
    {
        $board = $section->board;
        $this->AuthUserForBoard($board, $user, 'User not permitted to add a task to this board');
        $data['section_id'] = $section->id;
        $data['user_id'] = $user->id;
        return Task::create($data);
    }
    public function update(array $data, Task $task, User $user): Task
    {
        $section = $task->section;
        $board = $section->board;
        $this->AuthUserForBoard($board, $user, 'User not permitted to update a task in this board');
        $task->fill($data);
        $task->save();
        return $task;
    }
    public function destroy(Task $task, User $user): void
    {
        $section = $task->section;
        $board = $section->board;
        $this->AuthUserForBoard($board, $user, 'User not permitted to delete a task in this board');
        $task->delete();
    }
    public function show(Task $task, User $user): Task
    {
        $section = $task->section;
        $board = $section->board;
        $this->AuthUserForBoard($board, $user, 'User not permitted to view this task in this board');
        return $task;
    }
}
