<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\ChangeTaskArchive1Request;
use App\Http\Requests\Task\ChangeTaskStatusRequest;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Models\Section;
use App\Models\Task;
use App\Services\TaskServices;
use Illuminate\Http\Request;

class TaskController extends ApiController
{
    protected $taskServices;

    public function __construct(TaskServices $taskServices)
    {
        $this->taskServices = $taskServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request, Section $section)
    {
        $newTask = $this->taskServices->store($request->all(), $section, $request->user());
        $success['task'] = $newTask;
        return $this->sendResponse($success, 'Create a new task successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Task $task)
    {
        $task = $this->taskServices->show($task, $request->user());
        $success['task'] = $task;
        return $this->sendResponse($success, 'Task retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(ChangeTaskStatusRequest $request, Task $task)
    {
        $updatedTask = $this->taskServices->update($request->all(), $task, $request->user());
        $success['task'] = $updatedTask;
        return $this->sendResponse($success, 'Task updated successfully');
    }
    public function updateArchive(ChangeTaskArchive1Request $request, Task $task)
    {
        $updatedTask = $this->taskServices->update($request->all(), $task, $request->user());
        $success['task'] = $updatedTask;
        return $this->sendResponse($success, 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        $this->taskServices->destroy($task, $request->user());
        return $this->sendResponse([], 'Task deleted successfully');
    }
}
