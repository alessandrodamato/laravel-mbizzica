<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\Paste;
use App\Models\User;

class PastesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    $faker = FakerFactory::create('it_IT');
    $n_users = User::count();

    for ($j = 0; $j < $n_users; $j++) {
      $user_id = $j + 1;
      for ($i = 0; $i < 10; $i++) {

        $new_paste = new Paste();
        $new_paste->user_id = $user_id;
        $new_paste->content = $faker->realText(150);
        $new_paste->title = $faker->realText(20);
        $new_paste->visibility = $faker->numberBetween(1, 3);
        $new_paste->expiration_date = $faker->date();
        $new_paste->password = '12341234';
        $new_paste->file = 'uploads/xxx.jpg';
        $new_paste->save();

      }
    }
  }
}
