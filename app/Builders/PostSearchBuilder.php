<?php

namespace App\Builders;

use App\Enums\SearchCondition;
use App\Models\Post;
use Carbon\Carbon;
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

        if (isset($params['start_date'], $params['end_date'])) {
            $start_date = Carbon::parse($params['start_date'])->startOfDay();
            $end_date = Carbon::parse($params['end_date'])->endOfDay();
            
            $query->whereBetween('created_at', [$start_date, $end_date]);
        } elseif(isset($params['start_date'])) {
            $start_date = Carbon::parse($params['start_date'])->startOfDay();

            $query->where('created_at', '>=', $start_date); 
        } elseif(isset($params['end_date'])) {
            $end_date = Carbon::parse($params['end_date'])->endOfDay();

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