<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = 'part';
    protected $guarded = [];
    
    function kategori(){
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }
}
