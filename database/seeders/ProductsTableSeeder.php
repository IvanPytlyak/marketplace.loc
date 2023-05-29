<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Xiaomi Redmi Note 12 Pro',
                'code' => 'Note_12_Pro',
                'description' => 'Редми Ноут 12 Про оснащен передовым процессором Qualcomm Snapdragon 732G с 8 нм техпроцессом.',
                'price' => '1149',
                'category_id' => 1,
                'image' => 'products/Note_12_Pro.webp',
                'count' => rand(0, 10),
            ],
            [
                'name' => 'Realme 10',
                'code' => 'Realme_10',
                'description' => 'Если вам нужен телефон, который потянет даже самые требовательные игры и приложения, то стоит купить Realme 10.',
                'price' => '699',
                'category_id' => 1,
                'image' => 'products/realme_10.webp',
                'count' => rand(0, 10),
            ],
            [
                'name' => 'HTC One S',
                'code' => 'htc_one_s',
                'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
                'price' => '900',
                'category_id' => 1,
                'image' => 'products/htc_one_s.png',
                'count' => rand(0, 10),
            ],
            [
                'name' => 'iPhone 5SE',
                'code' => 'iphone_5se',
                'description' => 'Отличный классический iPhone',
                'price' => '800',
                'category_id' => 1,
                'image' => 'products/iphone_5.jpg',
                'count' => rand(0, 10),
            ],
            [
                'name' => 'Наушники Beats Audio',
                'code' => 'beats_audio',
                'description' => 'Отличный звук от Dr. Dre',
                'price' => '500',
                'category_id' => 2,
                'image' => 'products/beats.jpg',
                'count' => rand(0, 10),
            ],
            [
                'name' => 'Камера GoPro',
                'code' => 'gopro',
                'description' => 'Снимай самые яркие моменты с помощью этой камеры',
                'price' => '700',
                'category_id' => 2,
                'image' => 'products/gopro.jpg',
                'count' => rand(0, 10),
            ],
            [
                'name' => 'Камера Panasonic HC-V770',
                'code' => 'panasonic_hc-v770',
                'description' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
                'price' => '752',
                'category_id' => 2,
                'image' => 'products/video_panasonic.jpg',
                'count' => rand(0, 10),
            ],
            [
                'name' => 'Кофемашина DeLongi',
                'code' => 'delongi',
                'description' => 'Хорошее утро начинается с хорошего кофе!',
                'price' => '1200',
                'category_id' => 3,
                'image' => 'products/delongi.jpg',
                'count' => rand(0, 10),
            ],
            [
                'name' => 'Холодильник Haier',
                'code' => 'haier',
                'description' => 'Для большой семьи большой холодильник!',
                'price' => '2000',
                'category_id' => 3,
                'image' => 'products/haier.jpg',
                'count' => rand(0, 10),
            ],
            [
                'name' => 'Блендер Moulinex',
                'code' => 'moulinex',
                'description' => 'Для самых смелых идей',
                'price' => '300',
                'category_id' => 3,
                'image' => 'products/moulinex.jpg',
                'count' => rand(0, 10),
            ],
            [
                'name' => 'Мясорубка Bosch',
                'code' => 'bosch',
                'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                'price' => '1450',
                'category_id' => 3,
                'image' => 'products/bosch.jpg',
                'count' => rand(0, 10),
            ],

        ]);
    }
}
