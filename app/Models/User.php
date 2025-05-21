<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rfc', 'name', 'email', 'password', 'avatar', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'user_id');
    }

    public function observaciones()
    {
        return $this->hasMany(Observacion::class, 'obras_id');
    }

    public function observacionesRefrendos()
    {
        return $this->hasMany(ObservacionRefrendo::class, 'obras_id');
    }

    public function preregistro()
    {
        return $this->hasOne(Preregistro::class, 'rfc_empresa', 'rfc');
    }
}
