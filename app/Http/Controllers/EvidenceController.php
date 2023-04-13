<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Evidence;
use App\Models\Toner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = Department::all();
        $toners = Toner::all();

        if ($request->ajax()) {

            $model = Evidence::with('department', 'toner', 'user')->select('*');

            return DataTables::eloquent($model)

                ->addColumn('action', function ($data) {
                    $buttons = '
                        <center>
                            <span class="btn btn-icon btn-link" id="dropdownMenuButton-' . $data->id . '" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="18" x2="20" y2="18"></line>
                            </svg>
                            </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-' . $data->id . '">
                                <li class="dropdown-item edit" name="edit" id="' . $data->id . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                    Upravit zaměstnance
                                </li>
                                <li class="dropdown-item delete" name="delete" id="' . $data->id . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7h16"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path><path d="M10 12l4 4m0 -4l-4 4"></path>
                                    </svg>
                                    Odstranit zaměstnance
                                </li>
                            </ul>
                        </center>
                        ';
                    return $buttons;
                })

                ->toJson();
        }

        return view('evidence.index')->with([
            'departments' => $departments,
            'toners' => $toners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'department_id'     =>  'required',
            'toner_id'        =>  'required',
            'Evidence_id'       =>  'required',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'department_id'     =>  $request->department_id,
            'user_id'           =>  Auth::user()->id,
            'Evidence_id'       =>  $request->Evidence_id
        ];

        Evidence::create($form_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evidence  $Evidence
     * @return \Illuminate\Http\Response
     */
    public function show(Evidence $evidence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Evidence::with('department', 'toner', 'user')->findOrFail($id);
        if (request()->ajax()) {
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'department_id'     =>  'required',
            'printer_id'        =>  'required',
            'toner_id'          =>  'required',
            'user_id'           =>  'required'
        ];

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'department_id'     =>  $request->department_id,
            'printer_id'        =>  $request->printer_id,
            'toner_id'          =>  $request->toner_id,
            'user_id'           =>  Auth::user()->id,
        ];

        Evidence::whereId($request->hidden_id)->update($form_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evidence = Evidence::find($id);
        $evidence->delete();
    }
}
