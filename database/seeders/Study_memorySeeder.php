<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class Study_memorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('study_memories')->insert([
                'event_title' => 'テスト',
                'event_body' => 'テストです',
                'start_date' => '2024-09-10 13:00:00',
                'end_date' => '2024-09-10 14:30:00',
                'event_color' => 'blue',
                'event_border_color' => 'blue',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                ]);
    }
}
