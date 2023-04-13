<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            $videos = Video::with('user')->whereStatus('Zobrazeno')->latest()->get();
        }
        return $videos;
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
            'name'       => 'required',
            'image'      => 'required|mimes:png,jpg,jpeg|max:8192',
            'video'      => 'required|mimes:mp4,webm',
            'category'   => 'required',
            'content'    => 'nullable',
            'status'     => 'required',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $unwantedChars = [
            'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ř' => 'r', 'č' => 'c', 'ě' => 'e', 'ů' => 'u', 'ň' => 'n', 'Ř' => 'R',
            'Č' => 'C', 'Ě' => 'E', 'Ů' => 'U', 'Ú' => 'U', 'Ň' => 'N', '/' => '_', ':' => '_', ';' => '_', ' ' => '_', '+' =>
            '_', '.' => '_'
        ];

        $image_ext  = $request->image->extension();
        $video_ext  = $request->video->extension();

        $name = Str::lower(strtr($request->name, $unwantedChars));

        $image_name = $name . '.' . $image_ext;
        $video_name = $name . '.' . $video_ext;

        $request->image->move(public_path('/videa/'), $image_name);
        $request->video->move(public_path('/videa/'), $video_name);

        $form_data = [
            'name'                  => $request->name,
            'image'                 => 'videa/' . $image_name,
            'video'                 => 'videa/' . $video_name,
            'category'              => $request->category,
            'content'               => $request->content,
            'status'                => $request->status,
            'user_id'               => Auth::user()->id
        ];

        Video::create($form_data);

        Alert::toast('Video položka úspěšně vytvořena!', 'success')->position('center');

        return response()->json(['success' => 'Video položka úspěšně vytvořena']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
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
        $data = Video::with('user')->findOrFail($id);
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
        $video = $request->video;
        $image = $request->image;
        if ($image != '' or $video != '') {
            $rules = [
                'name'       => 'required',
                'image'      => 'required|mimes:png,jpg,jpeg|max:8192',
                'video'      => 'required|mimes:mp4',
                'category'   => 'required',
                'content'    => 'nullable',
                'status'     => 'required',
            ];

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $unwantedChars = [
                'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
                'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
                'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
                'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
                'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ř' => 'r', 'č' => 'c', 'ě' => 'e', 'ů' => 'u', 'ň' => 'n', 'Ř' => 'R',
                'Č' => 'C', 'Ě' => 'E', 'Ů' => 'U', 'Ú' => 'U', 'Ň' => 'N', '/' => '_', ':' => '_', ';' => '_', ' ' => '_', '+' =>
                '_', '.' => '_'
            ];

            $image_ext  = $request->image->extension();
            $video_ext  = $request->video->extension();

            $name = Str::lower(strtr($request->name, $unwantedChars));

            $image_name = $name . '.' . $image_ext;
            $video_name = $name . '.' . $video_ext;

            $request->image->move(public_path('/videa/'), $image_name);
            $request->video->move(public_path('/videa/'), $video_name);

            $form_data = [
                'name'                  => $request->name,
                'image'                 => $request->image_name,
                'video'                 => $request->video_name,
                'category'              => $request->category,
                'content'               => $request->content,
                'status'                => $request->status,
                'user_id'               => Auth::user()->id
            ];
        } else {
            $rules = [
                'name'       => 'required',
                'category'   => 'required',
                'content'    => 'nullable',
                'status'     => 'required',
            ];

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $form_data = [
                'name'                  => $request->name,
                'category'              => $request->category,
                'content'               => $request->content,
                'status'                => $request->status,
                'user_id'               => Auth::user()->id
            ];
        }

        Video::whereId($request->hidden_id)->update($form_data);

        Alert::toast('Video aktualizováno!', 'success')->position('center');
        return response()->json(['success' => 'Video aktualizováno!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Video::find($id);
        $notification->delete();

        return response()->json(['success' => __('Video deleted successfully')]);
    }
}
