<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'socios';

    public function getMontoAccionesAttribute($value)
    {
        return number_format($value, 2);
    }


    /* Pertenece */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }


    /* Tiene */




}
