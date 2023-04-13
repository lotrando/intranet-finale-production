<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            $notification = Notification::with('user')->whereStatus('Zobrazeno')->latest()->get();
        }
        return $notification;
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

            'title'                 => 'required',
            'content'               => 'required',
            'type_id'               => 'required',
            'importance'            => 'required',
            'content'               => 'required',
            'status'                => 'required',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'title'                 => $request->title,
            'content'               => $request->content,
            'status'                => $request->status,
            'type_id'               => $request->type_id,
            'importance'            => $request->importance,
            'user_id'               => Auth::user()->id
        ];

        Notification::create($form_data);

        Alert::toast('Oznámení úspěšně vytvořeno!', 'success')->position('center');

        return response()->json(['success' => 'Oznámení úspěšně vytvořeno']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Notification::with('user', 'type')->findOrFail($id);
        if (request()->ajax()) {
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $rules = [
            'title'                 => 'required',
            'content'               => 'required',
            'type_id'               => 'required',
            'importance'            => 'required',
            'status'                => 'required',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = [
            'title'                 => $request->title,
            'content'               => $request->content,
            'type_id'               => $request->type_id,
            'status'                => $request->status,
            'importance'            => $request->importance,
            'user_id'               => $request->user_id,
        ];

        Notification::whereId($request->hidden_id)->update($form_data);

        Alert::toast('Oznámení aktualizováno!', 'success')->position('center');
        return response()->json(['success' => 'Oznámení aktualizováno!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        return response()->json(['success' => __('Oznameni deleted successfully')]);
    }
}
