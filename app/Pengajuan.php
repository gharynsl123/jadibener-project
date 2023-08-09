<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    protected $guarded = [];
    function peralatan(){
        return $this->belongsTo('App\Peralatan', 'id_peralatan');
    }
    function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
    function urgent(){
        return $this->belongsTo('App\Urgent', 'id_urgensi');
    }
}