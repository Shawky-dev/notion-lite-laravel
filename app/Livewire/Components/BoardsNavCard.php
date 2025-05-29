<?php

namespace App\Livewire\Components;

use Livewire\Component;

class BoardsNavCard extends Component
{
    public $isSelected = false;
    public $boardId;
    public $boardTitle = '';
    public $boardTasksCount = 0;
    public $boardMembersCount = 0;

    public function click()
    {
        return redirect()->route('boards.show', ['board' => $this->boardId]);
    }

    public function mount($board, $isSelected = false)
    {
        $this->boardId = $board->id;
        $this->isSelected = $isSelected;
        $this->boardTitle = $board->title;
        foreach ($board->sections as $section) {
            $this->boardTasksCount += $section->tasks()->count();
        }
        $this->boardMembersCount = $board->users()->count();
    }

    public function render()
    {
        return view('livewire.components.boards-nav-card');
    }
}
