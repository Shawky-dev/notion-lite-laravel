<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskComment extends Model
{
    use SoftDeletes;

    protected $fillable = ['text', 'parent_id', 'task_id'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
