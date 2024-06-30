<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductLogStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_log_statuses')->insert([
            [
                'name' => 'Расход',
            ],
            [
                'name' => 'Приход',
            ],
        ]);
    }
}
