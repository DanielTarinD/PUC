<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Municipio extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'municipios';




    /* Pertenece */

    /* Tiene */

    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'municipio_id');
    }


    public function refrendos()
    {
        return $this->hasMany(refrendo::class, 'municipio_id');
    }


}
