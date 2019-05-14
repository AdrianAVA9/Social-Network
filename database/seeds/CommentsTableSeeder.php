<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'description' => 'Mae que buena foto',
            'user_id' => 5,
            'post_id' => 1,
            'active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('comments')->insert([
            'description' => 'Mae si, donde andaba',
            'user_id' => 2,
            'post_id' => 1,
            'active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('comments')->insert([
            'description' => 'Seguro le gusto mucho',
            'user_id' => 3,
            'post_id' => 1,
            'active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('comments')->insert([
            'description' => 'Si pero que bien que salga y a uno no lo invita jaja',
            'user_id' => 4,
            'post_id' => 1,
            'active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('comments')->insert([
            'description' => 'Usted es desarollador de software',
            'user_id' => 5,
            'post_id' => 8,
            'active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('comments')->insert([
            'description' => 'Mae si',
            'user_id' => 1,
            'post_id' => 8,
            'active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('comments')->insert([
            'description' => 'Y esta trabajando',
            'user_id' => 3,
            'post_id' => 8,
            'active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('comments')->insert([
            'description' => 'No aun no, pero ya casi!!!',
            'user_id' => 1,
            'post_id' => 8,
            'active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
