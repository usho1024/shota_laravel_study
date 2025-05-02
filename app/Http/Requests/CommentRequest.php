<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * バリーデーションのためにデータを準備
     */
    protected function prepareForValidation(): void
    {
        $parent_id = $this->input('parent_id');

        $this->errorBag = isset($parent_id) ? 'child' . $parent_id : 'parent';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => ['required'],
            'parent_id' => ['nullable'],
            'content' => ['max:100', 'min:10'],
        ];
    }

    public function attributes(): array
    {
        return [
            'content' => '本文',
        ];
    }
}
