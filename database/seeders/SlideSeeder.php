<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slides')->insert([
            'id' => 1,
            'training_id' => 1,
            'slide_title' => 'Slide-1',
            'directory' => 'bozp',
            'path'      => 'img_01.png',
            'position'  => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 2,
            'training_id' => 1,
            'slide_title' => 'Slide-2',
            'directory' => 'bozp',
            'path'      => 'img_02.png',
            'position'  => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 3,
            'training_id' => 1,
            'slide_title' => 'Slide-3',
            'directory' => 'bozp',
            'path'      => 'img_03.png',
            'position'  => '3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 4,
            'training_id' => 1,
            'slide_title' => 'Slide-4',
            'directory' => 'bozp',
            'path'      => 'img_04.png',
            'position'  => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 5,
            'training_id' => 1,
            'slide_title' => 'Slide-5',
            'directory' => 'bozp',
            'path'      => 'img_05.png',
            'position'  => '5',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 6,
            'training_id' => 1,
            'slide_title' => 'Slide-6',
            'directory' => 'bozp',
            'path'      => 'img_06.png',
            'position'  => '6',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 7,
            'training_id' => 1,
            'slide_title' => 'Slide-7',
            'directory' => 'bozp',
            'path'      => 'img_07.png',
            'position'  => '7',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 8,
            'training_id' => 1,
            'slide_title' => 'Slide-8',
            'directory' => 'bozp',
            'path'      => 'img_08.png',
            'position'  => '8',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 9,
            'training_id' => 1,
            'slide_title' => 'Slide-9',
            'directory' => 'bozp',
            'path'      => 'img_09.png',
            'position'  => '9',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 10,
            'training_id' => 1,
            'slide_title' => 'Slide-10',
            'directory' => 'bozp',
            'path'      => 'img_10.png',
            'position'  => '10',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 11,
            'training_id' => 1,
            'slide_title' => 'Slide-11',
            'directory' => 'bozp',
            'path'      => 'img_11.png',
            'position'  => '11',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 12,
            'training_id' => 1,
            'slide_title' => 'Slide-12',
            'directory' => 'bozp',
            'path'      => 'img_12.png',
            'position'  => '12',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 13,
            'training_id' => 1,
            'slide_title' => 'Slide-13',
            'directory' => 'bozp',
            'path'      => 'img_13.png',
            'position'  => '13',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 14,
            'training_id' => 1,
            'slide_title' => 'Slide-14',
            'directory' => 'bozp',
            'path'      => 'img_14.png',
            'position'  => '14',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 15,
            'training_id' => 1,
            'slide_title' => 'Slide-15',
            'directory' => 'bozp',
            'path'      => 'img_15.png',
            'position'  => '15',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 16,
            'training_id' => 1,
            'slide_title' => 'Slide-16',
            'directory' => 'bozp',
            'path'      => 'img_16.png',
            'position'  => '16',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 17,
            'training_id' => 1,
            'slide_title' => 'Slide-17',
            'directory' => 'bozp',
            'path'      => 'img_17.png',
            'position'  => '17',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 18,
            'training_id' => 1,
            'slide_title' => 'Slide-18',
            'directory' => 'bozp',
            'path'      => 'img_18.png',
            'position'  => '18',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 19,
            'training_id' => 1,
            'slide_title' => 'Slide-19',
            'directory' => 'bozp',
            'path'      => 'img_19.png',
            'position'  => '19',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 20,
            'training_id' => 1,
            'slide_title' => 'Slide-20',
            'directory' => 'bozp',
            'path'      => 'img_20.png',
            'position'  => '20',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 21,
            'training_id' => 1,
            'slide_title' => 'Slide-21',
            'directory' => 'bozp',
            'path'      => 'img_21.png',
            'position'  => '21',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 22,
            'training_id' => 1,
            'slide_title' => 'Slide-22',
            'directory' => 'bozp',
            'path'      => 'img_22.png',
            'position'  => '22',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 23,
            'training_id' => 1,
            'slide_title' => 'Slide-23',
            'directory' => 'bozp',
            'path'      => 'img_23.png',
            'position'  => '23',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 24,
            'training_id' => 1,
            'slide_title' => 'Slide-24',
            'directory' => 'bozp',
            'path'      => 'img_24.png',
            'position'  => '24',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 25,
            'training_id' => 1,
            'slide_title' => 'Slide-25',
            'directory' => 'bozp',
            'path'      => 'img_25.png',
            'position'  => '25',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 26,
            'training_id' => 1,
            'slide_title' => 'Slide-26',
            'directory' => 'bozp',
            'path'      => 'img_26.png',
            'position'  => '26',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 27,
            'training_id' => 1,
            'slide_title' => 'Slide-27',
            'directory' => 'bozp',
            'path'      => 'img_27.png',
            'position'  => '27',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 28,
            'training_id' => 1,
            'slide_title' => 'Slide-28',
            'directory' => 'bozp',
            'path'      => 'img_28.png',
            'position'  => '28',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 29,
            'training_id' => 1,
            'slide_title' => 'Slide-29',
            'directory' => 'bozp',
            'path'      => 'img_29.png',
            'position'  => '29',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 30,
            'training_id' => 1,
            'slide_title' => 'Slide-30',
            'directory' => 'bozp',
            'path'      => 'img_30.png',
            'position'  => '30',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 31,
            'training_id' => 1,
            'slide_title' => 'Slide-31',
            'directory' => 'bozp',
            'path'      => 'img_31.png',
            'position'  => '31',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 32,
            'training_id' => 1,
            'slide_title' => 'Slide-32',
            'directory' => 'bozp',
            'path'      => 'img_32.png',
            'position'  => '32',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 33,
            'training_id' => 1,
            'slide_title' => 'Slide-33',
            'directory' => 'bozp',
            'path'      => 'img_33.png',
            'position'  => '33',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 34,
            'training_id' => 1,
            'slide_title' => 'Slide-34',
            'directory' => 'bozp',
            'path'      => 'img_34.png',
            'position'  => '34',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 35,
            'training_id' => 1,
            'slide_title' => 'Slide-35',
            'directory' => 'bozp',
            'path'      => 'img_35.png',
            'position'  => '35',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 36,
            'training_id' => 1,
            'slide_title' => 'Slide-36',
            'directory' => 'bozp',
            'path'      => 'img_36.png',
            'position'  => '36',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 37,
            'training_id' => 1,
            'slide_title' => 'Slide-37',
            'directory' => 'bozp',
            'path'      => 'img_37.png',
            'position'  => '37',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 38,
            'training_id' => 1,
            'slide_title' => 'Slide-38',
            'directory' => 'bozp',
            'path'      => 'img_38.png',
            'position'  => '38',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('slides')->insert([
            'id' => 39,
            'training_id' => 1,
            'slide_title' => 'Slide-39',
            'directory' => 'bozp',
            'path'      => 'img_39.png',
            'position'  => '39',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
