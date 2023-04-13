<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendace = Attendance::with('training')->get();
        return $attendace;
    }

    public function store(Request $request)
    {
        $rules = [
            'personal_number'   =>  'required',
            'last_name'         =>  'required',
            'first_name'        =>  'required',
            'training_id'       =>  'required',
            'start_time'        =>  'required',
            'end_time'          =>  'required',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'personal_number'   =>  $request->personal_number,
            'last_name'         =>  $request->last_name,
            'first_name'        =>  $request->first_name,
            'training_id'       =>  $request->training_id,
            'start_time'        =>  $request->start_time,
            'end_time'          =>  $request->end_time,
        ];

        Attendance::create($form_data);

        return redirect()->away('http://intranet2');
    }

    public function update(Request $request)
    {
        //
    }
}
