<?php

namespace App\Services\utils;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class BoardRelatedServices
{
    public function AuthUserForBoard(Board $board, User $user, string $err_message)
    {
        if (!$board->users()->where('user_id', $user->id)->exists()) {
            throw new AuthorizationException($err_message);
        }
    }
}
