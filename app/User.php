<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\UserDate;
use App\Country;
use App\Email;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    // relación uno a uno con los datos de usario
    public function userDate()
    {
        return $this->hasOne(UserDate::class);
    }

    // relación de uno a muchos inversa con la tabla de países
    public function country()
    {
        return $this->belongsToMany(Country::class);
    }

    // relación de uno a muchos con los emails que crea el usuario
    public function emails(){
        return $this->hasMany(Email::class);
    }
}
