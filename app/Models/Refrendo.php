<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Refrendo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'refrendos';




    public function getFechaExpedicionAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }



    /* Pertenece */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'id');
    }


    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }


    public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'localidad_id', 'id');
    }

    /* Tiene */

    public function observacionesRefrendos()
    {
        return $this->hasOne(ObservacionRefrendo::class, 'refrendo_id');
    }


    public function folio()
    {
        return $this->hasOne(Folio::class, 'empresa_id', 'empresa_id');
    }



}
