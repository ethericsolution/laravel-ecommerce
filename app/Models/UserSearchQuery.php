<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserSearchQuery extends Model
{
    use HasUuids;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'search_query_id',
        'user_id',
        'count'
    ];
}
