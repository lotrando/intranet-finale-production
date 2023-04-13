<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear table

        DB::table('food')->truncate();

        DB::table('food')->insert([
            'name'     => 'Svátek - Dnes se nevaří',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Svátek - Dnes se nevaří',
            'type'     => 'food',
        ]);

        // Polévky
        DB::table('food')->insert([
            'name'     => 'Gulášová polévka',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Čočková polévka s uzeninou',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Frankfurtská polévka',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Zelná polévka',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Česneková polévka se smetanou a krutóny',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Fazolová polévka z bílých fazolí',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Fazolová polévka z uzeninou',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Dršťková polévka',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Rajská polévka',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Bramborová polévka',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Hrachová polévka',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Boršč',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Kulajda',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Kapustová polévka',
            'type'     => 'soup',
        ]);

        DB::table('food')->insert([
            'name'     => 'Slovenská bramborová polévka',
            'type'     => 'soup',
        ]);

        // Jídla

        DB::table('food')->insert([
            'name'     => 'Bramboráky',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Marinovaná kuřecí křídla',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Smažený vepřový řízek',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Smažené rybí filé',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Strapačky se zelím',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Smazený kuřecí řízek ( stehenní )',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Francouzké brambory',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Pečené kuře',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Bramboráky',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Zabíjačkový guláš',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Zapečené palačinky s tvarohem',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Plněné knedlíky uzeným, kyselé zelí',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Sekaná',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Smažený květák',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Ohnivé maso',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Segedínský guláš',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Smažené kuřecí křídla',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Hovězí guláš',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Kuřecí špalíky na kari',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Kapustový karbenátek',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Smažený krůtí řízek',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Zamecké brambory',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Nočky se slaninou',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Smažený sýr',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Smažený karbenátek',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Smažená játra',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Zapečené testoviny s uzeninou',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Pekingské placky',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Jelito',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Plněný paprikový lusk',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Vepřové ražniči',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Vepřový guláš',
            'type'     => 'food',
        ]);

        DB::table('food')->insert([
            'name'     => 'Halušky s nivou',
            'type'     => 'food',
        ]);
    }
}
