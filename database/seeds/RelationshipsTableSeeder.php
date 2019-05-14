<?php

use Illuminate\Database\Seeder;

class RelationshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $follower = new \App\Relationship([
            'followee_id' => 1,
            'follower_id' => 2
        ]);
        $follower->save();

        $follower = new \App\Relationship([
            'followee_id' => 1,
            'follower_id' => 3
        ]);
        $follower->save();

        $follower = new \App\Relationship([
            'followee_id' => 1,
            'follower_id' => 4
        ]);
        $follower->save();

        $follower = new \App\Relationship([
            'followee_id' => 1,
            'follower_id' => 5
        ]);
        $follower->save();

        $followee = new \App\Relationship([
            'follower_id' => 1,
            'followee_id' => 2
        ]);
        $followee->save();

        $followee = new \App\Relationship([
            'follower_id' => 1,
            'followee_id' => 3
        ]);
        $followee->save();

        $followee = new \App\Relationship([
            'follower_id' => 1,
            'followee_id' => 4
        ]);
        $followee->save();

        $followee = new \App\Relationship([
            'follower_id' => 1,
            'followee_id' => 5
        ]);
        $followee->save();
    }
}
