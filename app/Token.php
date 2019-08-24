<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $fillable = ['token','type','client_id'];
    public function client(){
        return $this->belongsTo('App\Client');
    }
}
