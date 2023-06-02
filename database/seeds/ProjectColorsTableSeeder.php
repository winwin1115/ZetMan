<?php

use App\ProjectColor;
use Illuminate\Database\Seeder;

class ProjectColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectColor::create([
            'name' => '赤'
        ]);
        ProjectColor::create([
            'name' => 'ピンク'
        ]);
        ProjectColor::create([
            'name' => '群青'
        ]);
        ProjectColor::create([
            'name' => '青'
        ]);
        ProjectColor::create([
            'name' => '薄青'
        ]);
        ProjectColor::create([
            'name' => '水色'
        ]);
        ProjectColor::create([
            'name' => '緑'
        ]);
        ProjectColor::create([
            'name' => '黄緑'
        ]);
        ProjectColor::create([
            'name' => '黄'
        ]);
        ProjectColor::create([
            'name' => 'オレンジ'
        ]);
    }
}
