<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwalteknisi';
    protected $guarded = [];

    public function peralatan()
    {
        return $this->belongsTo('App\Peralatan', 'id_peralatan');
    }

    public function instansi()
    {
        return $this->belongsTo('App\Instansi', 'id_instansi');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

}
