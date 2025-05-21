<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Especialidad extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'especialidades';




    /* Pertenece */

    /* Tiene */

    public function especialidadesEmpresas()
    {
        return $this->hasMany(EspecialidadEmpresa::class, 'especialidad_id');
    }



}
