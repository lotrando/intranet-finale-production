<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Bulletin;
use App\Models\Category;
use App\Models\Document;
use App\Models\Employee;
use App\Models\Food;
use App\Models\Notification;
use App\Models\Type;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use ZanySoft\LaravelPDF\PDF;

class PageController extends Controller
{
    // HOMEPAGE
    public function home()
    {
        $types = Type::all();

        if (Auth::user()) {
            $important = Notification::with('user', 'type')->where('type_id', '=', 1)->latest()->get();
            $notificationLong = Notification::with('user', 'type')->where('type_id', '=', 9)->latest()->get();
            $notifications = Notification::with('user', 'type')
                ->where('type_id', '>=', 3)
                ->where('type_id', '<', 9)->latest()->get();
            $notificationsServis = Notification::with('user', 'type')->where('type_id', '=', 2)->latest()->get();
        } else {
            $important = Notification::with('user', 'type')->where('type_id', '=', 1)->latest()->get();
            $notificationLong = Notification::with('user', 'type')->where('type_id', '=', 9)->latest()->get();
            $notifications = Notification::with('user', 'type')->whereStatus('Zobrazeno')
                ->where('type_id', '>=', 3)
                ->where('type_id', '<', 9)->latest()->get();
            $notificationsServis = Notification::with('user', 'type')->whereStatus('Zobrazeno')->where('type_id', '=', 2)->latest()->get();
        }

        return view('home', [
            'pretitle'              => 'Aktuality',
            'title'                 => 'Všechna oznámení',
            'types'                 => $types,
            'important'             => $important,
            'notifications'         => $notifications,
            'notificationLong'      => $notificationLong,
            'notificationsServis'   => $notificationsServis
        ]);
    }

    // OZNÁMENÍ

    // Změny standardů
    public function zmenyStandardu()
    {
        $documents = Document::with('category', 'user')
            ->where('category_id', '<', '11')
            ->where('updated_at', '>=', Carbon::now()->subHours(24))
            ->orderBy('category_id')
            ->orderByDesc('updated_at')
            ->get();

        $addons = Addon::with('category', 'document', 'user')
            ->where('category_id', '<', '11')
            // ->where('category_id', '<', '25')
            ->where('updated_at', '>=', Carbon::now()->subHours(24))
            ->orderBy('category_id')
            ->orderByDesc('updated_at')
            ->get();

        if ($documents->isNotEmpty() or $addons->isNotEmpty()) {

            return view('zmeny-standardu', [
                'pretitle'  => 'Oznámení',
                'title'     => 'Změny ve standardech',
                'documents' => $documents,
                'addons'    => $addons
            ]);
        }

        return view('empty-standardy', [
            'pretitle'  => 'Oznámení',
            'title'     => 'Změny ve standardech'
        ]);
    }

    // Změny v dokumentaci
    public function zmenyDokumentu()
    {
        $documents = Document::with('category', 'user')
            ->where('category_id', '>', '12')
            // ->where('category_id', '<', '25')
            ->where('updated_at', '>=', Carbon::now()->subHours(24))
            ->orderBy('category_id')
            ->orderByDesc('updated_at')
            ->get();

        $addons = Addon::with('category', 'document', 'user')
            ->where('category_id', '>', '12')
            // ->where('category_id', '<', '25')
            ->where('updated_at', '>=', Carbon::now()->subHours(24))
            ->orderBy('category_id')
            ->orderByDesc('updated_at')
            ->get();

        if ($documents->isNotEmpty() or $addons->isNotEmpty()) {

            return view('zmeny-dokumentace', [
                'pretitle'  => 'Oznámení',
                'title'     => 'Změny v dokumentaci',
                'documents' => $documents,
                'addons'    => $addons
            ]);
        }

        return view('empty-dokumentace', [
            'pretitle'  => 'Oznámení',
            'title'     => 'Změny v dokumentaci'
        ]);
    }

