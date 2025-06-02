<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'section_id', 'user_id', 'status', 'archive'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function addTaskComment(TaskComment $comment): TaskComment
    {
        $this->comments()->save($comment);
        return $comment;
    }
}
