<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Book extends Model
{
    protected $fillable = ['user_id', 'title', 'description'];

    protected $hidden = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMay(Rating::class);
    }
}
