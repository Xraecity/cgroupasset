<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_plans extends Model
{

 protected $dates = ['created_at', 'updated_at', 'activated_at', 'last_growth'];

 public function dplan(){
    	return $this->belongsTo('App\plans', 'plan');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user');
    }
}
