<?php

namespace App\Livewire\Board;

use App\Models\Section;
use App\Services\SectionServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SectionCard extends Component
{
    public $section;

    public function mount(Section $section)
    {
        $this->section = $section;
    }
    public function delete(SectionServices $sectionServices)
    {
        $sectionServices->destroy($this->section, Auth::user());
        $this->dispatch('section-created')->to('board.section-list');
    }
    public function render()
    {
        return view('livewire.board.section-card');
    }
}
