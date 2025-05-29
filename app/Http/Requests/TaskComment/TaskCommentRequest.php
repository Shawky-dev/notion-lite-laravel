<?php

namespace App\Http\Requests\TaskComment;

use Illuminate\Foundation\Http\FormRequest;

class TaskCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'min:4', 'max:509'],
            'parent_id' => ['nullable', 'integer', 'exists:task_comments,id'],
        ];
    }
}
