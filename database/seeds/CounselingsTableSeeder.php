<?php

use Illuminate\Database\Seeder;

class CounselingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Counseling::class, 150)->create();
    }
}
