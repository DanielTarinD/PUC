<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Legal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'legales';


    public function getFechaEscrituraAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getFechaMercantilAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }


    /* Pertenece */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function estadoExpedicion()
    {
        return $this->belongsTo(Estado::class, 'estado_expedicion', 'id');
    }

    public function estadoFormalizacion()
    {
        return $this->belongsTo(Estado::class, 'estado_formalizacion', 'id');
    }

    /* Tiene */




}
