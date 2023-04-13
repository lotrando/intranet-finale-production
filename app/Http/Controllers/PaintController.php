<?php

namespace App\Http\Controllers;

use App\Mail\PaintClean;
use App\Mail\PaintCreate;
use App\Mail\PaintDelete;
use App\Mail\PaintUpdate;
use App\Models\Department;
use App\Models\Paint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = Department::orderBy('department_name')->get();
        $columns     = Schema::getColumnListing('paints');

        $startDate  = Carbon::parse($request->filter_start);
        $endDate    = Carbon::parse($request->filter_end);

        $model = Paint::with('department', 'user')
            ->WhereDate('date_start', '>=', $startDate->format('Y-m-d'))
            ->WhereDate('date_end', '<=', $endDate->format('Y-m-d'))
            ->select('*', 'paints.id');

        return view('reservations.paint.index')->with([
            'title'         => 'Rezervace',
            'departments'   => $departments,
            'columns'       => $columns
        ]);

        if ($request->ajax()) {

            return DataTables::eloquent($model)

                ->addColumn('action', function ($data) {
                    if (Auth::user()) {
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
                                    Upravit rezervaci
                                </li>
                                <li class="dropdown-item delete" name="delete" id="' . $data->id . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon dropdown-item-icon-delete" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7h16"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path><path d="M10 12l4 4m0 -4l-4 4"></path>
                                    </svg>
                                    Odstranit rezervaci
                                </li>
                            </ul>
                        </center>
                        ';
                        return $buttons;
                    }
                })

                ->toJson();
        }

        return view('reservations.paint.index')->with([
            'title'         => 'Rezervace',
            'departments'   => $departments,
            'columns'       => $columns
        ]);
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
            'user_id'               => 'required',
            'date_start'            => 'required',
            'date_end'              => 'required',
            'rooms'                 => 'required',
            'status'                => 'required',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'department_id'         => $request->department_id,
            'user_id'               => $request->user_id,
            'date_start'            => $request->date_start,
            'date_end'              => $request->date_end,
            'rooms'                 => $request->rooms,
            'specials'              => $request->specials,
            'status'                => $request->status,
        ];

        Paint::create($form_data);

        $reservation = Paint::with('department', 'user')->latest()->first();

        $data = [
            'id'            => $reservation->id,
            'user'          => $reservation->user->name,
            'email'         => $reservation->user->email,
            'department'    => $reservation->department->department_name,
            'rooms'         => $reservation->rooms,
            'specials'      => $reservation->specials,
            'status'        => $reservation->status,
            'start'         => $reservation->date_start,
            'end'           => $reservation->date_end,
        ];

        foreach (['belica@khn.cz', 'vedouci.uklidu@khn.cz'] as $recipients) {
            Mail::to($recipients)->send(new PaintCreate($data));
        }

        return response()->json(['success' => 'Nová rezervace malování uložena do databáze']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paint  $adversevent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Paint::with('department')->findOrFail($id);
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
            'user_id'               => 'required',
            'date_start'            => 'required',
            'date_end'              => 'required',
            'rooms'                 => 'required',
            'specials'              => 'nullable',
            'status'                => 'required',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'department_id'         => $request->department_id,
            'user_id'               => Auth::user()->id,
            'date_start'            => $request->date_start,
            'date_end'              => $request->date_end,
            'rooms'                 => $request->rooms,
            'specials'              => $request->specials,
            'status'                => $request->status,
        ];


        Paint::whereId($request->hidden_id)->update($form_data);

        $oldreservation = Paint::find($request->hidden_id);
        $reservation = Paint::with('department', 'user')->find($request->hidden_id);

        $data = [
            'id'            => $reservation->id,
            'user'          => $reservation->user->name,
            'email'         => $reservation->user->email,
            'olddepartment' => $oldreservation->department->department_name,
            'oldrooms'      => $oldreservation->rooms,
            'oldstart'      => $oldreservation->date_start,
            'oldend'        => $oldreservation->date_end,
            'department'    => $reservation->department->department_name,
            'rooms'         => $reservation->rooms,
            'start'         => $reservation->date_start,
            'end'           => $reservation->date_end,
            'status'        => $reservation->status,
        ];

        if ($reservation->status == 'Schváleno') {
            Mail::to('vedouci.uklidu@khn.cz')->send(new PaintClean($data));
        }

        foreach (['belica@khn.cz', 'vedouci.uklidu@khn.cz'] as $recipients) {
            Mail::to($recipients)->send(new PaintUpdate($data));
        }


        return response()->json(['success' => 'Rezervace aktualizována']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paint  $adversevent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Paint::with('department', 'user')->find($id);

        $data = [
            'id'            => $reservation->id,
            'user'          => $reservation->user->name,
            'email'         => $reservation->user->email,
            'department'    => $reservation->department->department_name,
            'rooms'         => $reservation->rooms,
            'specials'      => $reservation->specials,
            'status'        => $reservation->status,
            'start'         => $reservation->date_start,
            'end'           => $reservation->date_end,
        ];

        foreach (['belica@khn.cz', 'vedouci.uklidu@khn.cz'] as $recipients) {
            Mail::to($recipients)->send(new PaintDelete($data));
        }

        $paint = Paint::find($id);
        $paint->delete();
        return response()->json(['success' => 'Paint reservation deleted successfully']);
    }
}
