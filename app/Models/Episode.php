<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'series_id',
        'title',
        'description',
        'duration',
        'airing_time',
        'thumbnail',
        'video_asset',
    ];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function likes()
    {
        return $this->hasMany(EpisodeLike::class);
    }

    public function userLike($userId)
    {
        return $this->likes()->where('user_id', $userId)->first();
    }

    public function likesCount()
    {
        return $this->likes()->where('is_like', true)->count();
    }

    public function dislikesCount()
    {
        return $this->likes()->where('is_like', false)->count();
    }
}
