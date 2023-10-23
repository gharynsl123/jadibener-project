<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';
    protected $guarded = [];

    function users()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    function peralatan()
    {
        return $this->belongsTo('App\Peralatan', 'id_peralatan');
    }

    function pengajuan() {
        return $this->belongsTo('App\Pengajuan', 'id_pengajuan');
    }

    function progress() {
        return $this->belongsTo('App\Progress', 'id_progress');
    }
    
    function estimasibiaya() {
        return $this->belongsTo('App\Estimate', 'id_estimasibiaya');
    }
}
