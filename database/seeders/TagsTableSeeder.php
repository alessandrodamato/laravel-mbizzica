<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      $faker = FakerFactory::create('it_IT');

      for ($i = 0; $i < 20; $i++) {
        $new_tag = new Tag();
        $new_tag->name = $faker->word();
        $new_tag->save();
      }
    }
}
