<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WithdrawMethod extends Model
{
 use SoftDeletes;
    protected $table = 'withdraw_methods';

    protected $fillable = ['slogan','name','image','fix','percent','duration','status','withdraw_min','withdraw_max'];


}
