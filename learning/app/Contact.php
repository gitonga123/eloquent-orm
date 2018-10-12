<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
class Contact extends Model
{
    use SoftDeletes;

    protected $table = 'contacts';
    protected $fillable = ['name', 'email', 'message'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $dates = ['deleted_at'];

    //a local scope that retrieves only recent email
    public function scopeRecentEmails($query)
    {
        return $query->where('created_at', '>', Carbon::now()->subDay());
    }

    // a local scope that accepts a parameter
    public function scopeStatus($query, $email)
    {
        return $query->where('email', $email);
    }

    //global scope using closures
//    protected static function boot()
//    {
//        parent::boot();
//        static::addGlobalScope('active', function (Builder $builder) {
//            $builder->where('created_at', '>', Carbon::now()->subDay());
//        });
//    }

    //Accessors
    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->email;
    }

    //Mutators

    public function setEmailAttribute($value)
    {
        $this->attribute['email'] = $value > 0 ? $value : 0;
    }

    public function phoneNumber()
    {
        return $this->hasOne(PhoneNumber::class);
    }

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
