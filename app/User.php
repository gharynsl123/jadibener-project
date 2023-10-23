<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $guarded = [];
    protected $username = 'nama_user';

    function instansi() {
        return $this->belongsTo('App\Instansi', 'id_instansi');
    }

    public function peralatan()
    {
        return $this->hasMany(Peralatan::class, 'id_user');
    }

    function departement() {
        return $this->belongsTo(Departement::class, 'id_departement');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
