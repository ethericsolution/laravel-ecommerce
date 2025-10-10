<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SearchQuery extends Model
{
    use HasUuids;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'query',
        'count'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_search_queries')
            ->withPivot('count');
    }
}
