<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table = 'departement';
    protected $guarded = [];
    
    public function peralatan()
    {
        return $this->hasMany(Peralatan::class, 'id_departement');
    }
}
