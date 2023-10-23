<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReqSurveyor extends Model
{
    protected $table = 'reqsurveyor';
    protected $guarded = [];

    function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
}
