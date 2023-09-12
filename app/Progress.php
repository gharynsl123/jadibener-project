<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function pengajuan()
    {
        return $this->belongsTo('App\Pengajuan', 'id_pengajuan');
    }
    public function history()
    {
        return $this->hasMany(History::class, 'id_progress');
    }
}
