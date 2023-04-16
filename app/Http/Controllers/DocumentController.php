<?php

namespace App\Http\Controllers;

use App\Mail\StandardStoreMail;
use App\Mail\StandardUpdatedMail;
use App\Models\Document;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


class DocumentController extends Controller
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
        $rules = [
            'category_id'           => 'required',
            'accordion_name'        => 'nullable',
            'accordion_group'       => 'nullable',
            'name'                  => 'required',
            'description'           => 'required',
            'processed'             => 'nullable',
            'authorize'             => 'nullable',
            'examine'               => 'nullable',
            'efficiency'            => 'nullable',
            'position'              => 'required|numeric',
            'revision'              => 'required',
            'unique_code'           => 'nullable',
            'revision_date'         => 'nullable',
            'next_revision_date'    => 'nullable',
            'tags'                  => 'nullable',
            'status'                => 'required',
            'onscreen'              => 'nullable',
            'file'                  => 'required|mimes:pdf,docx,xlsx,pptx|max:8192'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $file_ext  = $request->file->extension();
        $description = Str::lower(removeCzechSymbols($request->description));
        $name = Str::lower(removeCzechSymbols($request->name));
        $revision = Str::lower(removeCzechSymbols($request->revision));
        $file_name = $request->category_file . '_' . $request->folder_name . '-' . $name . '-' . $description . '-revize-' . $revision . '.' . $file_ext;
        $request->file->move(public_path('/soubory/'), $file_name);

        $form_data = [
            'category_id'           => $request->category_id,
            'accordion_name'        => $request->name,
            'accordion_group'       => $request->accordion_group,
            'name'                  => $request->name,
            'description'           => $request->description,
            'processed'             => $request->processed,
            'authorize'             => $request->authorize,
            'examine'               => $request->examine,
            'efficiency'            => $request->efficiency,
            'revision'              => $request->revision,
            'revision_date'         => $request->revision_date,
            'next_revision_date'    => $request->next_revision_date,
            'tags'                  => $request->tags,
            'position'              => $request->position,
            'file'                  => $file_name,
            'unique_code'           => $request->unique_code,
            'status'                => $request->status,
            'onscreen'              => $request->onscreen,
            'user_id'               => Auth::user()->id
        ];

        $standardData = Document::create($form_data);

        if (($request->infomail) == 'ano') {
            $stanicniSestry = Employee::whereJobId(47)->pluck('email');
            $emailData = Document::with('category')->whereId($standardData->id)->get();
            Mail::to($stanicniSestry)->send(new StandardStoreMail($emailData));
        }

        Alert::toast('Dokument úspěšně vytvořen!', 'success')->position('center');

        return response()->json(['success' => 'Standard uložen do databáze']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $id = $document->id;

        $data = Document::with('category', 'user')->findOrFail($id);
        if (request()->ajax()) {
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Document::with('category', 'user')->findOrFail($id);
        if (request()->ajax()) {
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $file = $request->file;
        if ($file != '') {
            $rules = [
                'category_id'           => 'required',
                'accordion_name'        => 'nullable',
                'accordion_group'       => 'nullable',
                'name'                  => 'required',
                'description'           => 'required',
                'processed'             => 'nullable',
                'authorize'             => 'nullable',
                'examine'               => 'nullable',
                'efficiency'            => 'nullable',
                'position'              => 'required|numeric',
                'revision'              => 'required',
                'revision_date'         => 'nullable',
                'next_revision_date'    => 'nullable',
                'tags'                  => 'nullable',
                'status'                => 'required',
                'onscreen'              => 'nullable',
                'file'                  => 'required|mimes:pdf,docx,xlsx,pptx|max:8192'
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

            $file_ext  = $request->file->extension();
            $name = Str::lower(strtr($request->name, $unwantedChars));
            $description = Str::lower(strtr($request->description, $unwantedChars));
            $revision = Str::lower(strtr($request->revision, $unwantedChars));
            $file_name = $request->category_file . '_' . $request->folder_name . '-' . $name . '-' . $description . '-revize-' . $revision . '.' . $file_ext;
            $request->file->move(public_path('/soubory/'), $file_name);

            $form_data = [
                'category_id'           => $request->category_id,
                'accordion_name'        => $request->name,
                'accordion_group'       => $request->accordion_group,
                'name'                  => $request->name,
                'description'           => $request->description,
                'processed'             => $request->processed,
                'authorize'             => $request->authorize,
                'examine'               => $request->examine,
                'efficiency'            => $request->efficiency,
                'revision'              => $request->revision,
                'revision_date'         => $request->revision_date,
                'next_revision_date'    => $request->next_revision_date,
                'tags'                  => $request->tags,
                'position'              => $request->position,
                'file'                  => $file_name,
                'unique_code'           => $request->unique_code,
                'status'                => $request->status,
                'onscreen'              => $request->onscreen,
                'user_id'               => Auth::user()->id
            ];
        } else {
            $rules = [
                'category_id'           => 'required',
                'accordion_name'        => 'nullable',
                'accordion_group'       => 'nullable',
                'name'                  => 'required',
                'description'           => 'required',
                'processed'             => 'nullable',
                'authorize'             => 'nullable',
                'examine'               => 'nullable',
                'efficiency'            => 'nullable',
                'position'              => 'required|numeric',
                'revision'              => 'required',
                'revision_date'         => 'nullable',
                'next_revision_date'    => 'nullable',
                'tags'                  => 'nullable',
                'status'                => 'required',
                'onscreen'              => 'nullable'
            ];

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $form_data = [
                'category_id'           => $request->category_id,
                'accordion_name'        => $request->name,
                'accordion_group'       => $request->accordion_group,
                'name'                  => $request->name,
                'description'           => $request->description,
                'processed'             => $request->processed,
                'authorize'             => $request->authorize,
                'examine'               => $request->examine,
                'efficiency'            => $request->efficiency,
                'revision'              => $request->revision,
                'revision_date'         => $request->revision_date,
                'next_revision_date'    => $request->next_revision_date,
                'tags'                  => $request->tags,
                'position'              => $request->position,
                'unique_code'           => $request->unique_code,
                'status'                => $request->status,
                'onscreen'              => $request->onscreen,
                'user_id'               => Auth::user()->id
            ];
        }

        Document::whereId($request->hidden_id)->update($form_data);

        if (($request->infomail) == 'ano') {
            $emailData = Document::with('category')->whereId($request->hidden_id)->get();
            $stanicniSestry = Employee::whereJobId(47)->pluck('email');
            Mail::to($stanicniSestry)->send(new StandardUpdatedMail($emailData));
        }

        Alert::toast('Dokument aktualizován!', 'success')->position('center');
        return response()->json(['success' => 'Dokument aktualizován!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        $filename = Document::where('id', $id)->pluck('file');

        File::delete('soubory/' . $filename[0]);
        $document->delete();

        return response()->json(['success' => __('Standard deleted successfully')]);
    }

    public function documentSearch(Request $request)
    {
        if ($request->ajax()) {

            $allDocumnets = Document::count();
            $counter = 1;
            $output = "";

            if (Auth::check()) {
                $documents = Document::with('category', 'addons')
                    ->orderBy('name')
                    ->orWhere('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('tags', 'LIKE', '%' . $request->search . '%')
                    ->get()->sortBy('category_id');
            } else {
                $documents = Document::with('category', 'addons')
                    ->orderBy('name')
                    ->orWhere('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('tags', 'LIKE', '%' . $request->search . '%')
                    ->get()->where('status', 'Schváleno')->sortBy('category_id');
            }
            $output .= '
                    <div>
                        <div class="col mt-2">
                            <div class="page-pretitle text-primary">
                                <div class="hr-text text-blue m-2 p-3">Výsledky hledání : nalezeno ' . $documents->count() . ' z ' . $allDocumnets . ' dokumentů</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                    ';

            foreach ($documents as $document) {
                if (substr($document->file, strpos($document->file, '.') + 1) == 'pdf') {
                    $ext = "pdf.png";
                    $alt = "pdf";
                } elseif (substr($document->file, strpos($document->file, '.') + 1) == "xlsx") {
                    $ext = "xlsx.png";
                    $alt = "xlsx";
                } elseif (substr($document->file, strpos($document->file, '.') + 1) == "docx") {
                    $ext = "docx.png";
                    $alt = "docx";
                } elseif (substr($document->file, strpos($document->file, '.') + 1) == "pptx") {
                    $ext = "pptx.png";
                    $alt = "pptx";
                }
                $output .=
                    '<div class="accordion-item py-1 bg-white shadow-sm">
                        <div id="test-' . $document->position . '">
                            <div class="accordion-body">
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
                                        <img src="../../img/files/' . $ext . '" height="32px" alt="' . $alt . ' soubor" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Stáhnout standard">
                                        </span>
                                    </a>
                                    </div>
                                    <div id="' . $document->id . '" class="col text-truncate show">
                                    <span>
                                        <p id="' . $document->id . '" class="strong d-inline cursor-pointer text-primary text-decoration-none" style="margin-bottom: 0;">' . $document->name . '</p>
                                    </span>

                                    <div class="d-block description text-muted text-truncate">
                                        <span class="text-' . $document->category->color . '">' . ucfirst($document->category->button . ' > ' . Str::upper($document->category->category_type)) . '</span> - ' . $document->description . '</div>
                                    </div>
                                </div>
                                </div>
                                <div class="list-group-item py-1 px-2">
                                <div class="row d-flex justify-content-between">
                                <div class="col-auto">
                                <span class="badge badge-sm bg-muted-lt description">' . $counter++ . ' z ' . $documents->count() . '</span>
                                    <span class="badge badge-sm bg-lime-lt text-uppercase ms-auto">Aktualizováno !</span>
                                    <span class="text-muted description">' . Carbon::parse($document->updated_at)->diffForHumans() . '</span>
                                    <svg class="icon text-yellow" width="24" height="24"
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
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>';
            }

            return Response($output);
        }
    }
}
