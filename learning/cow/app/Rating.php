<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class Rating extends Model
{
    protected $fillable = ['book_id', 'user_id', 'rating'];
    protected $hidden = ['id'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
