<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = \App\Post::getPostUpdatedProfilePicture('profile-3.jpg',1);
        $post->save();
        $post = \App\Post::getPostAddedPhoto('img-1.jpg',1);
        $post->save();
        $post = \App\Post::getPostAddedPhoto('img-2.jpg',1);
        $post->save();
        $post = \App\Post::getPostAddedPhoto('img-3.jpg',1);
        $post->save();
        $post = \App\Post::getPostAddedPhoto('img-4.jpg',1);
        $post->save();
        $post = \App\Post::getPostAddedPhoto('img-5.jpg',1);
        $post->save();
        $post = \App\Post::getPostAddedPhoto('img-6.jpg',1);
        $post->save();

        $post = \App\Post::getPostPublishedStory(1,
            'A software developer is a person concerned with facets of the software development process, 
            including the research, design, programming, and testing of computer software. Other job 
            titles which are often used with similar meanings are programmer, software analyst, and 
            software programer.','img-1.jpg');
        $post->save();
        $post = \App\Post::getPostPublishedStory(1,
            'El sentido de la vida constituye una cuestión filosófica sobre el objetivo y el significado 
            de la vida, o de la existencia más en general. Este concepto se puede expresar a través de una 
            variedad de preguntas, tales como ¿Por qué estamos aquí? o ¿Qué es la vida?');
        $post->save();
        $post = \App\Post::getPostUpdatedProfilePicture('profile-2.jpg',1);
        $post->save();
    }
}
