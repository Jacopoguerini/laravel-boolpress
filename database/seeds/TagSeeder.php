<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            "Front End",
            "Back End",
            "General",
            "Web App"
        ];

        foreach ($tags as $tag) {
            
            $newTag = new Tag();

            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag, '-');

            $newTag->save();
        }
    }
}