    // Oznameni Filter
    public function oznameniFilter($id)
    {
        $types = Type::all();

        $type = Type::whereId($id)->get();

        if (Auth::user()) {
            $notifications = Notification::with('user')->whereTypeId($id)->latest()->get();
        } else {
            $notifications = Notification::with('user')->whereStatus('Zobrazeno')->whereTypeId($id)->latest()->get();
        }

        if ($notifications->isEmpty()) {
            return view('empty-oznameni-filter', [
                'pretitle' => 'Oznámení',
                'title' => $type[0]['type_name'],
                'svg_icon' => $type[0]['svg_icon'],
                'color' => $type[0]['type_color'],
                'id' => $type[0]['id'],
                'notifications' => 'Žádná oznámení pro tuto kategorii',
                'types' => $types
            ]);
        } else {
            return view('oznameni-filter', [
                'pretitle' => 'Oznámení',
                'title' => $type[0]['type_name'],
                'svg_icon' => $type[0]['svg_icon'],
                'color' => $type[0]['type_color'],
                'id' => $type[0]['id'],
                'notifications' => $notifications,
                'types' => $types
            ]);
        }
    }

    // Stravování
    public function obedy()
    {
        return redirect()->away('http://akordapp/SISAkord/Login.aspx?ReturnUrl=%2fSISAkord%2f');
    }

    public function kantyna()
    {
        $food           = Food::orderBy('name')->get();
        $now            = Carbon::now();
        $weekStartDate  = $now->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $weekEndDate    = $now->endOfWeek()->addWeek()->format('Y-m-d');

        $daylist = DB::table('calendar')
            ->where('date', '>=', $weekStartDate)
            ->where('date', '<=', $weekEndDate)
            ->simplePaginate(7);

        return view('kantyna', [
            'pretitle'  => 'Stravování',
            'title'     => 'Nabídka kantýny',
            'daylist'   => $daylist,
            'food'      => $food
        ]);
    }

