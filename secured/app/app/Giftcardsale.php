<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Giftcardsale extends Model
{

     use SoftDeletes;
    protected $guarded = [];
    protected $table = "giftcardsales";

  public function giftcard()
    {
        return $this->belongsTo('App\Giftcard','id');
    }
     public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }


    public function trx()
    {
        return $this->hasMany('App\Trx','id');
    }
}
