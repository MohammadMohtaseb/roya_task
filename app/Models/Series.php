<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'show_time',
        'thumbnail',
    ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_series_follows');
    }

    public function latestEpisodes($limit = 5)
    {
        return $this->episodes()->orderBy('created_at', 'desc')->limit($limit);
    }
}
