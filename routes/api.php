<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BoardController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\TaskCommentController;
use App\Http\Controllers\Api\TaskController;
use App\Services\BoardServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hi', function (): JsonResponse {
    return response()->json(['1' => 1]);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//__Boards__
Route::post('/board/create', [BoardController::class, 'store'])->middleware('auth:sanctum');
Route::get('/board/{board}', [BoardController::class, 'show'])->middleware('auth:sanctum');
Route::put('/board/{board}', [BoardController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/board/{board}', [BoardController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/board/{board}/users/{new_user}', [BoardController::class, 'addUser'])->middleware('auth:sanctum');
//__Section__
Route::post('/section/create/{board}', [SectionController::class, 'store'])->middleware('auth:sanctum');
Route::put('/section/{section}', [SectionController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/section/{section}', [SectionController::class, 'destroy'])->middleware('auth:sanctum');

//__Task__
Route::post('/task/create/{section}', [TaskController::class, 'store'])->middleware('auth:sanctum');
Route::put('/task/{task}', [TaskController::class, 'update'])->middleware('auth:sanctum');
Route::put('/task/status/{task}', [TaskController::class, 'updateStatus'])->middleware('auth:sanctum');
Route::put('/task/archive/{task}', [TaskController::class, 'updateArchive'])->middleware('auth:sanctum');
Route::delete('/task/{task}', [TaskController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/task/{task}', [TaskController::class, 'show'])->middleware('auth:sanctum');

//__Task Comment__
Route::post('/taskComment/create/{task}', [TaskCommentController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/taskComment/{comment}', [TaskCommentController::class, 'updateComment'])->middleware('auth:sanctum');
