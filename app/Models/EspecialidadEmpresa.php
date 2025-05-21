<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class EspecialidadEmpresa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'especialidades_empresas';




    /* Pertenece */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id', 'id');
    }

    /* Tiene */




}
