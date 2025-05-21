<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnica extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'tecnicas';




    /* Pertenece */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }


    /* Tiene */




}
