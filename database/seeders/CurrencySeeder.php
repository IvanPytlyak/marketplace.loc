<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->truncate();
        DB::table('currencies')->insert([

            [
                'code' => 'BYN',
                'symbol' => 'Руб',
                'is_main' => '0',
                'rate' => '1',
            ],
            [
                'code' => 'EUR',
                'symbol' => '€',
                'is_main' => '0',
                'rate' => '3,5',
            ],
            [
                'code' => 'USD',
                'symbol' => '$',
                'is_main' => '0',
                'rate' => '3,2',
            ]
        ]);
    }
}
