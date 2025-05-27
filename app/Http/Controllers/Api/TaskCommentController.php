<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskComment\TaskCommentRequest;
use App\Models\Task;
use App\Models\TaskComment;
use App\Services\TaskCommentServices;
use Illuminate\Http\Request;

class TaskCommentController extends ApiController
{
    protected $taskCommentServices;

    public function __construct(TaskCommentServices $taskCommentServices)
    {
        $this->taskCommentServices = $taskCommentServices;
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
    public function store(TaskCommentRequest $request, Task $task)
    {
        $newComment = $this->taskCommentServices->store($request->all(), $task, $request->user());
        $success['comment'] = $newComment;
        return $this->sendResponse($success, 'Create a new comment successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, TaskComment $comment)
    {
        $this->taskCommentServices->destroy($comment, $request->user());
        return $this->sendResponse([], 'Comment deleted successfully');
    }
}
