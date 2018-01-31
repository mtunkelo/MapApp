<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(PlaceTableSeeder::class);
      $this->call(KeywordTableSeeder::class);
      $this->call(PlaceKeywordTableSeeder::class);

    }
}
