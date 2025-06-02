<?php

namespace App\Livewire\Board;

use App\Models\Section;
use App\Services\SectionServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class SectionCard extends Component
{
    public $section;
    public $tasks;

    public function mount(Section $section)
    {
        $this->section = $section;
        $this->tasks = $section->tasks()->get();
    }
    public function delete(SectionServices $sectionServices)
    {
        $sectionServices->destroy($this->section, Auth::user());
        $this->dispatch('section-created')->to('board.section-list');
    }

    #[On('tasks-updated.{section.id}')]
    public function refreshSection()
    {
        $this->section = $this->section->refresh();
        $this->tasks = $this->section->tasks()->get();
    }

    public function render()
    {

        return view(
            'livewire.board.section-card',
            ['section' => $this->section]
        );
    }
}
