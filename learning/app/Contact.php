<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $table = 'contacts';
    protected $fillable = ['name', 'email', 'message'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $dates = ['deleted_at'];

    //change your primary key
    //protected $primaryKey = 'contact_id';

    //disable timestamps
    //protected $timestamps = false;

//    public function getAllContacts()
//    {
//        $allContacts = Contact::all();
//
//        return $allContacts;
//    }


}
