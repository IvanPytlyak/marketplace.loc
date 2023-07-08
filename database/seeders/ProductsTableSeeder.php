<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('products')->insert([
            [
                'name' => 'Барбус олиголепис',
                'code' => 'barbus_o',
                'description' => 'Барбус олиголепис Barbus oligolepis за свой оригинальный окрас получил также название Клетчатый. Его часто можно увидеть в аквариумах, так как он совсем не прихотлив. К тому же, как и все барбусы, олиголепис занятно себя ведёт.',
                'price' => '4',
                'category_id' => 1,
                'image' => 'products/barbus_o.jpg',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],
            [
                'name' => 'Барбус пятиполосый',
                'code' => 'barbus_p',
                'description' => 'Барбус пятиполосый Barbus pentazona интересная активная рыбка. Населяет водоёмы острова Борнео. В природе встречается только там. Обитает на участках торфяных болот, а также в ручьях и реках, сообщающихся с ними. В таких местах много водных растений, опавшей листвы, коряг, корней деревьев. Вода здесь насыщена гуминовыми кислотами и остатками разложения растений.',
                'price' => '5',
                'category_id' => 1,
                'image' => 'products/barbus_p.jpg',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],
            [
                'name' => 'Бычок синий неоновый',
                'code' => 'buchok',
                'description' => 'Бычок синий неоновый Stiphodon semoni один из самых интересных видов аквариумных рыбок. Родом с вулканических островов в Индийском океане. Ареал обитания проходит от Западной Суматры до Соломоновых островов, к тому же захватывая северную Папуа-Новую Гвинею.',
                'price' => '9',
                'category_id' => 1,
                'image' => 'products/buchok.jpg',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],
            [
                'name' => 'Болотный карликовый рак',
                'code' => 'cambarellus',
                'description' => 'Болотный карликовый рак Cambarellus puer имеет широкий ареал обитания по всей Северной Америке. Населяет области Канады и США. У него много общего с Европейскими раками, однако он гораздо меньшего размера',
                'price' => '9',
                'category_id' => 1,
                'image' => 'products/cambarellus.jpg',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],
            [
                'name' => 'Галлерея Риф',
                'code' => 'rif',
                'description' => 'Галлерея Риф Cynotilapia ‘Gallireya Reef’ имеет туловище овальной формы с закругленной мордой и вытянутым хвостом. Плавники широкие и вытянуты в сторону хвоста. Туловище молодых особей окрашены в темно – розовый и серые тона. Верхние плавники темно-желтого оттенка, нижние – прозрачные. Нормальный окрас Цинотиляпия приобретает в период полового созревания.',
                'price' => '7',
                'category_id' => 1,
                'image' => 'products/rif.jfif',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],
            [
                'name' => 'Грунт Seachem Gray Coast',
                'code' => 'sand',
                'description' => 'Грунт Seachem Gray Coast объёмом 3.5 кг. — полностью натуральный кальцитовый грунт для всех типов морских и пресноводных аквариумов. Его химический состав поможет стабилизировать кальций и щелочность, предотвращая при этом значительное колебание уровня pH.',
                'price' => '75',
                'category_id' => 2,
                'image' => 'products/sand.png',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],
            [
                'name' => 'Грунт Seachem Pearl Coast',
                'code' => 'sand_b',
                'description' => 'Грунт Seachem Pearl Beach объёмом 3.5 кг — полностью натуральный арагонитовый субстрат для всех типов морских и пресноводных аквариумов. Его химический состав поможет стабилизировать кальций и щелочность, предотвращая при этом значительное колебание уровня pH.',
                'price' => '75',
                'category_id' => 2,
                'image' => 'products/sand_b.png',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],
            [
                'name' => 'Аквариум eGodim Plain (30л)',
                'code' => 'aqua',
                'description' => 'Большой аквариум объемом 30 литров',
                'price' => '59',
                'category_id' => 2,
                'image' => 'products/aqua.webp',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],
            [
                'name' => 'Ножницы ISTA',
                'code' => 'scissors',
                'description' => 'Ножницы ISTA волнообразные для растений, 25см. – для стрижки и формирования растений с удобными изогнутыми режущими кромками.',
                'price' => '64',
                'category_id' => 3,
                'image' => 'products/scissors.webp',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],
            [
                'name' => 'Коряга Дракон',
                'code' => 'dragon',
                'description' => 'Коряга Дракон из натурального дерева для обустройства аквариумов и террариумов.',
                'price' => '70',
                'category_id' => 3,
                'image' => 'products/dragon.png',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],
            [
                'name' => 'Коряга затонувшая',
                'code' => 'sink',
                'description' => 'Коряга затонувшая – природная коряга для оформления аквариума, террариума. Перед использованием тщательно промыть в проточной воде.',
                'price' => '62',
                'category_id' => 3,
                'image' => 'products/sink.png',
                'is_active' => 1,
                // 'count' => rand(0, 10),
            ],

        ]);
    }
}
