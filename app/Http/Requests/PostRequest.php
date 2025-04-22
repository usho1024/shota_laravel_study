<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['max:30', 'min:5'],
            'content' => ['max:200', 'min:50'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'タイトル',
            'content' => '本文',
        ];
    }
}
