<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadEjecutora extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'entidades_ejecutoras';


    /* Tiene */


    public function fuentes()
    {
        return $this->hasMany(Fuente::class, 'entidadejecutora_id');
    }

    public function areas()
    {
        return $this->hasMany(Area::class, 'entidadejecutora_id');
    }


    public function proveedores()
    {
        return $this->hasMany(Proveedor::class, 'entidadejecutora_id');
    }

    /* Pertenece */


}
