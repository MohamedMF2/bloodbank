<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Client  extends Authenticatable 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $guarded =['password_confirmation'];

    public function city()
    {
        return $this->belongsTo('App\City','city_id');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Governorate');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function blood_types()
    {
        return $this->belongsToMany('App\BloodType');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\DonationRequest');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\BloodType');
    }
    public function tokens(){
        return $this->hasMany('App\Token');
    }
 
    protected $hidden =[
        'password','api_token'
    ];
}