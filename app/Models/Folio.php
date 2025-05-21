<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Folio extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'folios';


    public function getFechaExpedicionAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


    /* Pertenece */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }


    /* Tiene */




}
