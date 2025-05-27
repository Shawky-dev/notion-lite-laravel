<?php

namespace App\Http\Requests\Board;

use Illuminate\Foundation\Http\FormRequest;

class CreateBoardRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:4'],
            'description' => ['required', 'string', 'min:4'],
        ];
    }
}
