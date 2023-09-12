<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'survey';
    protected $guarded = [];

    function peralatan(){
        return $this->belongsTo('App\Peralatan', 'id_peralatan');
    }
    function user(){
        return $this->belongsTo('App\User', 'id_user');
    }

    function instansi() {
        return $this->belongsTo('App\Instansi', 'id_instansi');
    }
}
