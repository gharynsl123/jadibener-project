<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SukuCadang extends Model
{
    protected $table = 'sukucadang';
    protected $guarded = [];
    
    function kategori(){
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }
}
