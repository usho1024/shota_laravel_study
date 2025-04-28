<?php

namespace App\Enums;

/**
 * 検索条件を表すEnum
 */
enum SearchCondition: string
{
    case TitleOrContent = 'title_or_content';
    case Title = 'title';
    case Content = 'content';

    /**
     * 日本語の表示ラベルを取得します。
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::TitleOrContent => 'タイトル OR 本文',
            self::Title          => 'タイトル',
            self::Content        => '本文',
        };
    }
}