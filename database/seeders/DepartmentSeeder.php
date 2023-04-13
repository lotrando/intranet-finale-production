<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear table

        DB::table('departments')->truncate();

        // Departments

        DB::table('departments')->insert([
            'department_code' => '401',
            'center_code' => '4501',
            'color_id' => 'blue',
            'department_name' => 'interní oddělení',
        ]);

        DB::table('departments')->insert([
            'department_code' => '402',
            'center_code' => '4502',
            'color_id' => 'azure',
            'department_name' => 'endokrinologická ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '403',
            'center_code' => '4503',
            'color_id' => 'azure',
            'department_name' => 'příjmová interní ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '404',
            'center_code' => '4507',
            'color_id' => 'azure',
            'department_name' => 'gastroenterologická ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '405',
            'center_code' => '4507',
            'color_id' => 'azure',
            'department_name' => 'interní odborné ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '407',
            'center_code' => '4512',
            'color_id' => 'purple',
            'department_name' => 'neurologické oddělení',
        ]);

        DB::table('departments')->insert([
            'department_code' => '408',
            'center_code' => '4513',
            'color_id' => 'purple',
            'department_name' => 'neurologická ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '410',
            'center_code' => '4501',
            'color_id' => 'lime',
            'department_name' => 'odělení chirurgie páteře',
        ]);

        DB::table('departments')->insert([
            'department_code' => '411',
            'center_code' => '4521',
            'color_id' => 'lime',
            'department_name' => 'JIP oddělení chirurgie páteře a ortopedie',
        ]);

        DB::table('departments')->insert([
            'department_code' => '412',
            'center_code' => '4524',
            'color_id' => 'lime',
            'department_name' => 'ambulance chirurgie páteře',
        ]);

        DB::table('departments')->insert([
            'department_code' => '413',
            'center_code' => '4551',
            'color_id' => 'green',
            'department_name' => 'rehabilitační oddělení',
        ]);

        DB::table('departments')->insert([
            'department_code' => '414',
            'center_code' => '4552',
            'color_id' => 'green',
            'department_name' => 'rehabilitační ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '415',
            'center_code' => '4558',
            'color_id' => 'cyan',
            'department_name' => 'oddělení pracovního lékařství',
        ]);

        DB::table('departments')->insert([
            'department_code' => '417',
            'center_code' => '4547',
            'color_id' => 'pink',
            'department_name' => 'OKB',
        ]);

        DB::table('departments')->insert([
            'department_code' => '418',
            'center_code' => '4549',
            'color_id' => 'red',
            'department_name' => 'RDG',
        ]);

        DB::table('departments')->insert([
            'department_code' => '419',
            'center_code' => '4522',
            'color_id' => 'lime',
            'department_name' => 'operační sály',
        ]);

        DB::table('departments')->insert([
            'department_code' => '420',
            'center_code' => '4110',
            'color_id' => 'yellow',
            'department_name' => 'ředitelství',
        ]);

        DB::table('departments')->insert([
            'department_code' => '421',
            'center_code' => '4120',
            'color_id' => 'orange',
            'department_name' => 'stravovací provoz - kantýna',
        ]);

        DB::table('departments')->insert([
            'department_code' => '422',
            'center_code' => '4130',
            'color_id' => 'muted',
            'department_name' => 'úklid',
        ]);

        DB::table('departments')->insert([
            'department_code' => '424',
            'center_code' => '4528',
            'color_id' => 'lime',
            'department_name' => 'anesteziologická ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '425',
            'center_code' => '4504',
            'color_id' => 'azure',
            'department_name' => 'diabetologická ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '426',
            'center_code' => '4141',
            'color_id' => 'teal',
            'department_name' => 'lékárna KHN',
        ]);

        DB::table('departments')->insert([
            'department_code' => '427',
            'center_code' => '4510',
            'color_id' => 'indigo',
            'department_name' => 'mezioborová JIP',
        ]);

        DB::table('departments')->insert([
            'department_code' => '428',
            'center_code' => '4524',
            'color_id' => 'muted',
            'department_name' => 'provozní úsek',
        ]);

        DB::table('departments')->insert([
            'department_code' => '429',
            'center_code' => '4150',
            'color_id' => 'muted',
            'department_name' => 'údržba',
        ]);

        DB::table('departments')->insert([
            'department_code' => '432',
            'center_code' => '4507',
            'color_id' => 'azure',
            'department_name' => 'ambulance infuzní terapie',
        ]);

        DB::table('departments')->insert([
            'department_code' => '433',
            'center_code' => '4524',
            'color_id' => 'lime',
            'department_name' => 'mamologická poradna',
        ]);

        DB::table('departments')->insert([
            'department_code' => '434',
            'center_code' => '4525',
            'color_id' => 'orange',
            'department_name' => 'ortopedické oddělení',
        ]);

        DB::table('departments')->insert([
            'department_code' => '436',
            'center_code' => '4143',
            'color_id' => 'teal',
            'department_name' => 'lékárna KHN v Ráji',
        ]);

        DB::table('departments')->insert([
            'department_code' => '437',
            'center_code' => '4560',
            'color_id' => 'orange',
            'department_name' => 'oddělení následné péče',
        ]);

        DB::table('departments')->insert([
            'department_code' => '999',
            'center_code' => '9999',
            'color_id' => 'muted',
            'department_name' => 'externí pracovník',
        ]);
    }
}
