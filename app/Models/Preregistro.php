<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Preregistro extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'preregistros';



    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }



    /* Pertenece */

    public function user()
    {
        return $this->belongsTo(User::class, 'rfc_empresa', 'rfc');
    }


    /* Tiene */

}
