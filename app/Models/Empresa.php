<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'empresas';


    /* Pertenece */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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

    public function legales()
    {
        return $this->hasOne(Legal::class, 'empresa_id');
    }

    public function socios()
    {
        return $this->hasMany(Socio::class, 'empresa_id');
    }

    public function representantes()
    {
        return $this->hasOne(Representante::class, 'empresa_id');
    }

    public function contables()
    {
        return $this->hasOne(Contable::class, 'empresa_id');
    }

    public function especialidades()
    {
        return $this->hasMany(EspecialidadEmpresa::class, 'empresa_id');
    }

    public function tecnicas()
    {
        return $this->hasOne(Tecnica::class, 'empresa_id');
    }

    public function observaciones()
    {
        return $this->hasOne(Observacion::class, 'empresa_id');
    }

    public function folio()
    {
        return $this->hasOne(Folio::class, 'empresa_id');
    }

    public function refrendos()
    {
        return $this->hasMany(Refrendo::class, 'empresa_id');
    }


}
