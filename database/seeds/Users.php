<?php

use App\User;
use App\UserDate;
use App\Country;
use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cuenta del usuario
        $admin = User::create([
            'name' => 'Paul Jimenez',
            'email' => 'pjimenez@claro.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        // Datos del usuario
        $admin->userDate()->create([
            'cellphone' => 70911555,
            'nro_ci' => '5634245 SC',
            'birthday_date' => '1990-12-25',
            'city_code' => 591
        ]);

        // Asignar rol de admin
        $admin->assignRole('admin');

        // relacionar con el pais al que pertenece 1 => Bolivia, Santa Cruz
        $admin->country()->attach(1);
    }
}
