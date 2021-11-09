<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserDate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cellphone', 'nro_ci', 'birthday_date', 'city_code'
    ];

    // Relación uno a uno inversa con el usuario correspondiente
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
