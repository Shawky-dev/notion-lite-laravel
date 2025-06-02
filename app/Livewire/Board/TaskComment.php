<?php

namespace App\Livewire\Board;

use App\Models\TaskComment as ModelsTaskComment;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskComment extends Component
{
    public ModelsTaskComment $comment;
    public $children = null;

    public function mount(ModelsTaskComment $comment)
    {
        $this->comment = $comment;
        $this->children = ModelsTaskComment::where('parent_id', $comment->id)->get();
    }


    public function reply()
    {
        $this->dispatch('reply-to-comment', comment: $this->comment);
    }
    #[On('comments-update')]
    public function refreshComments()
    {
        $this->children = ModelsTaskComment::where('parent_id', $this->comment->id)->get();
    }


    public function render()
    {
        return view('livewire.board.task-comment');
    }
}
