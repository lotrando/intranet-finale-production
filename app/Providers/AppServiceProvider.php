<?php

namespace App\Providers;

use App\Models\Category;

use App\Models\Document;
use App\Models\Navitem;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Localize Carbon class
        Carbon::setLocale('cz');

        // Paginator Bootstrap CSS
        Paginator::useBootstrap();

        // Svátek má
        $svatek = DB::table('calendar')
            ->where('date', Carbon::now()->format('Y-m-d'))
            ->pluck('holiday');
        View::share('svatek', $svatek);

        // Navigation items
        $navitems = Navitem::all();
        View::share('navitems', $navitems);

        // Dokuments items
        $docs = Category::with('documents')->where('category_type', '=', 'dokument')->get();
        View::share('docs', $docs);

        // Standards items
        $stands = Category::with('documents')->where('category_type', '=', 'standard')->get();
        View::share('stands', $stands);

        // BOZP a PO items
        $bozps = Category::with('documents')->where('category_type', '=', 'bozp')->get();
        View::share('bozps', $bozps);

        // Indikators items
        $indikators = Category::with('documents')->where('category_type', '=', 'indikatory')->get();
        View::share('indikators', $indikators);

        // Indikators items
        $isps = Category::with('documents')->where('category_type', '=', 'isp')->get();
        View::share('isps', $isps);

        // Education items
        $educations = Category::with('documents')->where('category_type', '=', 'edukace')->get();
        View::share('educations', $educations);

        // Porady items
        $porady = Category::with('documents')->where('category_type', '=', 'porada')->get();
        View::share('porady', $porady);

        // Porady items
        $acts = Category::with('documents')->where('category_type', '=', 'ridici-akty')->get();
        View::share('acts', $acts);

        // Akreditace items
        $akreditace = Category::with('documents')->where('category_type', '=', 'akreditace')->get();
        View::share('akreditace', $akreditace);

        // Rozpisy služeb
        $rozpisy = Category::with('documents')->where('category_type', '=', 'rozpisy-sluzeb')->get();
        View::share('rozpisy', $rozpisy);

        // Categories items
        $categories = Category::with('documents')->where('id', '>', '12')->where('id', '<', '25')->get();
        View::share('categories', $categories);

        // Types items
        $types = Type::get();
        View::share('types', $types);

        // Změněné dokumenty
        $changedDocs = Document::with('category', 'user')
            ->where('category_id', '>', '11')
            ->where('updated_at', '>=', Carbon::now()->subHours(24))
            ->orderBy('category_id')
            ->orderByDesc('updated_at')
            ->get();
        View::share('changedDocs', $changedDocs);

        // Změněné standardy
        $changedStands =
            Document::with('category', 'user')
            ->where('category_id', '<', '11')
            ->where('updated_at', '>=', Carbon::now()->subHours(24))
            ->orderBy('category_id')
            ->orderByDesc('updated_at')
            ->get();
        View::share('changedStands', $changedStands);
    }
}
