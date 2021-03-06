<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Search extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'searchs';
    protected $fillable = ['search', 'user_id', 'type', 'message', 'x', 'y'];
}
