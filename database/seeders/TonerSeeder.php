<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TonerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('printers')->insert([
            'toner_code' => 'Q2612',
            'toner_type' => 'toner',
            'toner_size' => 'A',
            'toner_price' => '500',
        ]);

        DB::table('printers')->insert([
            'toner_code' => 'Q2612',
            'toner_type' => 'toner',
            'toner_size' => 'X',
            'toner_price' => '800',
        ]);

        DB::table('printers')->insert([
            'toner_code' => 'CE285',
            'toner_type' => 'toner',
            'toner_size' => 'A',
            'toner_price' => '350',
        ]);
    }
}
