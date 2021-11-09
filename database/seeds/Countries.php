<?php

use Illuminate\Database\Seeder;
use App\Country;

class Countries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'country' => 'Bolivia',
            'state' => 'Santa Cruz de la Sierra',
            'city' => 'Santa Cruz'
        ]);

        Country::create([
            'country' => 'Bolivia',
            'state' => 'La Paz',
            'city' => 'La Paz'
        ]);

        Country::create([
            'country' => 'Bolivia',
            'state' => 'Tarija',
            'city' => 'Tarija'
        ]);

        Country::create([
            'country' => 'Argentina',
            'state' => 'Buenos Aires',
            'city' => 'Buenos Aires'
        ]);

        Country::create([
            'country' => 'Argentina',
            'state' => 'Cordova',
            'city' => 'Cordova'
        ]);

        Country::create([
            'country' => 'Peru',
            'state' => 'Lima',
            'city' => 'Lima'
        ]);

        Country::create([
            'country' => 'Peru',
            'state' => 'Cusco',
            'city' =>'Cusco'
        ]);

        Country::create([
            'country' => 'Brasil',
            'state' => 'San Pablo',
            'city' => 'San Pablo'
        ]);

        Country::create([
            'country' => 'Brasil',
            'state' => 'Río de Janeiro',
            'city' => 'Río de Janeiro'
        ]);
    }
}
