<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    $faker = FakerFactory::create('it_IT');

    for ($i = 0; $i < 5; $i++) {

      $new_user = new User();
      $new_user->name = $faker->name();
      $new_user->email = $faker->email();
      $new_user->password = '12341234';
      $new_user->save();
    }
  }
}
