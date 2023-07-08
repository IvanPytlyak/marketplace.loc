<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Аквариумные обитатели',
                'code' => 'fisches',
                'description' => 'Аквариумные рыбки всевозможных форм и окрасов, улитки, креветки из разных уголков планеты.',
                'image' => 'categories/1ndASGyMfpNny2uSxaMpGpO9J0T7WpRzu2yQXloE.jpg',
            ],
            [
                'name' => 'Товары для аквариумных обитателей',
                'code' => 'related',
                'description' => 'В товарах для аквариумных обитателей вы можете найти аквариумные растения для придания естественности среды обитания. Аквариумы на заказ и фирменные. Оборудование для поддержания биологического равновесия. Корм для аквариумных рыб от ведущих мировых брендов. Грунт для аквариума различной фракции и цветовой гаммы. Товары для аквариумистики.',
                'image' => 'categories/54_aquael_628b6fd714fd2.webp',
            ],
            [
                'name' => 'Товары для флорариума',
                'code' => 'flora',
                'description' => 'Флорариум – специальный сосуд, в который по технологии высаживаются растения с близкой потребностью влаги и света. Флорариум является композицией с собственным микроклиматом, однако многие причисляют к ним различные композиции из растений.',
                'image' => 'categories/5frDJL0qpiUvOUETWVjMX2mJ9vHq2abAckUr4P61.jpg',
            ],
        ]);
    }
}
