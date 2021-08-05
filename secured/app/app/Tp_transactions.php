<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tp_transactions extends Model
{

	protected $fillable=['user','plan','amount','type','plan_id'];

}
