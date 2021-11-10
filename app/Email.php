<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Email extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'addressee', 'subject', 'shipping_date', 'status', 'email_body'
    ];

    // relación de uno a muchos inversa con la tabla de usuarios (usuario que lo creo)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
