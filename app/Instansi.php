<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';
    protected $guarded = [];

    function provinsi() {
        return $this->belongsTo('App\Provinsi', 'id_provinsi');
    }
}
