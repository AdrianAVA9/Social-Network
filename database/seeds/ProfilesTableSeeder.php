<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new \App\Profile([
            'username' => 'Adrian Vega',
            'email' => 'adrian.vega@live.com',
            'location' => 'San Jose, Costa Rica',
            'birthday' => Carbon::createFromDate(1996,05,10),
            'gender' => 'M',
            'bio' => 'Hi my name is Adrian I am 23 years old and I am software enginner',
            'img_uri' => 'profile-4.png',
            'user_id' => 1
        ]);
        $profile->save();

        $profile = new \App\Profile([
            'username' => 'kevin Vega',
            'email' => 'kevin.vega@live.com',
            'location' => 'San Jose, Costa Rica',
            'birthday' => Carbon::createFromDate(1997,07,22),
            'gender' => 'M',
            'bio' => 'Hi my name is Kevin I am 22 years old and I am designer',
            'img_uri' => 'profile-1.png',
            'user_id' => 2
        ]);
        $profile->save();

        $profile = new \App\Profile([
            'username' => 'Karina Madrigal',
            'email' => 'karina.madrigal@live.com',
            'location' => 'Escazu, Costa Rica',
            'birthday' => Carbon::createFromDate(1998,12,29),
            'gender' => 'F',
            'bio' => 'Hi my name is Karina I am 21 years old and I am secretary',
            'img_uri' => 'profile-2.png',
            'user_id' => 3
        ]);
        $profile->save();

        $profile = new \App\Profile([
            'username' => 'Hilary Bolaños',
            'email' => 'hilary.bolaño@live.com',
            'location' => 'Heredia, Costa Rica',
            'birthday' => Carbon::createFromDate(1999,02,19),
            'gender' => 'F',
            'bio' => 'Hi my name is Hilary I am 21 years old and I am secretary',
            'img_uri' => 'profile-6.png',
            'user_id' => 4
        ]);
        $profile->save();

        $profile = new \App\Profile([
            'username' => 'Angie Alpizar',
            'email' => 'angie.alpizar@live.com',
            'location' => 'Alajuela, Costa Rica',
            'birthday' => Carbon::createFromDate(1999,04,23),
            'gender' => 'F',
            'bio' => 'Hi my name is Angie I am 21 years old and I work in a call center',
            'img_uri' => 'profile-7.png',
            'user_id' => 5
        ]);
        $profile->save();
    }
}
