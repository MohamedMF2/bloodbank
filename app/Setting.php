<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'facebook', 'instagram', 'google', 'youtube', 'whatsapp', 'twitter', 'linkedin', 'about');

}