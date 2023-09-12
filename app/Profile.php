<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    protected $guarded = [];
    function users()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
    function instansi()
    {
        return $this->belongsTo('App\Instansi', 'id_instansi');
    }
}
