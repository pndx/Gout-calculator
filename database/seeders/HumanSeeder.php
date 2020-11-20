<?php

namespace Database\Seeders;

use App\Models\Human;
use Illuminate\Database\Seeder;

class HumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Human::factory(10)->create();
    }
}
