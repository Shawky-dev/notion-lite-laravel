<?php

namespace App\Livewire\Board;

use App\Http\Requests\Section\SectionRequest;
use App\Models\Board;
use App\Services\SectionServices;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AddSection extends Component
{
    public Board $board;

    public $title = '';
    public function create(SectionServices $sectionServices)
    {
        $data = ['title' => $this->title];

        $validator = Validator::make($data, (new SectionRequest())->rules());

        if ($validator->fails()) {
            $this->addError('title', $validator->errors()->first('title'));
            return;
        }
        $sectionServices->store($data, $this->board, Auth::user());
        Flux::modal('add-section')->close();

        $this->dispatch('section-created')->to('board.section-list');
    }
    public function mount(Board $board)
    {
        $this->$board = $board;
    }


    public function render()
    {
        return view('livewire.board.add-section');
    }
}
