<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MatterStatus;

class MatterStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Initial', 'code' => 'initial'],
            ['name' => 'In Progress', 'code' => 'in_progress'],
            ['name' => 'Appeal', 'code' => 'appeal'],
            ['name' => 'Execution', 'code' => 'execution'],
            ['name' => 'Closed', 'code' => 'closed'],
        ];

        foreach ($statuses as $status) {
            MatterStatus::firstOrCreate(['code' => $status['code']], $status);
        }
    }
}
