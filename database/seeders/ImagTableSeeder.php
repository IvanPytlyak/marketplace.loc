<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'images/1.jpg',
                'product_id' => 1,
            ],
            [
                'name' => 'images/2.jpg',
                'product_id' => 1,
            ],
            [
                'name' => 'images/3.jpg',
                'product_id' => 1,
            ],
            [
                'name' => 'images/4.jpg',
                'product_id' => 1,
            ],
            [
                'name' => 'images/5.jpg',
                'product_id' => 3,
            ],
            [
                'name' => 'images/6.jpg',
                'product_id' => 3,
            ],
            [
                'name' => 'images/7.jpg',
                'product_id' => 3,
            ],
            [
                'name' => 'images/8.jpg',
                'product_id' => 3,
            ]
        ];
        DB::table('imags')->insert($data);
    }
}
