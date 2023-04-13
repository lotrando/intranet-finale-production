<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear table
        DB::table('categories')->truncate();

        // Standards categories
        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'Akreditační',
            'folder_name'   => 'akreditacni',
            'category_icon' => 'akreditacni.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-file-certificate text-indigo" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path><circle cx="6" cy="14" r="3"></circle><path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'akreditační',
            'color'         => 'blue'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'Ošetřovatelské',
            'folder_name'   => 'osetrovatelske',
            'category_icon' => 'osetrovatelske.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-stethoscope text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h-1a2 2 0 0 0 -2 2v3.5h0a5.5 5.5 0 0 0 11 0v-3.5a2 2 0 0 0 -2 -2h-1"></path><path d="M8 15a6 6 0 1 0 12 0v-3"></path><path d="M11 3v2"></path><path d="M6 3v2"></path><circle cx="20" cy="10" r="2"></circle></svg>',
            'fa_icon'       => null,
            'button'        => 'ošetřovatelský',
            'color'         => 'pink'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'Léčebné',
            'folder_name'   => 'lecebne',
            'category_icon' => 'lecebne.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-hearts text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14.017 18.001l-2.017 1.999l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 0 1 8.153 5.784"></path><path d="M15.99 20l4.197 -4.223a2.81 2.81 0 0 0 .006 -3.948a2.747 2.747 0 0 0 -3.91 -.007l-.28 .282l-.279 -.283a2.747 2.747 0 0 0 -3.91 -.007a2.81 2.81 0 0 0 -.007 3.948l4.182 4.238z"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'léčebný',
            'color'         => 'red'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'Speciální',
            'folder_name'   => 'specialni',
            'category_icon' => 'specialni.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-report-medical text-indigo" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect><line x1="10" y1="14" x2="14" y2="14"></line><line x1="12" y1="12" x2="12" y2="16"></line></svg>',
            'fa_icon'       => null,
            'button'        => 'speciální',
            'color'         => 'indigo'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'Operační',
            'folder_name'   => 'operacni',
            'category_icon' => 'operacni.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-slice text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 19l15 -15l3 3l-6 6l2 2a14 14 0 0 1 -14 4"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'operační',
            'color'         => 'lime'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'Anesteziologické',
            'folder_name'   => 'anesteziologicke',
            'category_icon' => 'anesteziologicke.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-heart-rate-monitor text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M7 10h2l2 3l2 -6l1 3h3"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'anesteziologický',
            'color'         => 'purple'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'RDG',
            'folder_name'   => 'rdg',
            'category_icon' => 'rdg.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-radioactive text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M13.5 14.6l3 5.19a9 9 0 0 0 4.5 -7.79h-6a3 3 0 0 1 -1.5 2.6"></path><path d="M13.5 9.4l3 -5.19a9 9 0 0 0 -9 0l3 5.19a3 3 0 0 1 3 0"></path><path d="M10.5 14.6l-3 5.19a9 9 0 0 1 -4.5 -7.79h6a3 3 0 0 0 1.5 2.6"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'radiologický',
            'color'         => 'yellow'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'Rehabilitační',
            'folder_name'   => 'rehabilitacni',
            'category_icon' => 'rehabilitacni.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-physotherapist text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 15l-1 -3l4 -2l4 1h3.5"></path><circle cx="4" cy="19" r="1"></circle><circle cx="12" cy="6" r="1"></circle><path d="M12 17v-7"></path><path d="M8 20h7l1 -4l4 -2"></path><path d="M18 20h3"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'rehabilitační',
            'color'         => 'reha'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'OPL',
            'folder_name'   => 'opl',
            'category_icon' => 'opl.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-bandage text-cyan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="14" y1="12" x2="14" y2="12.01"></line><line x1="10" y1="12" x2="10" y2="12.01"></line><line x1="12" y1="10" x2="12" y2="10.01"></line><line x1="12" y1="14" x2="12" y2="14.01"></line><path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'pracovní',
            'color'         => 'cyan'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'OKB',
            'folder_name'   => 'okb',
            'category_icon' => 'okb.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-test-pipe text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M20 8.04l-12.122 12.124a2.857 2.857 0 1 1 -4.041 -4.04l12.122 -12.124"></path><path d="M7 13h8"></path><path d="M19 15l1.5 1.6a2 2 0 1 1 -3 0l1.5 -1.6z"></path><path d="M15 3l6 6"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'laboratorní',
            'color'         => 'purple'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'standardy',
            'category_type' => 'standard',
            'category_name' => 'Logopedické',
            'folder_name'   => 'logopedicke',
            'category_icon' => 'logopedicke.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-messages text-teal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10"></path><path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'logopedický',
            'color'         => 'cyan'
        ]);

        // Documents Data

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'Personální',
            'folder_name'   => 'personalni',
            'category_icon' => 'personalni.png',
            'svg_icon'      => '<svg class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'personální',
            'color'         => 'green'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'Sesterská',
            'folder_name'   => 'sesterska',
            'category_icon' => 'sesterska.png',
            'svg_icon'      => '<svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 6c2.941 0 5.685 .847 8 2.31l-2 9.69h-12l-2 -9.691a14.93 14.93 0 0 1 8 -2.309z"></path><path d="M10 12h4"></path><path d="M12 10v4"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'sesterský',
            'color'         => 'red'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'Hygienická',
            'folder_name'   => 'hygiena',
            'category_icon' => 'hygiena.png',
            'svg_icon'      => '<svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 21h10v-10a3 3 0 0 0 -3 -3h-4a3 3 0 0 0 -3 3v10z"></path><path d="M15 3h-6a2 2 0 0 0 -2 2"></path><path d="M12 3v5"></path><path d="M12 11v4"></path><path d="M10 13h4"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'hygienický',
            'color'         => 'azure'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'Pacient',
            'folder_name'   => 'pacient',
            'category_icon' => 'pacient.png',
            'svg_icon'      => '<svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="21" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M11 21l-1 -4l-2 -3v-6"></path><path d="M5 14l-1 -3l4 -3l3 2l3 .5"></path><circle cx="8" cy="4" r="1"></circle><path d="M7 17l-2 4"></path><path d="M16 21v-8.5a1.5 1.5 0 0 1 3 0v.5"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'pacientský',
            'color'         => 'yellow'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'OKB',
            'folder_name'   => 'okb',
            'category_icon' => 'okb.png',
            'svg_icon'      => '<svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M20 8.04l-12.122 12.124a2.857 2.857 0 1 1 -4.041 -4.04l12.122 -12.124"></path><path d="M7 13h8"></path><path d="M19 15l1.5 1.6a2 2 0 1 1 -3 0l1.5 -1.6z"></path><path d="M15 3l6 6"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'laboratorní',
            'color'         => 'purple'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'RDG',
            'folder_name'   => 'rdg',
            'category_icon' => 'rdg.png',
            'svg_icon'      => '<svg class="icon text-orange" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M13.5 14.6l3 5.19a9 9 0 0 0 4.5 -7.79h-6a3 3 0 0 1 -1.5 2.6"></path><path d="M13.5 9.4l3 -5.19a9 9 0 0 0 -9 0l3 5.19a3 3 0 0 1 3 0"></path><path d="M10.5 14.6l-3 5.19a9 9 0 0 1 -4.5 -7.79h6a3 3 0 0 0 1.5 2.6"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'radiologický',
            'color'         => 'orange'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'IT',
            'folder_name'   => 'it',
            'category_icon' => 'it.png',
            'svg_icon'      => '<svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 15h-6a1 1 0 0 1 -1 -1v-8a1 1 0 0 1 1 -1h6"></path><rect x="13" y="4" width="8" height="16" rx="1"></rect><line x1="7" y1="19" x2="10" y2="19"></line><line x1="17" y1="8" x2="17" y2="8.01"></line><circle cx="17" cy="16" r="1"></circle><line x1="9" y1="15" x2="9" y2="19"></line></svg>',
            'fa_icon'       => null,
            'button'        => 'IT',
            'color'         => 'blue'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'KPR',
            'folder_name'   => 'kpr',
            'category_icon' => 'kpr.png',
            'svg_icon'      => '<svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M19.5 13.572l-7.5 7.428l-2.896 -2.868m-6.117 -8.104a5 5 0 0 1 9.013 -3.022a5 5 0 1 1 7.5 6.572"></path><path d="M3 13h2l2 3l2 -6l1 3h3"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'KPR',
            'color'         => 'pink'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'Komunikační karty',
            'folder_name'   => 'komunikacni-karty',
            'category_icon' => 'komunikacni-karty.png',
            'svg_icon'      => '<svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3.604 7.197l7.138 -3.109a0.96 .96 0 0 1 1.27 .527l4.924 11.902a1.004 1.004 0 0 1 -.514 1.304l-7.137 3.109a0.96 .96 0 0 1 -1.271 -.527l-4.924 -11.903a1.005 1.005 0 0 1 .514 -1.304z"></path><path d="M15 4h1a1 1 0 0 1 1 1v3.5"></path><path d="M20 6c.264 .112 .52 .217 .768 .315a1 1 0 0 1 .53 1.311l-2.298 5.374"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'komunikační',
            'color'         => 'purple'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'Vyhodnocovací',
            'folder_name'   => 'vyhodnoceni-dotazniku',
            'category_icon' => 'vyhodnoceni-dotazniku.png',
            'svg_icon'      => '<svg class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="21" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect><path d="M9 14h.01"></path><path d="M9 17h.01"></path><path d="M12 16l1 1l3 -3"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'vyhodnocovací',
            'color'         => 'lime'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'dokumenty',
            'category_type' => 'dokument',
            'category_name' => 'Postupová',
            'folder_name'   => 'navody',
            'category_icon' => 'navody.png',
            'svg_icon'      => '<svg class="icon text-teal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="17" x2="12" y2="17.01"></line><path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'postupový',
            'color'         => 'teal'
        ]);

        // BOZP Data

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Bezpečnostní plány',
            'folder_name'   => 'bezpecnostni-plany',
            'category_icon' => 'bezpecnostni-plany.png',
            'svg_icon'      => '<svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 12l2 2l4 -4"></path><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'bezpečnostní plány',
            'color'         => 'red'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Organizační směrnice',
            'folder_name'   => 'organizacni-smernice',
            'category_icon' => 'organizacni-smernice.png',
            'svg_icon'      => '<svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h1.341"></path><path d="M19.682 10.682l-7.682 -7.682l-9 9h2v7a2 2 0 0 0 2 2h5"></path><path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'Organizační směrnice',
            'color'         => 'purple'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Metodiky školení',
            'folder_name'   => 'metodiky-skoleni',
            'category_icon' => 'metodiky-skoleni.png',
            'svg_icon'      => '<svg class="icon text-orange" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path><path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path><path d="M5 8h4"></path><path d="M9 16h4"></path><path d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z"></path><path d="M14 9l4 -1"></path><path d="M16 16l3.923 -.98"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'metodiky školení',
            'color'         => 'orange'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Prezenční listiny',
            'folder_name'   => 'prezencni-listiny',
            'category_icon' => 'prezencni-listiny.png',
            'svg_icon'      => '<svg class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path><path d="M14 19l2 2l4 -4"></path><path d="M9 8h4"></path><path d="M9 12h2"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'prezenční listiny',
            'color'         => 'lime'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Pracovní úrazy',
            'folder_name'   => 'pracovni-urazy',
            'category_icon' => 'pracovni-urazy.png',
            'svg_icon'      => '<svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 12l0 .01"></path><path d="M10 12l0 .01"></path><path d="M12 10l0 .01"></path><path d="M12 14l0 .01"></path><path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'pracovní úrazy',
            'color'         => 'pink'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Bezpečnostní značení',
            'folder_name'   => 'bezpecnostni-znaceni',
            'category_icon' => 'bezpecnostni-znaceni.png',
            'svg_icon'      => '<svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="8.5" cy="8.5" r="1" fill="currentColor"></circle><path d="M4 7v3.859c0 .537 .213 1.052 .593 1.432l8.116 8.116a2.025 2.025 0 0 0 2.864 0l4.834 -4.834a2.025 2.025 0 0 0 0 -2.864l-8.117 -8.116a2.025 2.025 0 0 0 -1.431 -.593h-3.859a3 3 0 0 0 -3 3z"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'bezpečnostní značení',
            'color'         => 'yellow'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Prověrky a kontroly',
            'folder_name'   => 'proverky-kontroly',
            'category_icon' => 'proverky-kontroly.png',
            'svg_icon'      => '<svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M12 10.5v1.5"></path><path d="M12 16v1.5"></path><path d="M15.031 12.25l-1.299 .75"></path><path d="M10.268 15l-1.3 .75"></path><path d="M15 15.803l-1.285 -.773"></path><path d="M10.285 12.97l-1.285 -.773"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'prověrky a kontroly',
            'color'         => 'azure'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Provozně bezpeč. předpisy',
            'folder_name'   => 'provozne-bezpecnostni-predpisy',
            'category_icon' => 'provozne-bezpecnostni-predpisy.png',
            'svg_icon'      => '<svg class="icon text-cyan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'provozně bezp. předpisy',
            'color'         => 'cyan'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Rizika',
            'folder_name'   => 'rizika',
            'category_icon' => 'rizika.png',
            'svg_icon'      => '<svg class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 20l16 0"></path><path d="M9.4 10l5.2 0"></path><path d="M7.8 15l8.4 0"></path><path d="M6 20l5 -15h2l5 15"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'Rizika',
            'color'         => 'green'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Požární ochrana',
            'folder_name'   => 'pozarni-ochrana',
            'category_icon' => 'pozarni-ochrana.png',
            'svg_icon'      => '<svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M7 18h8m4 0h2v-6a5 5 0 0 0 -5 -5h-1l1.5 5h4.5"></path><path d="M12 18v-11h3"></path><path d="M3 17l0 -5l9 0"></path><path d="M3 9l18 -6"></path><path d="M6 12l0 -4"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'požární ochrana',
            'color'         => 'red'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Požární operativní karty',
            'folder_name'   => 'pozarni-operativni-karty',
            'category_icon' => 'pozarni-operativni-karty.png',
            'svg_icon'      => '<svg class="icon text-teal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3.604 7.197l7.138 -3.109a.96 .96 0 0 1 1.27 .527l4.924 11.902a1 1 0 0 1 -.514 1.304l-7.137 3.109a.96 .96 0 0 1 -1.271 -.527l-4.924 -11.903a1 1 0 0 1 .514 -1.304z"></path><path d="M15 4h1a1 1 0 0 1 1 1v3.5"></path><path d="M20 6c.264 .112 .52 .217 .768 .315a1 1 0 0 1 .53 1.311l-2.298 5.374"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'požární operativní karty',
            'color'         => 'teal'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'bozp',
            'category_type' => 'bozp',
            'category_name' => 'Bezpečnostní listy',
            'folder_name'   => 'bezpecnostni-listy',
            'category_icon' => 'bezpecnostni-listy.png',
            'svg_icon'      => '<svg class="icon text-orange" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path><path d="M9 17h6l-3 -6z"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'bezpečnostní listy',
            'color'         => 'orange'
        ]);

        // Indikátory kvality
        DB::table('categories')->insert([
            'category_file' => 'indikatory-kvality',
            'category_type' => 'indikatory',
            'category_name' => 'Formuláře',
            'folder_name'   => 'formulare',
            'category_icon' => 'formulare.png',
            'svg_icon'      => '<svg class="icon text-cyan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3a3 3 0 0 0 -3 3v12a3 3 0 0 0 3 3"></path><path d="M6 3a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3"></path><path d="M13 7h7a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-7"></path><path d="M5 7h-1a1 1 0 0 0 -1 1v8a1 1 0 0 0 1 1h1"></path><path d="M17 12h.01"></path><path d="M13 12h.01"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'formuláře',
            'color'         => 'cyan'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'indikatory-kvality',
            'category_type' => 'indikatory',
            'category_name' => 'Ankety',
            'folder_name'   => 'ankety',
            'category_icon' => 'ankety.png',
            'svg_icon'      => '<svg class="icon text-orange" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path><path d="M19 22v.01"></path><path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'ankety',
            'color'         => 'orange'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'indikatory-kvality',
            'category_type' => 'indikatory',
            'category_name' => 'Dekubity',
            'folder_name'   => 'dekubity',
            'category_icon' => 'dekubity.png',
            'svg_icon'      => '<svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M21 3l-5 9h5l-6.891 7.086a6.5 6.5 0 1 1 -8.855 -9.506l7.746 -6.58l-1 5l9 -5z"></path><path d="M9.5 14.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'dekubity',
            'color'         => 'pink'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'indikatory-kvality',
            'category_type' => 'indikatory',
            'category_name' => 'Nosokomiální nákazy',
            'folder_name'   => 'nosokomialni-nakazy',
            'category_icon' => 'nosokomialni-nakazy.png',
            'svg_icon'      => '<svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"></path><path d="M12 7v-4"></path><path d="M11 3h2"></path><path d="M15.536 8.464l2.828 -2.828"></path><path d="M17.657 4.929l1.414 1.414"></path><path d="M17 12h4"></path><path d="M21 11v2"></path><path d="M15.535 15.536l2.829 2.828"></path><path d="M19.071 17.657l-1.414 1.414"></path><path d="M12 17v4"></path><path d="M13 21h-2"></path><path d="M8.465 15.536l-2.829 2.828"></path><path d="M6.343 19.071l-1.413 -1.414"></path><path d="M7 12h-4"></path><path d="M3 13v-2"></path><path d="M8.464 8.464l-2.828 -2.828"></path><path d="M4.929 6.343l1.414 -1.413"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'nosokomiální nákazy',
            'color'         => 'azure'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'indikatory-kvality',
            'category_type' => 'indikatory',
            'category_name' => 'Nežádoucí události',
            'folder_name'   => 'nezadouci-udalosti',
            'category_icon' => 'nezadouci-udalosti.png',
            'svg_icon'      => '<svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path><path d="M11 14h1v4h1"></path><path d="M12 11h.01"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'nežádoucí události',
            'color'         => 'red'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'indikatory-kvality',
            'category_type' => 'indikatory',
            'category_name' => 'Parametry kvality',
            'folder_name'   => 'parametry-kvality',
            'category_icon' => 'parametry-kvality.png',
            'svg_icon'      => '<svg class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 3a1 1 0 0 1 .993 .883l.007 .117v3.171a3.001 3.001 0 0 1 0 5.658v7.171a1 1 0 0 1 -1.993 .117l-.007 -.117v-7.17a3.002 3.002 0 0 1 -1.995 -2.654l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-3.17a1 1 0 0 1 1 -1z" stroke-width="0" fill="currentColor"></path><path d="M12 3a1 1 0 0 1 .993 .883l.007 .117v9.171a3.001 3.001 0 0 1 0 5.658v1.171a1 1 0 0 1 -1.993 .117l-.007 -.117v-1.17a3.002 3.002 0 0 1 -1.995 -2.654l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-9.17a1 1 0 0 1 1 -1z" stroke-width="0" fill="currentColor"></path><path d="M18 3a1 1 0 0 1 .993 .883l.007 .117v.171a3.001 3.001 0 0 1 0 5.658v10.171a1 1 0 0 1 -1.993 .117l-.007 -.117v-10.17a3.002 3.002 0 0 1 -1.995 -2.654l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-.17a1 1 0 0 1 1 -1z" stroke-width="0" fill="currentColor"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'parametry kvality',
            'color'         => 'lime'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'informovane-souhlasy',
            'category_type' => 'isp',
            'category_name' => 'Informované souhlasy',
            'folder_name'   => 'informovane-souhlasy',
            'category_icon' => 'informovane-ohlasy.png',
            'svg_icon'      => '<svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path><path d="M9 14l2 2l4 -4"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'informované souhlasy',
            'color'         => 'azure'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'edukace',
            'category_type' => 'edukace',
            'category_name' => 'Edukační materiály',
            'folder_name'   => 'edukacni-materialy',
            'category_icon' => 'edukacni-materialy.png',
            'svg_icon'      => '<svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 8v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path><path d="M4 8m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path><path d="M10 14h4"></path><path d="M12 12v4"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'edukační materiály',
            'color'         => 'azure'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'edukace',
            'category_type' => 'edukace',
            'category_name' => 'Návody',
            'folder_name'   => 'navody',
            'category_icon' => 'navody.png',
            'svg_icon'      => '<svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path><path d="M3 6l0 13"></path><path d="M12 6l0 13"></path><path d="M21 6l0 13"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'návody',
            'color'         => 'pink'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'edukace',
            'category_type' => 'edukace',
            'category_name' => 'Distribuce',
            'folder_name'   => 'distribuce',
            'category_icon' => 'distribuce.png',
            'svg_icon'      => '<svg class="icon icon-tabler text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M17 17h-11v-14h-2"></path><path d="M6 5l14 1l-1 7h-13"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'distribuce',
            'color'         => 'yellow'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'porady',
            'category_type' => 'porada',
            'category_name' => 'Primářské porady',
            'folder_name'   => 'primarske-porady',
            'category_icon' => 'primarske-porady.png',
            'svg_icon'      => '<svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h-1a2 2 0 0 0 -2 2v3.5h0a5.5 5.5 0 0 0 11 0v-3.5a2 2 0 0 0 -2 -2h-1"></path><path d="M8 15a6 6 0 1 0 12 0v-3"></path><path d="M11 3v2"></path><path d="M6 3v2"></path><path d="M20 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'primářské porady',
            'color'         => 'azure'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'porady',
            'category_type' => 'porada',
            'category_name' => 'Porady staničních sester',
            'folder_name'   => 'porady-stanicnich-sester',
            'category_icon' => 'porady-stanicnich-sester.png',
            'svg_icon'      => '<svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 6c2.941 0 5.685 .847 8 2.31l-2 9.69h-12l-2 -9.691a14.93 14.93 0 0 1 8 -2.309z"></path><path d="M10 12h4"></path><path d="M12 10v4"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'porady staničních sester',
            'color'         => 'pink'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'ridici-akty',
            'category_type' => 'ridici-akty',
            'category_name' => 'Příkazy',
            'folder_name'   => 'prikazy',
            'category_icon' => 'prikazy.png',
            'svg_icon'      => '<svg class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M21 17.85h-18c0 -4.05 1.421 -4.05 3.79 -4.05c5.21 0 1.21 -4.59 1.21 -6.8a4 4 0 1 1 8 0c0 2.21 -4 6.8 1.21 6.8c2.369 0 3.79 0 3.79 4.05z"></path><path d="M5 21h14"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'Příkazy',
            'color'         => 'yellow'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'ridici-akty',
            'category_type' => 'ridici-akty',
            'category_name' => 'Pokyny',
            'folder_name'   => 'pokyny',
            'category_icon' => 'pokyny.png',
            'svg_icon'      => '<svg class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path><path d="M9 12l.01 0"></path><path d="M13 12l2 0"></path><path d="M9 16l.01 0"></path><path d="M13 16l2 0"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'pokyny',
            'color'         => 'lime'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'ridici-akty',
            'category_type' => 'ridici-akty',
            'category_name' => 'Směrnice',
            'folder_name'   => 'smernice',
            'category_icon' => 'smernice.png',
            'svg_icon'      => '<svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 20h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8"></path><path d="M18 4v17"></path><path d="M15 18l3 3l3 -3"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'smernice',
            'color'         => 'azure'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'ridici-akty',
            'category_type' => 'ridici-akty',
            'category_name' => 'Organizační řád',
            'folder_name'   => 'organizacni-rad',
            'category_icon' => 'organizacni-rad.png',
            'svg_icon'      => '<svg class="icon text-orange" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path><path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'organizační řád',
            'color'         => 'orange'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'ridici-akty',
            'category_type' => 'ridici-akty',
            'category_name' => 'Provozní řády',
            'folder_name'   => 'provozni-rady',
            'category_icon' => 'provozni-rady.png',
            'svg_icon'      => '<svg class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path><path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'provozní řády',
            'color'         => 'green'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'ridici-akty',
            'category_type' => 'ridici-akty',
            'category_name' => 'Vnitřní řád',
            'folder_name'   => 'vnitrni-rad',
            'category_icon' => 'vnitrni-rad.png',
            'svg_icon'      => '<svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path><path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'vnitřní řád',
            'color'         => 'purple'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'akreditace',
            'category_type' => 'akreditace',
            'category_name' => 'Akreditace',
            'folder_name'   => 'akreditace',
            'category_icon' => 'akreditace.png',
            'svg_icon'      => '<svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path><path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'vnitřní řád',
            'color'         => 'purple'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'akreditace',
            'category_type' => 'akreditace',
            'category_name' => 'Aud. protokoly akr.',
            'folder_name'   => 'aud-protokoly-akr',
            'category_icon' => 'auditni-protokoly.png',
            'svg_icon'      => '<svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path><path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'aud. protokoly akreditační',
            'color'         => 'blue'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'akreditace',
            'category_type' => 'akreditace',
            'category_name' => 'Aud. protokoly ose.',
            'folder_name'   => 'aud-protokoly-ose',
            'category_icon' => 'auditni-protokoly.png',
            'svg_icon'      => '<svg class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path><path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'aud. protokoly ošetřovatelské',
            'color'         => 'green'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'akreditace',
            'category_type' => 'akreditace',
            'category_name' => 'Vyhodnocení dotazníků',
            'folder_name'   => 'vyhodnoceni-dotazniku',
            'category_icon' => 'vyhodnoceni-dotazniku.png',
            'svg_icon'      => '<svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path><path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path><path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'vnitřní řád',
            'color'         => 'pink'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'rozpisy-sluzeb',
            'category_type' => 'rozpisy-sluzeb',
            'category_name' => 'JIP',
            'folder_name'   => 'jip',
            'category_icon' => 'jip.png',
            'svg_icon'      => '<svg class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z"></path><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M7 10h2l2 3l2 -6l1 3h3"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'jip',
            'color'         => 'lime'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'rozpisy-sluzeb',
            'category_type' => 'rozpisy-sluzeb',
            'category_name' => 'Ortopedie',
            'folder_name'   => 'ortopedie',
            'category_icon' => 'ortopedie.png',
            'svg_icon'      => '<svg class="icon text-orange" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 3a3 3 0 0 1 3 3a3 3 0 1 1 -2.12 5.122l-4.758 4.758a3 3 0 1 1 -5.117 2.297l0 -.177l-.176 0a3 3 0 1 1 2.298 -5.115l4.758 -4.758a3 3 0 0 1 2.12 -5.122z"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'ortopedie',
            'color'         => 'orange'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'rozpisy-sluzeb',
            'category_type' => 'rozpisy-sluzeb',
            'category_name' => 'Operační sály',
            'folder_name'   => 'operacni-saly',
            'category_icon' => 'operacni-saly.png',
            'svg_icon'      => '<svg class="icon text-reha" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 19l15 -15l3 3l-6 6l2 2a14 14 0 0 1 -14 4"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'operacni-saly',
            'color'         => 'reha'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'rozpisy-sluzeb',
            'category_type' => 'rozpisy-sluzeb',
            'category_name' => 'Interna',
            'folder_name'   => 'interna',
            'category_icon' => 'interna.png',
            'svg_icon'      => '<svg class="icon text-blue" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'interna',
            'color'         => 'blue'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'rozpisy-sluzeb',
            'category_type' => 'rozpisy-sluzeb',
            'category_name' => 'Neurologie',
            'folder_name'   => 'neurologie',
            'category_icon' => 'neurologie.png',
            'svg_icon'      => '<svg class="icon text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15.5 13a3.5 3.5 0 0 0 -3.5 3.5v1a3.5 3.5 0 0 0 7 0v-1.8"></path><path d="M8.5 13a3.5 3.5 0 0 1 3.5 3.5v1a3.5 3.5 0 0 1 -7 0v-1.8"></path><path d="M17.5 16a3.5 3.5 0 0 0 0 -7h-.5"></path><path d="M19 9.3v-2.8a3.5 3.5 0 0 0 -7 0"></path><path d="M6.5 16a3.5 3.5 0 0 1 0 -7h.5"></path><path d="M5 9.3v-2.8a3.5 3.5 0 0 1 7 0v10"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'neurologie',
            'color'         => 'purple'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'rozpisy-sluzeb',
            'category_type' => 'rozpisy-sluzeb',
            'category_name' => 'RDG',
            'folder_name'   => 'rdg',
            'category_icon' => 'rdg.png',
            'svg_icon'      => '<svg class="icon icon-tabler icon-tabler-radioactive text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M13.5 14.6l3 5.19a9 9 0 0 0 4.5 -7.79h-6a3 3 0 0 1 -1.5 2.6"></path><path d="M13.5 9.4l3 -5.19a9 9 0 0 0 -9 0l3 5.19a3 3 0 0 1 3 0"></path><path d="M10.5 14.6l-3 5.19a9 9 0 0 1 -4.5 -7.79h6a3 3 0 0 0 1.5 2.6"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'rdg',
            'color'         => 'red'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'rozpisy-sluzeb',
            'category_type' => 'rozpisy-sluzeb',
            'category_name' => 'Příjmová ambulance',
            'folder_name'   => 'prijmova-ambulance',
            'category_icon' => 'prijmova-ambulance.png',
            'svg_icon'      => '<svg class="icon text-azure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path><path d="M19 22v-6"></path><path d="M22 19l-3 -3l-3 3"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'prijmova-ambulance',
            'color'         => 'azure'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'rozpisy-sluzeb',
            'category_type' => 'rozpisy-sluzeb',
            'category_name' => 'Žurnalní služby',
            'folder_name'   => 'zurnalni-sluzby',
            'category_icon' => 'zurnalni-sluzby.png',
            'svg_icon'      => '<svg class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M13.5 21h-7.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h16"></path><path d="M19 16l-2 3h4l-2 3"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'zurnalni-sluzby',
            'color'         => 'pink'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'rozpisy-sluzeb',
            'category_type' => 'rozpisy-sluzeb',
            'category_name' => 'Nutriční terapeuti',
            'folder_name'   => 'nutricni-terapeuti',
            'category_icon' => 'nutricni-terapeuti.png',
            'svg_icon'      => '<svg class="icon text-orange" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M13.62 8.382l1.966 -1.967a2 2 0 1 1 3.414 -1.415a2 2 0 1 1 -1.413 3.414l-1.82 1.821"></path><path d="M5.904 18.596c2.733 2.734 5.9 4 7.07 2.829c1.172 -1.172 -.094 -4.338 -2.828 -7.071c-2.733 -2.734 -5.9 -4 -7.07 -2.829c-1.172 1.172 .094 4.338 2.828 7.071z"></path><path d="M7.5 16l1 1"></path><path d="M12.975 21.425c3.905 -3.906 4.855 -9.288 2.121 -12.021c-2.733 -2.734 -8.115 -1.784 -12.02 2.121"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'nutricni-terapeuti',
            'color'         => 'orange'
        ]);

        DB::table('categories')->insert([
            'category_file' => 'rozpisy-sluzeb',
            'category_type' => 'rozpisy-sluzeb',
            'category_name' => 'Všechna oddělení',
            'folder_name'   => 'vsechna',
            'category_icon' => 'vsechna.png',
            'svg_icon'      => '<svg class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l11 0"></path><path d="M9 12l11 0"></path><path d="M9 18l11 0"></path><path d="M5 6l0 .01"></path><path d="M5 12l0 .01"></path><path d="M5 18l0 .01"></path></svg>',
            'fa_icon'       => null,
            'button'        => 'vsechna',
            'color'         => 'red'
        ]);
    }
}
