<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'max:30|min:5',
            'content' => 'max:200|min:50',
        ];
    }

    public function messages(): array
    {
        return [
            'title.max' => 'タイトルは最大30文字で作成してください。',
            'title.min' => 'タイトルは5文字以上で作成してください。',
            'content.max' => '本文は最大200文字で作成してください。',
            'content.min' => '本文は50文字以上で作成してください。',
        ];
    }
}
