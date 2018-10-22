<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'status', 'user_id'];
    protected $hidden = ['id', 'status', 'user_id','created_at', 'updated_at'];
    protected $visible = ['title', 'content', 'slug'];
}
