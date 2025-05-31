<?php

namespace App\Livewire\Board;

use App\Models\Section;
use Livewire\Component;

class SectionCard extends Component
{
    public $section;

    public function mount(Section $section)
    {
        $this->section = $section;
    }

    public function render()
    {
        return view('livewire.board.section-card');
    }
}
