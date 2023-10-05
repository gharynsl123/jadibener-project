<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $guarded = [];


    function departement() {
        return $this->belongsTo('App\Departement', 'id_departement');
    }

}
