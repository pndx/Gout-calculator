<?php

namespace Database\Seeders;

use App\Models\HumanFoodLog;
use Illuminate\Database\Seeder;

class HumanFoodLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        HumanFoodLog::factory(10)->create();
    }
}