    // Plánování polévek
    public function changePolevka(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'polevka'  => $request->polevka,
                ]);
        }
        return response()->json(['success' => 'Polevka uložena!']);
        Alert::toast('Polevka uložena!', 'success')->position('center');
    }

    // Plánování jídlo A
    public function changeJidloA(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'jidlo_a'  => $request->jidlo_a,
                ]);
        }
        return response()->json(['success' => 'Jídlo uloženo!']);
        Alert::toast('Jídlo uloženo!', 'success')->position('center');
    }

    // Plánování jídlo A
    public function changeJidloB(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'jidlo_b'  => $request->jidlo_b,
                ]);
        }
        return response()->json(['success' => 'Jídlo uloženo!']);
        Alert::toast('Jídlo uloženo!', 'success')->position('center');
    }

    // Plánování jídlo A
    public function changeKantyna(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'kantyna'  => $request->kantyna,
                ]);
        }
        return response()->json(['success' => 'Provozní doba uložena!']);
        Alert::toast('Provozní doba uložena!', 'success')->position('center');
    }

    // Akreditacní stadnardy
    public function akreditacni($id)
    {
        $accordion_groups = Document::where('status', 'Schváleno')->where('category_id', $id)->pluck('accordion_group');
        $allDocuments = Document::where('category_id', '>', 12)->pluck('category_id');
        $allAddons = Addon::pluck('document_id');
        $categorie  = Category::where('id', $id)->first();
        $doctors = Employee::orderBy('last_name')->get();
        $last = Document::where('category_id', $id)->orderBy('id', 'desc')->take(1)->first();

        if ($last == null) {
            $last = 0;
        } else {
            $position = $last->position;
            $last = $position;
        }

        $documents1  = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 1)->orderBy('position')->get();
        $documents2  = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 2)->orderBy('position')->get();
        $documents3  = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 3)->orderBy('position')->get();
        $documents4  = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 4)->orderBy('position')->get();
        $documents5  = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 5)->orderBy('position')->get();
        $documents6  = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 6)->orderBy('position')->get();
        $documents7  = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 7)->orderBy('position')->get();
        $documents8  = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 8)->orderBy('position')->get();
        $documents9  = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 9)->orderBy('position')->get();
        $documents10 = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 10)->orderBy('position')->get();
        $documents11 = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 11)->orderBy('position')->get();
        $documents12 = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 12)->orderBy('position')->get();
        $documents13 = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 13)->orderBy('position')->get();
        $documents14 = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 14)->orderBy('position')->get();
        $documents15 = Document::where('status', 'Schváleno')->with('category', 'addons')->where('category_id', $id)->where('accordion_group', 15)->orderBy('position')->get();

        return view('standardy.akreditacni', [
            'title'             => $categorie->category_name,
            'pretitle'          => 'Standardy',
            'categorie'         => $categorie,
            'icon'              => $categorie->fa_icon,
            'doctors'           => $doctors,
            'groups'            => $accordion_groups,
            'allDocuments'      => $allDocuments,
            'allAddons'         => $allAddons,
            'lastpos'           => $last,
            'documents1'        => $documents1,
            'documents2'        => $documents2,
            'documents3'        => $documents3,
            'documents4'        => $documents4,
            'documents5'        => $documents5,
            'documents6'        => $documents6,
            'documents7'        => $documents7,
            'documents8'        => $documents8,
            'documents9'        => $documents9,
            'documents10'       => $documents10,
            'documents11'       => $documents11,
            'documents12'       => $documents12,
            'documents13'       => $documents13,
            'documents14'       => $documents14,
            'documents15'       => $documents15
        ]);
    }

    // Dokument
    public function document($id)
    {
        $allDocuments = Document::where('category_id', '>', 11)->pluck('category_id');
        $standards = Document::where('onscreen', $id)->orderBy('category_id')->get();
        $bozppos = Document::with('category')->where('onscreen', $id)->orderBy('category_id')->get();
        $categorie  = Category::where('id', $id)->first();
        $doctors = Employee::orderBy('last_name')->get();
        $last = Document::where('category_id', $id)->orderBy('id', 'desc')->take(1)->first();
        $addons = Addon::with('category')->where('document_id', '!=', 0)->where('onscreen', $id)->orderBy('category_id')->get();
        $warehouse = Addon::where('document_id', 0)->where('onscreen', $id)->orderBy('description')->get();

        if ($last == null) {
            $last = 0;
        } else {
            $position = $last->position;
            $last = $position;
        }

        if (Auth::user()) {
            $documents = Document::with('category', 'addons', 'user')->where('category_id', $id)->orderBy('category_id')->get();
        } else {
            $documents = Document::with('category', 'addons', 'user')->where('status', 'Schváleno')->where('category_id', $id)->orderBy('category_id')->get();
        }

        return view('dokumenty.dokument', [
            'title'             => $categorie->category_name,
            'pretitle'          => 'Dokumentace',
            'categorie'         => $categorie,
            'icon'              => $categorie->fa_icon,
            'lastpos'           => $last,
            'documents'         => $documents,
            'allDocuments'      => $allDocuments,
            'doctors'           => $doctors,
            'standards'         => $standards,
            'bozppos'           => $bozppos,
            'addons'            => $addons,
            'warehouse'         => $warehouse
        ]);
    }

    // Standardy
    public function standard($id)
    {
        $allDocuments = Document::where('category_id', '<', 12)->pluck('category_id');
        $categorie  = Category::where('id', $id)->first();
        $doctors = Employee::orderBy('last_name')->get();
        $stanicni = Employee::whereJobId('47')->orderBy('last_name')->get();
        $last = Document::where('category_id', $id)->orderBy('id', 'desc')->take(1)->first();

        if ($last == null) {
            $last = 0;
        } else {
            $position = $last->position;
            $last = $position;
        }

        if (Auth::user()) {
            $documents = Document::with('category', 'addons', 'user')->where('category_id', $id)->orderBy('position')->get();
        } else {
            $documents = Document::with('category', 'addons', 'user')->where('status', 'Schváleno')->where('category_id', $id)->orderBy('position')->get();
        }

        return view('standardy.standard', [
            'title'             => $categorie->category_name,
            'pretitle'          => 'Standardy',
            'categorie'         => $categorie,
            'icon'              => $categorie->fa_icon,
            'lastpos'           => $last,
            'documents'         => $documents,
            'allDocuments'      => $allDocuments,
            'doctors'           => $doctors,
            'stanicni'          => $stanicni
        ]);
    }

    // ISP
    public function isp()
    {
        $id = 43;
        $allDocuments = Document::where('category_id', '>', 11)->pluck('category_id');
        $categorie  = Category::where('id', $id)->first();
        $last = Document::where('category_id', $id)->orderBy('id', 'desc')->take(1)->first();

        if (
            $last == null
        ) {
            $last = 0;
        } else {
            $position = $last->position;
            $last = $position;
        }

        if (Auth::user()) {
            $documents = Document::with('category', 'addons', 'user')->where('category_id', $id)->get()->sortBy(['position', 'name']);
            $grouped = $documents->groupBy(function ($item, $key) {
                return $item->name[0];
            })->sortBy(function ($item, $key) {
                return $key;
            });
        } else {
            $documents = Document::with('category', 'addons', 'user')->where('status', 'Schváleno')->where('category_id', $id)->get()->sortBy(['position', 'name']);
            $grouped = $documents->groupBy(function ($item, $key) {
                return $item->name[0];
            })->sortBy(function ($item, $key) {
                return $key;
            });
        }

        return view('isp.isp', [
            'title'             => $categorie->category_name,
            'pretitle'          => 'ISP',
            'categorie'         => $categorie,
            'icon'              => $categorie->fa_icon,
            'lastpos'           => $last,
            'documents'         => $grouped,
            'allDocuments'      => $allDocuments,
        ]);
    }

    // BOZP = PO
    public function bozp($id)
    {
        $allDocuments = Document::where('category_id', '>', '24')->pluck('category_id');
        $categorie  = Category::where('id', $id)->first();
        $standards = Document::where('onscreen', $id)->where('category_id', '<', 12)->orderBy('category_id')->get();
        $last = Document::where('category_id', $id)->orderBy('id', 'desc')->take(1)->first();
        $warehouse = Addon::where('document_id', 0)->where('onscreen', $id)->orderBy('description')->get();
        $doctors = Employee::orderBy('last_name')->get();

        if ($last == null) {
            $last = 0;
        } else {
            $position = $last->position;
            $last = $position;
        }

        if (Auth::user()) {
            $documents = Document::with('category', 'user')->where('category_id', $id)->orderBy('position')->get();
            $oopps = Document::with('category', 'user')->where('category_id', 47)->orderBy('position')->get();
        } else {
            $documents = Document::with('category', 'user')->where('status', 'Schváleno')->where('category_id', $id)->orderBy('position')->get();
            $oopps = Document::with('category', 'user')->where('status', 'Schváleno')->where('category_id', 47)->orderBy('position')->get();
        }

        return view('bozp.index', [
            'title'             => $categorie->category_name,
            'pretitle'          => 'BOZP - PO',
            'categorie'         => $categorie,
            'icon'              => $categorie->fa_icon,
            'lastpos'           => $last,
            'documents'         => $documents,
            'standards'         => $standards,
            'warehouse'         => $warehouse,
            'doctors'           => $doctors,
            'allDocuments'      => $allDocuments,
            'oopps'             => $oopps
        ]);
    }

    // Indikátory kvality
    public function indikatory($id)
    {
        $allDocuments = Document::where('category_id', '>', '36')->pluck('category_id');
        $categorie  = Category::where('id', $id)->first();
        $doctors = Employee::orderBy('last_name')->get();
        $last = Document::where('category_id', $id)->orderBy('id', 'desc')->take(1)->first();

        if ($last == null) {
            $last = 0;
        } else {
            $position = $last->position;
            $last = $position;
        }

        if (Auth::user()) {
            $documents = Document::with('category', 'user')->where('category_id', $id)->orderBy('position', 'asc')->get();
        } else {
            $documents = Document::with('category', 'user')->where('status', 'Schváleno')->where('category_id', $id)->orderBy('position', 'asc')->get();
        }

        return view('indikatory.index', [
            'title'             => $categorie->category_name,
            'pretitle'          => 'Indikátory kvality',
            'categorie'         => $categorie,
            'icon'              => $categorie->fa_icon,
            'lastpos'           => $last,
            'doctors'           => $doctors,
            'documents'         => $documents,
            'allDocuments'      => $allDocuments
        ]);
    }

    // Řídící akty
    public function acts($id)
    {
        $allDocuments = Document::whereCategoryId(['49', '50', '51', '52', '53', '54'])->pluck('category_id');
        $last = Document::where('category_id', $id)->orderBy('id', 'desc')->take(1)->first();
        $categorie  = Category::where('id', $id)->first();
        $doctors = Employee::orderBy('last_name')->get();

        if (
            $last == null
        ) {
            $last = 0;
        } else {
            $position = $last->position;
            $last = $position;
        }

        if (Auth::user()) {
            $documents = Document::with('category', 'user')->where('category_id', $id)->orderBy('position', 'desc')->get();
        } else {
            $documents = Document::with('category', 'user')->where('status', 'Schváleno')->where('category_id', $id)->orderBy('position', 'desc')->get();
        }

        return view('ridici-akty.index', [
            'title'             => $categorie->category_name,
            'pretitle'          => 'Řídící akty',
            'categorie'         => $categorie,
            'lastpos'           => $last,
            'documents'         => $documents,
            'doctors'           => $doctors,
            'allDocuments'      => $allDocuments
        ]);
    }

    // Řídící akty
    public function akreditace($id)
    {
        $allDocuments = Document::whereCategoryId(['55', '57', '58', '59'])->pluck('category_id');
        $last = Document::where('category_id', $id)->orderBy('id', 'desc')->take(1)->first();
        $categorie  = Category::where('id', $id)->first();
        $doctors = Employee::orderBy('last_name')->get();

        if (
            $last == null
        ) {
            $last = 0;
        } else {
            $position = $last->position;
            $last = $position;
        }

        if (Auth::user()) {
            $documents = Document::with('category', 'user')->where('category_id', $id)->orderBy('position', 'desc')->get();
        } else {
            $documents = Document::with('category', 'user')->where('status', 'Schváleno')->where('category_id', $id)->orderBy('position', 'desc')->get();
        }

        return view('akreditace.index', [
            'title'             => $categorie->category_name,
            'pretitle'          => 'Akreditace',
            'categorie'         => $categorie,
            'lastpos'           => $last,
            'documents'         => $documents,
            'doctors'           => $doctors,
            'allDocuments'      => $allDocuments
        ]);
    }

    // Služby
    public function rozpisSluzeb($id)
    {
        $categorie  = Category::where('id', $id)->first();
        $doctors = Employee::with('department')->whereTitlePreffix('MUDr.')->where('department_id', '=', 1)->orderBy('last_name')->get();
        $doctorsJip = Employee::with('department')->whereTitlePreffix('MUDr.')
            ->where('department_id', '>=', 8)
            ->where('department_id', '<=', 9)
            ->orderBy('last_name')->get();
        $doctorsInterna = Employee::with('department')->whereTitlePreffix('MUDr.')
            ->where('department_id', '=', [1, 4, 5])
            ->orderBy('last_name')->get();
        $doctorsNeurologie = Employee::with('department')->whereTitlePreffix('MUDr.')
            ->where('department_id', '>=', 6)
            ->where('department_id', '<=', 7)
            ->orderBy('last_name')->get();
        $doctorsRdg = Employee::with('department')->whereTitlePreffix('MUDr.')
            ->where('department_id', '=', 15)
            ->orderBy('last_name')->get();
        $doctorsAll = Employee::with('department')->whereTitlePreffix('MUDr.')
            ->whereStatus('Aktivní')
            ->orderBy('last_name')->get();

        $os_sestry = Employee::whereDepartmentId(16)->whereStatus('Aktivní')->get();
        $nutricni = Employee::whereJobId(19)->whereStatus('Aktivní')->get();

        $now = Carbon::now();
        $from = $now->startOfMonth()->format('d. m. Y');
        $to = $now->endOfMonth()->format('d. m. Y');
        $monthStartDate     = $now->startOfMonth()->format('Y-m-d');
        $monthEndDate       = $now->endOfMonth()->format('Y-m-d');


        $daylistPrev = DB::table('calendar')
            ->where('date', '>=', $now->startOfMonth()->subMonth()->format('Y-m-d'))
            ->where('date', '<=', $now->endOfMonth()->format('Y-m-d'))
            ->get();

        $daylist = DB::table('calendar')
            ->where('date', '>=', $monthStartDate)
            ->where('date', '<=', $monthEndDate)
            ->get();

        $all = DB::table('calendar')
            ->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->where('date', '<=', Carbon::now()->addMonth()->format('Y-m-d'))
            ->get();

        $daylistNext = DB::table('calendar')
            ->where('date', '>=', $now->endOfMonth()->addMonth()->format('Y-m-d'))
            ->where('date', '<', $now->endOfMonth()->format('Y-m-d'))
            ->get();

        $today = DB::table('calendar')->where('date', Carbon::now()->format('y-m-d'))->get();

        return view('rozpisy-sluzeb.' . $categorie->folder_name . '', [
            'title'             => $categorie->category_name,
            'pretitle'          => 'Rozpis služeb',
            'categorie'         => $categorie,
            'daylist'           => $daylist,
            'daylistPrev'       => $daylistPrev,
            'daylistNext'       => $daylistNext,
            'doctors'           => $doctors,
            'doctorsJip'        => $doctorsJip,
            'os_sestry'         => $os_sestry,
            'doctorsInterna'    => $doctorsInterna,
            'doctorsNeurologie' => $doctorsNeurologie,
            'doctorsRdg'        => $doctorsRdg,
            'nutricni'          => $nutricni,
            'doctorsAll'        => $doctorsAll,
            'from'              => $from,
            'to'                => $to,
            'today'             => $today,
            'all'               => $all
        ]);
    }

    // Zápisy z porad
    public function porady($id)
    {
        $allDocuments = Document::whereCategoryId(['47', '48'])->pluck('category_id');
        $last = Document::where('category_id', $id)->orderBy('id', 'desc')->take(1)->first();
        $categorie  = Category::where('id', $id)->first();
        $doctors = Employee::orderBy('last_name')->get();

        if (
            $last == null
        ) {
            $last = 0;
        } else {
            $position = $last->position;
            $last = $position;
        }

        if (Auth::user()) {
            $documents = Document::with('category', 'user')->where('category_id', $id)->orderBy('revision_date', 'desc')->get();
        } else {
            $documents = Document::with('category', 'user')->where('status', 'Schváleno')->where('category_id', $id)->orderBy('revision_date', 'desc')->get();
        }

        return view('porady.index', [
            'title'             => $categorie->category_name,
            'pretitle'          => 'Zápisy z porad',
            'categorie'         => $categorie,
            'lastpos'           => $last,
            'documents'         => $documents,
            'doctors'           => $doctors,
            'allDocuments'      => $allDocuments
        ]);
    }

    // Radio
    public function radio()
    {
        return redirect()->away('http://192.168.81.121:8000/radio.m3u');
    }

    // Videa-edukativní
    public function video()
    {
        $videos = Video::whereCategory('edukace')->get();

        return view('videa', [
            'pretitle' => 'Média',
            'title' => 'Videa',
            'videos' => $videos
        ]);
    }

    // Videa Lekis
    public function videoLekis()
    {
        $videos = Video::whereCategory('lekis')->get();

        return view('videa', [
            'pretitle' => 'Média',
            'title' => 'Lekis',
            'videos' => $videos
        ]);
    }

    // Videa BOZP
    public function videoBozp()
    {
        $videos = Video::whereCategory('bozp')->get();

        return view('videa', [
            'pretitle' => 'Média',
            'title' => 'BOZP',
            'videos' => $videos
        ]);
    }

    // Edukační materiály
    public function edukace($id)
    {
        $allDocuments = Document::where('category_id', '>', '44')->pluck('category_id');
        $last = Document::where('category_id', $id)->orderBy('id', 'desc')->take(1)->first();
        $categorie  = Category::where('id', $id)->first();
        $doctors = Employee::orderBy('last_name')->get();

        if ($last == null) {
            $last = 0;
        } else {
            $position = $last->position;
            $last = $position;
        }

        if (Auth::user()) {
            $documents = Document::with('category', 'user')->where('category_id', $id)->orderBy('name')->get();
        } else {
            $documents = Document::with('category', 'user')->where('status', 'Schváleno')->where('category_id', $id)->orderBy('name')->get();
        }

        return view('edukace.index', [
            'title'             => $categorie->category_name,
            'categorie'         => $categorie,
            'pretitle'          => $categorie->category_file,
            'lastpos'           => $last,
            'documents'         => $documents,
            'doctors'           => $doctors,
            'allDocuments'      => $allDocuments
        ]);
    }

    // Překladatelé
    public function prekladatele()
    {
        return view('prekladatele', ['pretitle' => 'Média', 'title' => 'Překladatelé']);
    }

    // Pneumatiky
    public function tires()
    {
        return redirect()->away('https://docs.google.com/spreadsheets/d/19Tzhxrq7tVBpZ7LhZ5qEL6ehI3om3q6b/edit#gid=1690889270');
    }

    // ZVOS
    public function zvos()
    {
        $bulletins = Bulletin::orderBy('date_edition')->get();
        return view('zvos.index', ['pretitle' => 'Odbory', 'title' => 'ZV OS', 'bulletins' => $bulletins]);
    }

    // Profil
    public function profile()
    {
        return view('profile.profile', ['pretitle' => 'Profil', 'title' => 'Uživatele']);
    }

    // Interna change sluyby
    public function changeDoctorInterna(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'interna'           => $request->interna,
                    'interna_mobile'    => $request->interna_mobile
                ]);
        }
        return response()->json(['success' => 'Služba upravena!']);
        Alert::toast('Služba upravena!', 'success')->position('center');
    }

    public function changeDoctorNeurologie(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'neurologie'        => $request->neurologie,
                    'neurologie_mobile' => $request->neurologie_mobile,
                ]);
        }
        return response()->json(['success' => 'Služba upravena!']);
        Alert::toast('Služba upravena!', 'success')->position('center');
    }

    // Zurnal change sluzby
    public function changeDoctorZurnal(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'zurnalni_sluzby'   => $request->zurnalni_sluzby,
                    'zurnal_mobile'     => $request->zurnal_mobile
                ]);
        }
        return response()->json(['success' => 'Služba upravena!']);
        Alert::toast('Služba upravena!', 'success')->position('center');
    }

    // Jip change sluzby
    public function changeDoctorJip(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'jip'           => $request->jip,
                    'jip_mobile'    => $request->jip_mobile,
                ]);
        }
        return response()->json(['success' => 'Služba upravena!']);
    }

    // Ortopedie change sluzby
    public function changeDoctorOrtopedie(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'ortopedie'         => $request->ortopedie,
                    'ortopedie_mobile'  => $request->ortopedie_mobile
                ]);
        }
        return response()->json(['success' => 'Služba upravena!']);
        Alert::toast('Služba upravena!', 'success')->position('center');
    }

    // OS change sluzby
    public function changeDoctorOperacniSaly(Request $request)
    {
        if (request()->ajax()) {
            if ($request->os_a) {
                DB::table('calendar')
                    ->where('id', $request->id)
                    ->update(['os_a'    => $request->os_a,]);
            } elseif ($request->os_b) {
                DB::table('calendar')
                    ->where('id', $request->id)
                    ->update(['os_b'    => $request->os_b,]);
            } elseif ($request->os_c) {
                DB::table('calendar')
                    ->where('id', $request->id)
                    ->update(['os_c'    => $request->os_c,]);
            }
        }
        return response()->json(['success' => 'Služba upravena!']);
        Alert::toast('Služba upravena!', 'success')->position('center');
    }

    // RDG change sluzby
    public function changeDoctorRdg(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'rdg'           => $request->rdg,
                    'rdg_mobile'    => $request->rdg_mobile,
                ]);
        }
        return response()->json(['success' => 'Služba upravena!']);
        Alert::toast('Služba upravena!', 'success')->position('center');
    }

    // Prijmova ambulance change sluzby
    public function changePrijmovkaSestra(Request $request)
    {
        if (request()->ajax()) {
            if ($request->prijmova_ambulance_a) {
                DB::table('calendar')
                    ->where('id', $request->id)
                    ->update(['prijmova_ambulance_a'    => $request->prijmova_ambulance_a,]);
            } elseif ($request->prijmova_ambulance_b) {
                DB::table('calendar')
                    ->where('id', $request->id)
                    ->update(['prijmova_ambulance_b'    => $request->prijmova_ambulance_b,]);
            } elseif ($request->prijmova_ambulance_c) {
                DB::table('calendar')
                    ->where('id', $request->id)
                    ->update(['prijmova_ambulance_c'    => $request->prijmova_ambulance_c,]);
            } elseif ($request->prijmova_ambulance_d) {
                DB::table('calendar')
                    ->where('id', $request->id)
                    ->update(['prijmova_ambulance_d'    => $request->prijmova_ambulance_d,]);
            } elseif ($request->prijmova_ambulance_e) {
                DB::table('calendar')
                    ->where('id', $request->id)
                    ->update(['prijmova_ambulance_e'    => $request->prijmova_ambulance_e,]);
            }
        }
        return response()->json(['success' => 'Služba upravena!']);
        Alert::toast('Služba upravena!', 'success')->position('center');
    }

    // Nutriční change sluzby
    public function changeNutricni(Request $request)
    {
        if (request()->ajax()) {
            DB::table('calendar')
                ->where('id', $request->id)
                ->update([
                    'nutricni_terapeuti'   => $request->nutricni_terapeuti,
                    'nutricni_mobile'     => $request->nutricni_mobile
                ]);
        }
        return response()->json(['success' => 'Služba upravena!']);
        Alert::toast('Služba upravena!', 'success')->position('center');
    }

    public function generate_pdf($id)
    {
        $categorie  = Category::where('id', $id)->first();

        $now = Carbon::now();
        $from = $now->startOfMonth()->format('d. m. Y');
        $to = $now->endOfMonth()->format('d. m. Y');
        $monthStartDate     = $now->startOfMonth()->format('Y-m-d');
        $monthEndDate       = $now->endOfMonth()->format('Y-m-d');

        $daylist = DB::table('calendar')
            ->where('date', '>=', $monthStartDate)
            ->where('date', '<=', $monthEndDate)
            ->get();

        return view('pdf.' . $categorie->folder_name . '', [
            'title'       => $categorie->category_name,
            'categorie'   => $categorie,
            'from'        => $from,
            'to'          => $to,
            'daylist'     => $daylist,
        ]);
    }
}
