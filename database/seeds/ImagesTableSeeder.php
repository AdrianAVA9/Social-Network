<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert(
            ['name' => 'image',
            'img_uri' => 'img-1.jpg',
            'album_id' => 1]
        );

        DB::table('images')->insert(
            ['name' => 'image',
            'img_uri' => 'img-2.jpg',
            'album_id' => 1]
        );

        DB::table('images')->insert(
            ['name' => 'image',
            'img_uri' => 'img-3.jpg',
            'album_id' => 1]
        );

        DB::table('images')->insert(
            ['name' => 'image',
            'img_uri' => 'img-4.jpg',
            'album_id' => 1]
        );

        DB::table('images')->insert(
            ['name' => 'image',
            'img_uri' => 'img-5.jpg',
            'album_id' => 1]
        );

        DB::table('images')->insert(
            ['name' => 'image',
            'img_uri' => 'img-6.jpg',
            'album_id' => 1]
        );

        DB::table('images')->insert(
            ['name' => 'image',
            'img_uri' => 'img-7.jpg',
            'album_id' => 2]
        );

        DB::table('images')->insert(
            ['name' => 'image',
            'img_uri' => 'img-8.jpg',
            'album_id' => 2]
        );
    }
}
