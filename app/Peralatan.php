<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    protected $table = 'peralatan';
    protected $guarded = [];

    function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
    function instansi(){
        return $this->belongsTo('App\Instansi', 'id_instansi');
    }
    function merek(){
        return $this->belongsTo('App\Merek', 'id_merek');
    }
    function kategori(){
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }
    function produk(){
        return $this->belongsTo('App\Produk', 'id_product');
    }
}
