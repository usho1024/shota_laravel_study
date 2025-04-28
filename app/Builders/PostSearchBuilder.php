<?php

namespace App\Builders;

use App\Enums\SearchCondition;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostSearchBuilder
{
    /**
     * キーワード検索
     * 
     * @param array $params
     * @return Builder
    */
    public static function build(array $params): Builder
    {
        $query = Post::query();

        if (!isset($params['keyword'])) {
            return $query;
        }

        $keyword = $params['keyword'];

        if ($params['condition'] === SearchCondition::TitleOrContent->value) {
            $query->where(function (Builder $subQuery) use ($keyword) {
                $subQuery->where('title', 'LIKE', "%{$keyword}%")
                        ->orWhere('content', 'LIKE', "%{$keyword}%");
            });
        }

        if ($params['condition'] === SearchCondition::Title->value) {
            $query->where(function (Builder $subQuery) use ($keyword) {
                $subQuery->where('title', 'LIKE', "%{$keyword}%");
            });
        }

        if ($params['condition'] === SearchCondition::Content->value) {
            $query->where(function (Builder $subQuery) use ($keyword) {
                $subQuery->where('content', 'LIKE', "%{$keyword}%");
            });
        }

        return $query;
    }
}