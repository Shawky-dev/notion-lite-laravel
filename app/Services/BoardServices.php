<?php

namespace App\Services;

use App\Models\Board;
use App\Models\User;
use App\Services\utils\BoardRelatedServices;
use Illuminate\Auth\Access\AuthorizationException;

class BoardServices extends BoardRelatedServices
{

    public function store(array $data, User $creatorUser): Board
    {
        return Board::createWithCreator($data, $creatorUser);
    }
    public function update(array $data, Board $board, User $user): Board
    {
        $this->handleNonAuth($board, $user, 'You are not authorized to update this board.');

        $board->fill($data);
        $board->save();
        return $board;
    }
    public function destroy(Board $board, User $user): void
    {
        $this->handleNonAuth($board, $user, 'You are not authorized to delete this board.');

        $board->delete();
    }
    public function show(Board $board, User $user): Board
    {
        $this->handleNonAuth($board, $user, 'You are not authorized to view this board.');
        $board->load(['users', 'sections.tasks']);
        return $board;
    }
    public function addUser(Board $board, User $board_user, User $new_user)
    {
        $this->handleNonAuth($board, $board_user, 'You are not authorized to add people to this board.');
        $board->addUser($new_user);
    }
}
