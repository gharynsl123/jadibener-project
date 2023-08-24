<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $table = 'estimasibiaya';
    protected $guarded = [];

    function kategori()
    {
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }
    function part()
    {
        return $this->belongsTo('App\Part', 'id_part');
    }
    function peralatan() {
        return $this->belongsTo('App\Peralatan', 'id_peralatan');
    }
}
