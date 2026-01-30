<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatterStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('matter_statuses')->insert([
            [
                'name' => 'Primary',
                'code' => 'primary',
                'is_final' => false,
            ],
            [
                'name' => 'Appeal',
                'code' => 'appeal',
                'is_final' => false,
            ],
            [
                'name' => 'Execution',
                'code' => 'execution',
                'is_final' => true,
            ],
        ]);
    }
}
