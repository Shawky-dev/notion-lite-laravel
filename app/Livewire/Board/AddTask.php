<?php

namespace App\Livewire\Board;

use App\Models\Section;
use App\Services\TaskServices;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddTask extends Component
{
    public Section $section;
    public $title = '';
    public $description = '';

    public function mount(Section $section)
    {
        $this->section = $section;
    }
    public function create(TaskServices $taskServices)
    {
        $data = ['title' => $this->title, 'description' => $this->description];
        $taskServices->store($data, $this->section, Auth::user());

        Flux::modal('add-task-' . $this->section->id)->close();

        $this->dispatch("task-created.{$this->section->id}");
    }


    public function render()
    {

        return view('livewire.board.add-task');
    }
}
