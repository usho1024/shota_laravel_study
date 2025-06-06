<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->withTrashed()->where($field ?? 'id', $value)->firstOrFail();
    }

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * 自分が管理できる削除されたPostなのか
     *
     * @return bool
     */
    public function isManageableHiddenPost(): bool
    {
        return Gate::allows('manage-post', $this) && $this->is_hidden;
    }

    /**
     * 自分が管理できない削除されたPostなのか
     *
     * @return bool
     */
    public function isUnmanageableHiddenPost(): bool
    {
        return Gate::denies('manage-post', $this) && $this->is_hidden;
    }
}
