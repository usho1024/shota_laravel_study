<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * 更新処理
     */
    public function updatePost($request, $book)
    {
        $result = $post->fill([
            'title' => $request->title,
            'content' => $request->content,
        ])->save();

        return $result;
    }
}
