<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {

            $newPost = new Post();
            $newPost->title = "Titolo Post " . ($i+1);
            $newPost->content = "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab exercitationem consectetur sapiente dolore similique aspernatur beatae, aperiam molestias quaerat quibusdam. Non deleniti cum quam odit ipsa, atque, temporibus accusantium mollitia amet, repellat maxime blanditiis totam pariatur tenetur! Eveniet atque unde libero soluta cupiditate! Eligendi veritatis deleniti libero necessitatibus doloribus fugiat quam illo minima natus quis, nulla, voluptates reprehenderit voluptatibus officiis ab soluta, hic provident tenetur vel. Quisquam sed incidunt maxime. Officia vel enim fugit. Minima ab accusamus labore incidunt aspernatur? Modi ipsum iusto repudiandae amet molestias in repellat natus quia deserunt. Nesciunt temporibus saepe fuga accusantium explicabo veniam sequi animi.";
            $newPost->slug = Str::slug($newPost->title,'-');

            $newPost->save();
        }
    }
}
