<?php

use Illuminate\Database\Seeder;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('albums')->insert([
            'name' => 'Album - 1',
            'active' => true,
            'is_public' => true,
            'user_id' => 1
        ]);

        DB::table('albums')->insert([
            'name' => 'Album - 2',
            'active' => true,
            'is_public' => true,
            'user_id' => 1
        ]);

        DB::table('albums')->insert([
            'name' => 'Album - 3',
            'active' => true,
            'is_public' => true,
            'user_id' => 1
        ]);

        DB::table('albums')->insert([
            'name' => 'Album - 4',
            'active' => true,
            'is_public' => true,
            'user_id' => 1
        ]);

        DB::table('albums')->insert([
            'name' => 'Album - 5',
            'active' => true,
            'is_public' => true,
            'user_id' => 1
        ]);
    }
}
