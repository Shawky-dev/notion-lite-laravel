<?php

namespace App\Services\utils;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class BoardRelatedServices
{
    public function AuthUserForBoard(Board $board, User $user): bool
    {
        if (!$board->users()->where('user_id', $user->id)->exists()) {
            return false;
        } else {
            return true;
        }
    }
    public function handleNonAuth(Board $board, User $user, string $errmsg)
    {
        $isAuthorized = $this->AuthUserForBoard($board, $user);
        if (!$isAuthorized) {
            throw new AuthorizationException($errmsg);
        }
    }
}
