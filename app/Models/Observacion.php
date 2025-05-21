<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Observacion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'observaciones';




    /* Pertenece */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    public function revisor()
    {
        return $this->belongsTo(User::class, 'obras_id', 'id');
    }

    /* Tiene */



}
