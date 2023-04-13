<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrinterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('printers')->insert([
            'printer_vendor' => 'HP',
            'printer_type' => 'LaserJet',
            'printer_number' => '1018',
            'toner_id' => '1',
        ]);

        DB::table('printers')->insert([
            'printer_vendor' => 'HP',
            'printer_type' => 'LaserJet',
            'printer_number' => '1020',
            'toner_id' => '1',
        ]);

        DB::table('printers')->insert([
            'printer_vendor' => 'HP',
            'printer_type' => 'LaserJet',
            'printer_number' => '1022',
            'toner_id' => '1',
        ]);
    }
}
