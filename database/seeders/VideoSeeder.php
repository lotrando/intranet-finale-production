<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            'name' => 'Jak hasit',
            'video' => '/videa/jak_hasit.mp4',
            'image' => '/videa/jak_hasit.jpg',
            'category' => 'bozp'
        ]);

        DB::table('videos')->insert([
            'name' => 'Huberova jehla',
            'video' => '/videa/huberova_jehla.mp4',
            'image' => '/videa/huberova_jehla.jpg',
            'category' => 'edukace'
        ]);

        DB::table('videos')->insert([
            'name' => 'Jak hasit',
            'video' => '/videa/dialyza.mp4',
            'image' => '/videa/dialyza.mp4',
            'category' => 'edukace'
        ]);
    }
}
