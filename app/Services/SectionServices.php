<?php

namespace App\Services;

use App\Models\Board;
use App\Models\Section;
use App\Models\User;
use App\Services\utils\BoardRelatedServices;

class SectionServices extends BoardRelatedServices
{
    public function store(array $data, Board $board, User $user): Section
    {
        $this->AuthUserForBoard($board, $user, 'User not permitted to add a section to this board');
        $data['board_id'] = $board->id;
        return Section::create($data);
    }
    public function update(array $data, Section $section, User $user): Section
    {
        $board = $section->board;
        $this->AuthUserForBoard($board, $user, 'User not permitted to update a section to this board');
        $section->title = $data['title'];
        $section->save();
        return $section;
    }
    public function destroy(Section $section, User $user): void
    {
        $board = $section->board;
        $this->AuthUserForBoard($board, $user, 'User not permitted to update a section to this board');
        $section->delete();
    }
}
