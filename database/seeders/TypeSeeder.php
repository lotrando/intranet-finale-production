<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear table

        DB::table('types')->truncate();

        // Types
        DB::table('types')->insert([
            'type_name'     => 'Důležitá oznamení',
            'type_route'    => 'oznameni.important',
            'type_color'    => 'red',
            'svg_icon'      => '<svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg>',
        ]);


        DB::table('types')->insert([
            'type_name'     => 'Odstávky a servis',
            'type_route'    => 'oznameni.servis',
            'type_color'    => 'azure',
            'svg_icon'      => '<svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5"></path></svg>',
        ]);

        DB::table('types')->insert([
            'type_name'     => 'Změny služeb',
            'type_route'    => 'oznameni.akord',
            'type_color'    => 'yellow',
            'svg_icon'      => '<svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path><path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>',
        ]);

        DB::table('types')->insert([
            'type_name'     => 'Informace',
            'type_route'    => 'oznameni.informace',
            'type_color'    => 'azure',
            'svg_icon'      => '<svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9h.01"></path><path d="M11 12h1v4h1"></path><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path></svg>',
        ]);

        DB::table('types')->insert([
            'type_name'     => 'Semináře',
            'type_route'    => 'oznameni.seminare',
            'type_color'    => 'purple',
            'svg_icon'      => '<svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 11a2 2 0 0 1 2 2v2h10v-2a2 2 0 1 1 4 0v4a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z"></path><path d="M5 11v-5a3 3 0 0 1 3 -3h8a3 3 0 0 1 3 3v5"></path><path d="M6 19v2"></path><path d="M18 19v2"></path></svg>',
        ]);

        DB::table('types')->insert([
            'type_name'     => 'Akord',
            'type_route'    => 'oznameni.akord',
            'type_color'    => 'blue',
            'svg_icon'      => '<svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="3" y1="21" x2="21" y2="21"></line><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16"></path><path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path><line x1="10" y1="9" x2="14" y2="9"></line><line x1="12" y1="7" x2="12" y2="11"></line></svg>',
        ]);

        DB::table('types')->insert([
            'type_name'     => 'Kultura',
            'type_route'    => 'oznameni.kultura',
            'type_color'    => 'pink',
            'svg_icon'      => '<svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M13.192 9h6.616a2 2 0 0 1 1.992 2.183l-.567 6.182a4 4 0 0 1 -3.983 3.635h-1.5a4 4 0 0 1 -3.983 -3.635l-.567 -6.182a2 2 0 0 1 1.992 -2.183z"></path><path d="M15 13h.01"></path><path d="M18 13h.01"></path><path d="M15 16.5c1 .667 2 .667 3 0"></path><path d="M8.632 15.982a4.037 4.037 0 0 1 -.382 .018h-1.5a4 4 0 0 1 -3.983 -3.635l-.567 -6.182a2 2 0 0 1 1.992 -2.183h6.616a2 2 0 0 1 2 2"></path><path d="M6 8h.01"></path><path d="M9 8h.01"></path><path d="M6 12c.764 -.51 1.528 -.63 2.291 -.36"></path></svg>',
        ]);

        DB::table('types')->insert([
            'type_name'     => 'Normální',
            'type_route'    => 'oznameni.normalni',
            'type_color'    => 'muted',
            'svg_icon'      => '<svg class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M10 16.5l2 -3l2 3m-2 -3v-2l3 -1m-6 0l3 1"></path><circle cx="12" cy="7.5" r=".5" fill="currentColor"></circle></svg>',
        ]);

        DB::table('types')->insert([
            'type_name'     => 'Dlohodobě plánované',
            'type_route'    => 'oznameni.dlouhodobe',
            'type_color'    => 'orange',
            'svg_icon'      => '<svg class="icon text-orange" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M11 21h-5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3.5"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h11"></path><path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z"></path></svg>',
        ]);
    }
}
