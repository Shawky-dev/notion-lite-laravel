<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Board\CreateBoardRequest;
use App\Http\Requests\Board\UpdateBoardRequest;
use App\Models\Board;
use App\Models\User;
use App\Services\BoardServices;
use Illuminate\Http\Request;

class BoardController extends ApiController
{
    protected $boardServices;


    public function __construct(BoardServices $boardServices)
    {
        $this->boardServices = $boardServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBoardRequest $request)
    {
        $newBoard = $this->boardServices->store($request->all(), $request->user());
        $success['board'] = $newBoard;
        return $this->sendResponse($success, 'create a board successfully');
    }

    /**
     * Display the specified resource.k
     */
    public function show(Board $board, Request $request)
    {
        $board = $this->boardServices->show($board, $request->user());
        $success['board'] = $board;
        return $this->sendResponse($success, 'Board retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoardRequest $request, Board $board)
    {
        $updatedBoard = $this->boardServices->update($request->all(), $board, $request->user());
        $success['board'] = $updatedBoard;
        return $this->sendResponse($success, 'Board updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board, Request $request)
    {
        $this->boardServices->destroy($board, $request->user());
        return $this->sendResponse([], 'Board deleted successfully');
    }
    public function addUser(Board $board, User $new_user, Request $request)
    {
        $this->boardServices->addUser($board, $request->user(), $new_user);

        $success['board'] = $board->fresh(['users']);
        return $this->sendResponse($success, 'User added to board successfully');
    }
}
