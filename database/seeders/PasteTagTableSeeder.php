<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paste;
use App\Models\Tag;

class PasteTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      for ($i = 0; $i < 100; $i++) {
        $paste = Paste::inRandomOrder()->first();
        $tag_id = Tag::inRandomOrder()->first()->id;
        $paste->tags()->attach($tag_id);
      }
    }
}
