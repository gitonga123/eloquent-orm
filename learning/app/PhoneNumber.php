<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    protected $table = 'phone_numbers';
    protected $fillable = ['owner_id', 'user_id', 'phone_number'];

    public function user()
    {
        return $this->belongsTo(User::class, 'phone_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'phone_id');
    }
}
