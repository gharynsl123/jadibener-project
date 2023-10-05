<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $guarded = [];
    
    function merek()
    {
        return $this->belongsTo('App\Merek', 'id_merek');
    }
    function kategori()
    {
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }
    function departement()
    {
        return $this->belongsTo('App\Departement', 'id_departement');
    }
}
