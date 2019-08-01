<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model 
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'patient_age', 'notes','hospital_name', 'hospital_address', 'latitude', 'longitude', 'bags_number', 'phone', 'blood_type_id', 'client_id', 'city_id');

    public function bloodType()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function notification()
    {
        return $this->hasOne('App\Notification');
    }
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

}