<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
    public function progress()
    {
        return $this->belongsTo('App\Progress', 'id_progress');
    }
}
