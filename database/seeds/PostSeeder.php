<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 1000;

        for ($i = 0; $i < $limit; $i++) {
            \App\Post::create([
                'user_id'=>$faker->numberBetween(1,10),
                'post_content'=>$faker->sentence,
                'country'=>$faker->country
            ]);
        }
    }
}
