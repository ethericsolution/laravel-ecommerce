<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchUser extends Model
{
    /* public $timestamps = false; */

    use HasFactory;

    protected $table = 'search_user';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'search_id',
        'search_count',
    ];
}
