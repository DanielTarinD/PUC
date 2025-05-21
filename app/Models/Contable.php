<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Contable extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'contables';

    public function getFechaBalanceGeneralAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }


    /* Pertenece */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }


    /* Tiene */




}
