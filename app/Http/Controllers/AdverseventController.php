<?php

namespace App\Http\Controllers;

use App\Models\Adversevent;
use App\Models\Category;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AdverseventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::with('documents')->get();
        $departments = Department::orderBy('department_name')->get();
        $doctors = Employee::where('title_preffix', 'LIKE', '%' . 'Dr.' . '%')->orderBy('last_name')->get();

        $model = Adversevent::join('departments', 'adversevents.department_id', '=', 'departments.id')
            ->select('*', 'adversevents.id');

        if ($request->ajax()) {

            return Datatables::eloquent($model)

                ->addColumn('action', function ($data) {
                    $buttons = '
                        <center>
                            <span title="Možnosti" class="cursor-pointer btn btn-icon hover-shadow" id="dropdownMenuButton-' . $data->id . '" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="18" x2="20" y2="18"></line>
                            </svg>
                            </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-' . $data->id . '">
                                <li class="dropdown-item edit" name="edit" id="' . $data->id . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                    Upravit událost
                                </li>
                                     <li class="dropdown-item delete" name="delete" id="' . $data->id . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon dropdown-item-icon-delete" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7h16"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path><path d="M10 12l4 4m0 -4l-4 4"></path>
                                    </svg>
                                    Odstranit událost
                                </li>
                            </ul>
                        </center>
                        ';
                    return $buttons;
                })

                ->toJson();
        }

        return view('adversevents.index')->with([
            'categories'    => $categories,
            'title'         => 'Nežádoucí události',
            'departments'   => $departments,
            'doctors'       => $doctors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adversevents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'department_id'         => 'required',
            'misto'                 => 'required',
            'datum_cas'             => 'required',
            'cas'                   => 'required',
            'spec_druh'             => 'required',
            'jinydoplnek'           => $request->spec_druh === 'Jiný' ? 'sometimes|required' : 'nullable',
            'chorobopis'            => 'nullable',
            'pacient'               => $request->spec_druh === 'Jiný' ? 'nullable' : 'sometimes|required',
            'datumnaroz'            => $request->spec_druh === 'Jiný' ? 'nullable' : 'sometimes|required',
            'pracovnik'             => 'required',
            'svedek'                => 'nullable',
            'udalost'               => 'required',
            'reseni'                => 'required',
            'opatreni'              => 'required',
            'informovan'            => 'required',
            'pricina'               => $request->spec_druh === 'Pád' ? 'sometimes|required' : 'nullable',
            'stav_pacienta'         => $request->spec_druh === 'Pád' ? 'sometimes|required' : 'nullable',
            'lokalizace'            => $request->spec_druh === 'Pád' ? 'sometimes|required' : 'nullable',
            'druh_zraneni'          => $request->spec_druh === 'Pád' ? 'sometimes|required' : 'nullable',
            'preventivni_opatreni'  => 'nullable',
            'zhodnoceni_stavu'      => 'nullable',
            'datum'                 => 'nullable',
            'jmeno_lekare'          => 'nullable',
            'vyvoj'                 => 'nullable',
            'upresneni'             => $request->vyvoj === 'jiný' ? 'sometimes|required' : 'nullable',
            'status'                => 'required',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'department_id'         => $request->department_id,
            'misto'                 => $request->misto,
            'datum_cas'             => $request->datum_cas,
            'cas'                   => $request->cas,
            'spec_druh'             => $request->spec_druh,
            'jinydoplnek'           => $request->jinydoplnek,
            'pracovnik'             => $request->pracovnik,
            'svedek'                => $request->svedek,
            'pacient'               => $request->pacient,
            'datumnaroz'            => $request->datumnaroz,
            'chorobopis'            => $request->chorobopis,
            'udalost'               => $request->udalost,
            'reseni'                => $request->reseni,
            'opatreni'              => $request->opatreni,
            'informovan'            => $request->informovan,
            'pricina'               => $request->pricina,
            'jina_pricina'          => $request->jina_pricina,
            'stav_pacienta'         => $request->stav_pacienta,
            'lokalizace'            => $request->lokalizace,
            'druh_zraneni'          => $request->druh_zraneni,
            'preventivni_opatreni'  => $request->preventivni_opatreni,
            'zhodnoceni_stavu'      => $request->zhodnoceni_stavu,
            'datum'                 => $request->datum,
            'jmeno_lekare'          => $request->jmeno_lekare,
            'vyvoj'                 => $request->vyvoj,
            'upresneni'             => $request->upresneni,
            'status'                => $request->status,
            'resitel'               => $request->rešitel,
            'vyjadreni'             => $request->vyjadreni,
        ];

        Adversevent::create($form_data);

        return response()->json(['success' => 'Nežádoucí událost uložena do databáze']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adversevent  $adversevent
     * @return \Illuminate\Http\Response
     */
    public function show(Adversevent $adversevent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adversevent  $adversevent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Adversevent::with('department')->findOrFail($id);
        if (request()->ajax()) {
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adversevent  $adversevent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'department_id'         => 'required',
            'misto'                 => 'required',
            'datum_cas'             => 'required',
            'cas'                   => 'required',
            'spec_druh'             => 'required',
            'jinydoplnek'           => 'nullable',
            'chorobopis'            => 'nullable',
            'pacient'               => 'required',
            'datumnaroz'            => 'required',
            'pracovnik'             => 'required',
            'svedek'                => 'nullable',
            'udalost'               => 'required',
            'reseni'                => 'required',
            'opatreni'              => 'required',
            'informovan'            => 'nullable',
            'pricina'               => 'nullable',
            'jina_pricina'          => 'nullable',
            'stav_pacienta'         => 'nullable',
            'lokalizace'            => 'nullable',
            'druh_zraneni'          => 'nullable',
            'preventivni_opatreni'  => 'nullable',
            'zhodnoceni_stavu'      => 'nullable',
            'datum'                 => 'nullable',
            'jmeno_lekare'          => 'nullable',
            'vyvoj'                 => 'nullable',
            'upresneni'             => 'nullable',
            'status'                => 'required',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'department_id'         => $request->department_id,
            'misto'                 => $request->misto,
            'datum_cas'             => $request->datum_cas,
            'cas'                   => $request->cas,
            'spec_druh'             => $request->spec_druh,
            'jinydoplnek'           => $request->jinydoplnek,
            'pracovnik'             => $request->pracovnik,
            'svedek'                => $request->svedek,
            'pacient'               => $request->pacient,
            'datumnaroz'            => $request->datumnaroz,
            'chorobopis'            => $request->chorobopis,
            'udalost'               => $request->udalost,
            'reseni'                => $request->reseni,
            'opatreni'              => $request->opatreni,
            'informovan'            => $request->informovan,
            'pricina'               => $request->pricina,
            'jina_pricina'          => $request->jina_pricina,
            'stav_pacienta'         => $request->stav_pacienta,
            'lokalizace'            => $request->lokalizace,
            'druh_zraneni'          => $request->druh_zraneni,
            'preventivni_opatreni'  => $request->preventivni_opatreni,
            'zhodnoceni_stavu'      => $request->zhodnoceni_stavu,
            'datum'                 => $request->datum,
            'jmeno_lekare'          => $request->jmeno_lekare,
            'vyvoj'                 => $request->vyvoj,
            'upresneni'             => $request->upresneni,
            'status'                => $request->status,
            'resitel'               => $request->rešitel,
            'vyjadreni'             => $request->vyjadreni,
        ];

        Adversevent::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Událost aktualizována']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adversevent  $adversevent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adverse = Adversevent::find($id);
        $adverse->delete();
        return response()->json(['success' => __('Adverse event deleted successfully')]);
    }
}
