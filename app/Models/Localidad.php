<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Localidad extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'localidades';




    /* Pertenece */

    /* Tiene */

    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'localidad_id');
    }


    public function refrendos()
    {
        return $this->hasMany(Refrendo::class, 'localidad_id');
    }



}
