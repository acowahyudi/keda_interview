<?php

namespace Database\seeds;

use Illuminate\Database\Seeder;
use UserSeeder;
use UserTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UserTypeSeeder::class]);
        $this->call([UserSeeder::class]);
    }
}
