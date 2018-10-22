<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $hidden = ['id', 'status', 'user_id','created_at', 'updated_at'];
    protected $visible = ['title', 'content', 'slug'];
}
