<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Estado extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'estados';




    /* Pertenece */

    /* Tiene */

    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'estado_id');
    }


    public function refrendos()
    {
        return $this->hasMany(Refrendo::class, 'estado_id');
    }



}
