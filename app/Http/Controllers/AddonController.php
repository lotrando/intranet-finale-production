<?php

namespace App\Http\Controllers;

use App\Mail\StandardUpdatedMail;
use App\Models\Addon;
use App\Models\Document;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $unwantedChars = [
            'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ř' => 'r', 'č' => 'c', 'ě' => 'e', 'ů' => 'u', 'ň' => 'n', 'Ř' => 'R',
            'Č' => 'C', 'Ě' => 'E', 'Ů' => 'U', 'Ú' => 'U', 'Ň' => 'N', '/' => '-', ':' => '-', ';' => '-', ' ' => '_', '+' => '_'
        ];

        $rules = [
            'add_id'                    => 'required',
            'add_category_id'           => 'required',
            'add_position'              => 'required|numeric',
            'add_description'           => 'required',
            'add_processed'             => 'nullable',
            'add_revision'              => 'required',
            'add_status'                => 'required',
            'add_onscreen'              => 'nullable',
            'add_file'                  => 'required|mimes:pdf,docx,xlsx,pptx|max:8192'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $file_ext  = $request->add_file->extension();
        $description = Str::lower(strtr($request->add_description, $unwantedChars));
        $revision = Str::lower(strtr($request->add_revision, $unwantedChars));
        $file_name = $request->add_category_file . '_' . $request->add_folder_name . '-' . $description . '-priloha-' . $request->add_position . '-revize-' . $revision . '.' . $file_ext;
        $request->add_file->move(public_path('/soubory/'), $file_name);

        $form_data = [
            'document_id'           => $request->add_id,
            'category_id'           => $request->add_category_id,
            'description'           => $request->add_description,
            'processed'             => $request->add_processed,
            'revision'              => $request->add_revision,
            'position'              => $request->add_position,
            'file'                  => $file_name,
            'status'                => $request->add_status,
            'onscreen'              => $request->add_onscreen,
            'user_id'               => Auth::user()->id
        ];

        Addon::create($form_data);

        Alert::toast('Příloha úspěšně připojena k dokumentu!', 'success')->position('center');

        return response()->json(['success' => 'Příloha úspěšně připojena k dokumentu!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Addon::with('document', 'category', 'user')->findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Addon::with('document', 'category', 'user')->findOrFail($id);
        if (request()->ajax()) {
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $file = $request->file;
        if ($file != '') {

            $rules = [
                'add_id'                    => 'required',
                'add_description'           => 'required',
                'add_processed'             => 'nullable',
                'add_position'              => 'required|numeric',
                'add_revision'              => 'required',
                'add_status'                => 'required',
                'add_onscreen'              => 'nullable',
                'add_file'                  => 'required|mimes:pdf,docx,xlsx,pptx|max:8192'
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
                'Č' => 'C', 'Ě' => 'E', 'Ů' => 'U', 'Ú' => 'U', 'Ň' => 'N', '/' => '-', ':' => '-', ';' => '-', ' ' => '_', '+' => '_'
            ];

            $file_ext  = $request->add_file->extension();
            $description = Str::lower(strtr($request->description, $unwantedChars));
            $revision = Str::lower(strtr($request->revision, $unwantedChars));
            $file_name = $request->add_category_file . '_' . $request->add_folder_name . '-' . $description . '-priloha-' . $request->add_position . '-revize-' . $revision . '.' . $file_ext;
            $request->add_file->move(public_path('/soubory/'), $file_name);

            $form_data = [
                'document_id'           => $request->add_id,
                'category_id'           => $request->add_category_id,
                'description'           => $request->add_description,
                'processed'             => $request->add_processed,
                'revision'              => $request->add_revision,
                'position'              => $request->add_position,
                'file'                  => $file_name,
                'status'                => $request->add_status,
                'onscreen'              => $request->add_onscreen,
                'user_id'               => Auth::user()->id
            ];
        } else {

            $rules = [
                'add_id'                    => 'required',
                'add_description'           => 'required',
                'add_processed'             => 'nullable',
                'add_position'              => 'required|numeric',
                'add_revision'              => 'required',
                'add_status'                => 'required',
                'add_onscreen'              => 'nullable'
            ];

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $form_data = [
                'document_id'           => $request->add_id,
                'category_id'           => $request->add_category_id,
                'description'           => $request->add_description,
                'revision'              => $request->add_revision,
                'position'              => $request->add_position,
                'status'                => $request->add_status,
                'onscreen'              => $request->add_onscreen,
                'user_id'               => Auth::user()->id
            ];
        }

        Addon::whereId($request->add_hidden_id)->update($form_data);

        // $emailData = Addon::with('category')->where('id', $request->hidden_id)->get();
        // // $emailData = Document::with('category')->where('updated_at', '>=', '2023-01-18 13:35:09')->get();
        // $stanicniSestry = Employee::where('job_id', '47')->pluck('email');

        // //Mail::to($stanicniSestry)->send(new StandardUpdatedMail($emailData));

        Alert::toast('Příloha úspěšně aktualizována!', 'success')->position('center');

        return response()->json(['success' => 'Příloha úspěšně aktualizována!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Addon::find($id);
        $filename = Addon::where('id', $id)->pluck('file');

        File::delete('soubory/' . $filename[0]);
        $document->delete();

        return response()->json(['success' => __('Addon deleted successfully')]);
    }

    public function documentSearch(Request $request)
    {
        if ($request->ajax()) {

            $output = "";

            if (Auth::check()) {
                $documents = Document::with('category', 'addons')->orderByDesc('category_id')
                    ->orWhere('unique_code', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('name', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('description', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('tags', 'LIKE', '%' . $request->search . "%")
                    ->get();
            } else {
                $documents = Document::with('category', 'addons')->orderByDesc('category_id')
                    ->orWhere('unique_code', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('name', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('description', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('tags', 'LIKE', '%' . $request->search . "%")
                    ->where('status', 'Schváleno')
                    ->get();
            }


            foreach ($documents as $document) {

                $output .=
                    '<div class="accordion-item">
                        <div id="test-' . $document->position . '">
                            <div class="accordion-body p-1">
                            <div class="list-group list-group-flush list-group-hoverable pt-1">
                                <div class="list-group-item border-0 p-0">
                                <div class="row align-items-center mx-2 g-3">

                                    <div class="avatar bg-' . $document->category->color . '-lt col-auto">
                                    <a href="/' . $document->category->category_file . '/' . $document->category->folder_name . '/' . $document->category->id . '">
                                    <div class="text-uppercase">
                                        ' . $document->category->svg_icon . '
                                    </div>
                                    </a>
                                    </div>
                                    <div class="col-auto">
                                    <a href="/soubory/' . $document->category->category_type . '/' . $document->id . '" target="_blank">
                                        <span class="avatar bg-' . $document->category->color . '-lt">
                                        <img src="../../img/files/pdf.png" height="32px" alt="PDF soubor" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Stáhnout standard">
                                        </span>
                                    </a>
                                    </div>
                                    <div id="' . $document->id . '" class="col text-truncate">
                                    <span>
                                        <p id="' . $document->id . '" class="show strong d-inline cursor-pointer text-primary text-decoration-none" style="margin-bottom: 0;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Více informací o standardu">' . $document->name . '</p>
                                    </span>
                                    <div class="d-block description text-muted text-truncate">' . $document->description . '</div>
                                    </div>
                                </div>
                                </div>
                                <div class="list-group-item py-1 px-2">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-auto">
                                    <span class="text-muted description">Aktualizováno ' . \Carbon\Carbon::parse($document->updated_at)->diffForHumans() . '</span>
                                    <svg class="icon text-yellow" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="15" cy="15" r="3"></circle>
                                    <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5"></path>
                                    <path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73"></path>
                                    <line x1="6" y1="9" x2="18" y2="9"></line>
                                    <line x1="6" y1="12" x2="9" y2="12"></line>
                                    <line x1="6" y1="15" x2="8" y2="15"></line>
                                    </svg>
                                    <span class="text-muted description">Revize:' . $document->revision . '</span>
                                    </div>
                                    <div class="col-auto d-xs-none d-sm-none d-lg-inline">
                                    <span class="text-muted description">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-lime" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                        <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                                        <path d="M9 12v-1h6v1"></path>
                                        <path d="M12 11v6"></path>
                                        <path d="M11 17h2"></path>
                                        </svg>
                                        Zpracoval:' . $document->processed . '
                                    </span>
                                    <span class="text-muted description">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5"></path>
                                        <circle cx="16.5" cy="17.5" r="2.5"></circle>
                                        <line x1="18.5" y1="19.5" x2="21" y2="22"></line>
                                        </svg>
                                        Přezkoumal:' . $document->examine . '
                                    </span>
                                    <span class="text-muted description">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5"></path>
                                        <circle cx="6" cy="14" r="3"></circle>
                                        <path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path>
                                        </svg>
                                        Autorizoval:' . $document->authorize . '
                                    </span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>';;
            }

            return Response($output);
        }
    }
}
