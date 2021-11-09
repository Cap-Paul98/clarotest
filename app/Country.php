<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country', 'state', 'city'
    ];

    public function users(){
        return $thid->belongsToMany(User::class);
    }
}
