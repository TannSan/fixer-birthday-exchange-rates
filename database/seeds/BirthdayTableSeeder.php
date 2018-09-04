<?php

use Illuminate\Database\Seeder;

class BirthdayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BirthdayExchangeRate::class, 20)->create();
    }
}
