<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new  \App\User([
            'name' => 'Adrian Vega',
            'email' => 'adrian.vega@live.com',
            'password' => Hash::make('123'),
            'active' => true
        ]);
        $user->save();

        $user = new  \App\User([
            'name' => 'Kevin Vega',
            'email' => 'kevin.vega@live.com',
            'password' => Hash::make('123'),
            'active' => true
        ]);
        $user->save();

        $user = new  \App\User([
            'name' => 'Karina Madrigal',
            'email' => 'karina.madrigal@live.com',
            'password' => Hash::make('123'),
            'active' => true
        ]);
        $user->save();

        $user = new  \App\User([
            'name' => 'Hilary Bolaños',
            'email' => 'hilary.bolaños@live.com',
            'password' => Hash::make('123'),
            'active' => true
        ]);
        $user->save();

        $user = new  \App\User([
            'name' => 'Angie Alpizar',
            'email' => 'angie.alpizar@live.com',
            'password' => Hash::make('123'),
            'active' => true
        ]);
        $user->save();

        $user = new  \App\User([
            'name' => 'Daniela Picado',
            'email' => 'daniela.picado@live.com',
            'password' => Hash::make('123'),
            'active' => true
        ]);
        $user->save();
    }
}
