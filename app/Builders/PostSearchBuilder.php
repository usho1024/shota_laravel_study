<?php

namespace App\Builders;

use App\Enums\SearchCondition;
use App\Models\Post;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
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

        if (!$params) {
            return $query;
        }

        $start_date = isset($params['start_date']) ? CarbonImmutable::parse($params['start_date'])->startOfDay() : null;
        $end_date = isset($params['end_date']) ? CarbonImmutable::parse($params['end_date'])->endOfDay() : null;

        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        } elseif ($start_date) {
            $query->where('created_at', '>=', $start_date);
        } elseif ($end_date) {
            $query->where('created_at', '<=', $end_date);
        }

        if (isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $condition = $params['condition'];

            if ($condition === SearchCondition::TitleOrContent->value) {
                $query->where(function (Builder $subQuery) use ($keyword) {
                    $subQuery->where('title', 'LIKE', "%{$keyword}%")
                            ->orWhere('content', 'LIKE', "%{$keyword}%");
                });
            }
    
            if ($condition === SearchCondition::Title->value) {
                $query->where(function (Builder $subQuery) use ($keyword) {
                    $subQuery->where('title', 'LIKE', "%{$keyword}%");
                });
            }
    
            if ($condition === SearchCondition::Content->value) {
                $query->where(function (Builder $subQuery) use ($keyword) {
                    $subQuery->where('content', 'LIKE', "%{$keyword}%");
                });
            }
        }

        return $query;
    }
}