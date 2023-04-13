<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert(['job_title' => 'asistentka ředitele']);
        DB::table('jobs')->insert(['job_title' => 'dohlížející osoba pro radiační činnost']);
        DB::table('jobs')->insert(['job_title' => 'dokumentační pracovnice']);
        DB::table('jobs')->insert(['job_title' => 'ekonomický náměstek']);
        DB::table('jobs')->insert(['job_title' => 'ergoterapeut']);
        DB::table('jobs')->insert(['job_title' => 'farmaceut']);
        DB::table('jobs')->insert(['job_title' => 'farmaceutický asistent']);
        DB::table('jobs')->insert(['job_title' => 'finanční účetní']);
        DB::table('jobs')->insert(['job_title' => 'fyzioterapeut']);
        DB::table('jobs')->insert(['job_title' => 'klinický logoped']);
        DB::table('jobs')->insert(['job_title' => 'kuchař']);
        DB::table('jobs')->insert(['job_title' => 'lékař']);
        DB::table('jobs')->insert(['job_title' => 'manažer kvality, ústavní hygienik']);
        DB::table('jobs')->insert(['job_title' => 'manažer léčby ran']);
        DB::table('jobs')->insert(['job_title' => 'manažer vztahů s veřejností']);
        DB::table('jobs')->insert(['job_title' => 'mzdová účetní']);
        DB::table('jobs')->insert(['job_title' => 'náměstek pro ošetřovatelskou péči']);
        DB::table('jobs')->insert(['job_title' => 'nezadáno']);
        DB::table('jobs')->insert(['job_title' => 'nutriční terapeut']);
        DB::table('jobs')->insert(['job_title' => 'ošetřovatel']);
        DB::table('jobs')->insert(['job_title' => 'ošetřovatelka']);
        DB::table('jobs')->insert(['job_title' => 'pokladní']);
        DB::table('jobs')->insert(['job_title' => 'pomocnice na úklid']);
        DB::table('jobs')->insert(['job_title' => 'pomocný pracovník']);
        DB::table('jobs')->insert(['job_title' => 'pracovnice podatelny']);
        DB::table('jobs')->insert(['job_title' => 'pracovnice spisovny/archivu']);
        DB::table('jobs')->insert(['job_title' => 'pracovník rozvozu stravy']);
        DB::table('jobs')->insert(['job_title' => 'pracovník údržby']);
        DB::table('jobs')->insert(['job_title' => 'praktická sestra']);
        DB::table('jobs')->insert(['job_title' => 'předseda dozorčí rady']);
        DB::table('jobs')->insert(['job_title' => 'primář']);
        DB::table('jobs')->insert(['job_title' => 'prodavačka']);
        DB::table('jobs')->insert(['job_title' => 'provozně-technický náměstek']);
        DB::table('jobs')->insert(['job_title' => 'provozní pracovník, vedoucí recepce']);
        DB::table('jobs')->insert(['job_title' => 'radiologický asistent']);
        DB::table('jobs')->insert(['job_title' => 'radiologický asistent, technik BOZP']);
        DB::table('jobs')->insert(['job_title' => 'recepční']);
        DB::table('jobs')->insert(['job_title' => 'ředitel, předseda představenstva']);
        DB::table('jobs')->insert(['job_title' => 'revizní technik, energetik']);
        DB::table('jobs')->insert(['job_title' => 'řidič']);
        DB::table('jobs')->insert(['job_title' => 'sanitář']);
        DB::table('jobs')->insert(['job_title' => 'sanitářka']);
        DB::table('jobs')->insert(['job_title' => 'šéfkuchař']);
        DB::table('jobs')->insert(['job_title' => 'skladnice']);
        DB::table('jobs')->insert(['job_title' => 'správce počítačové sítě']);
        DB::table('jobs')->insert(['job_title' => 'správce zdravotnických prostředků, metrolog']);
        DB::table('jobs')->insert(['job_title' => 'staniční sestra']);
        DB::table('jobs')->insert(['job_title' => 'technik IT']);
        DB::table('jobs')->insert(['job_title' => 'tisková mluvčí']);
        DB::table('jobs')->insert(['job_title' => 'učitel']);
        DB::table('jobs')->insert(['job_title' => 'učitelka']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí CPM']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí farmaceut']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí finanční účtárny']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí fyzioterapeut']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí IT']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí kantýny']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí lékař']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí personálního a mzdového oddělení']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí radiologický asistent']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí stravovacího provozu']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí údržby']);
        DB::table('jobs')->insert(['job_title' => 'vedoucí úklidu']);
        DB::table('jobs')->insert(['job_title' => 'všeobecná sestra']);
        DB::table('jobs')->insert(['job_title' => 'výkonová účetní']);
        DB::table('jobs')->insert(['job_title' => 'vývojář, webmaster']);
        DB::table('jobs')->insert(['job_title' => 'zástupce primáře']);
        DB::table('jobs')->insert(['job_title' => 'zástupce stan. sestry']);
        DB::table('jobs')->insert(['job_title' => 'zástupce vedoucího farmaceuta']);
        DB::table('jobs')->insert(['job_title' => 'zdravotně sociální pracovnice']);
        DB::table('jobs')->insert(['job_title' => 'zdravotní laborant']);
        DB::table('jobs')->insert(['job_title' => 'nezařazeno']);
    }
}
