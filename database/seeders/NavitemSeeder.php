<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavitemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('navitems')->insert([
            'position'      => 1,
            'category_id'   => 1,
            'name'          => 'Home',
            'subname'       => 'Intranet',
            'alt_name'      => 'Homepage',
            'tooltip'       => 'Domů',
            'color'         => 'blue',
            'page_title'    => 'Homepage',
            'route'         => 'home',
            'favicon'       => 'home.png',
            'fa_icon'       => 'fa-home',
            'svg_icon'      => '<svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>',
            'icon_class'         => 'text-blue'
        ]);
    }
}
