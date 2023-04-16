<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
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
        $jobs = Job::all();
        $columns = Schema::getColumnListing('employees');

        if ($request->ajax()) {

            if (Auth::user()) {
                $model = Employee::with('department', 'job')->where('personal_number', '!=', null)->select('*', 'employees.id');
            } else {
                $model = Employee::with('department', 'job')->select('*', 'employees.id')->where('personal_number', '!=', null)->where('status', 'Aktivní');
            }
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
                                    <svg class="icon dropdown-item-icon-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                    Upravit zaměstnance
                                </li>
                                <li class="dropdown-item remove" name="remove" id="' . $data->id . '">
                                    <svg class="icon dropdown-item-icon-remove" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M15 8h.01"></path>
                                        <path d="M13 20h-6a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6"></path>
                                        <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l2.5 2.5"></path>
                                        <path d="M21.5 21.5l-5 -5"></path>
                                        <path d="M16.5 21.5l5 -5"></path>
                                    </svg>
                                    Odstranit fotografii
                                </li>
                                <li class="dropdown-item delete" name="delete" id="' . $data->id . '">
                                    <svg class="icon dropdown-item-icon-delete" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                    }
                })

                ->toJson();
        }

        return view('employees.index')->with([
            'categories'    =>  $categories,
            'title'         => 'Zaměstnanci',
            'departments'   => $departments,
            'jobs'          => $jobs,
            'columns'       => $columns
        ]);
    }

    /**
     * Export collection to *.xlsx file.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPhoneList()
    {
        $sheets = new SheetCollection([
            'Ředitelství'                       => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 17)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Provozní úsek'                     => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 24)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Údržba'                            => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 25)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Interní oddělení'                  => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 1)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Interní odborné ambulance'         => Employee::with('department', 'job')->where('status', 'Aktivní')->whereIn('department_id', [2, 3, 4, 5, 21, 26])->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Neurologické oddělení'             => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 6)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Neurologická ambulance'            => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 7)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Odělení chirurgie páteře'          => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 8)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'JIP'                               => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 9)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Ambulance chirurgie páteře'        => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 10)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Ortopedické oddělení'              => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 28)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Rehabilitační oddělení'            => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 11)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Rehabilitační oddělení'            => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 11)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Rehabilitační ambulance'           => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 12)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Oddělení pracovního lékařství'     => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 13)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'OKB'                               => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 14)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'RDG'                               => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 15)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Operační sály'                     => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 16)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Stravovací provoz - kantýna'       => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 18)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Úklid'                             => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 19)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Anesteziologická ambulance'        => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 20)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Lékárny KHN'                       => Employee::with('department', 'job')->where('status', 'Aktivní')->whereIn('department_id', [22, 29])->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Mezioborová JIP'                   => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 23)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
            'Oddělení následné péče'            => Employee::with('department', 'job')->where('status', 'Aktivní')->where('department_id', 30)->where('phone', '<>', '')->orderBy('position', 'ASC')->get(),
        ]);

        // $employees = Employee::with('department', 'job')->where('status', 'Aktivní')->where('phone', '<>', '')->orderBy('position', 'ASC')->get();
        return (new FastExcel($sheets))->download('Telefonní_seznam_KHN_ke_dni_' . date('d.m.Y', strtotime(now())) . '.xlsx', function ($employee) {
            return [
                '#'                 =>  $employee->position,
                'Jméno'             =>  $employee->last_name . ' ' . $employee->first_name . ' ' . $employee->title_preffix,
                'Funkce'            =>  $employee->job->job_title,
                'Klapka'            =>  $employee->phone,
                'Mobil'             =>  $employee->mobile,
            ];
        });
    }

    /**
     * Export collection to complete list xlsx file.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportList()
    {
        $employees = Employee::with('department', 'job', 'user')->orderBy('last_name', 'ASC')->get();
        return (new FastExcel($employees))->download('zamestanci_khn_seznam' . date('d.m.Y', strtotime(now())) . '.xlsx', function ($employee) {
            return [
                'Osobní číslo'      =>  $employee->personal_number,
                'Tituly před'       =>  $employee->title_preffix,
                'Příjmení'          =>  $employee->last_name,
                'Jméno'             =>  $employee->first_name,
                'Tituly za'         =>  $employee->title_suffix,
                'Oddělení'          =>  $employee->department->department_name,
                'Funkce'            =>  $employee->job->job_title,
                'E-mail'            =>  $employee->email,
                'Nástup'            =>  date('d. m. Y', strtotime($employee->start_date)),
                'Klapka'            =>  $employee->phone,
                'Mobil'             =>  $employee->mobile,
                'Poměr'             =>  $employee->employment,
                'Vytvořeno'         =>  date('d. m. Y', strtotime($employee->created_at)),
                'Upraveno'          =>  date('d. m. Y', strtotime($employee->updated_at))
            ];
        });
    }

    /**
     * Export collection to xlsx or csv file.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportTable(Request $request)
    {
        $columns = $request->input('column');
        $sort = $request->input('sort');
        $direction = $request->input('direction');
        $format = $request->input('format');
        $employees = Employee::orderBy($sort, $direction)->get($columns);
        return (new FastExcel($employees))->download('zamestanci_khn_' . date('d.m.Y', strtotime(now())) . '.' . $format);
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
            'personal_number'   =>  'required|unique:employees|min:5|max:5',
            'title_preffix',
            'last_name'         =>  'required',
            'first_name'        =>  'required',
            'middle_name',
            'married_name',
            'title_suffix',
            'department_id'     =>  'required',
            'job_id'            =>  'required',
            'email',
            'start_date'        =>  'required',
            'end_date',
            'comment',
            'phone',
            'mobile',
            'id_card'           => 'nullable',
            'coffee',
            'status',
            'position',
            'employment'        =>  'required',
            'image'             =>  'image|max:4096'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('image');

        if (empty($image)) {
            $image_name = 'no_image.png';
        } else {
            $current = Carbon::now()->format('Ymd-His');
            $guessExtension = $image->guessExtension();
            $image_name = $request->personal_number . '_' . $current . '.' . $guessExtension;
            $image->move(public_path('foto'), $image_name);
        }

        $form_data = [
            'personal_number'   =>  $request->personal_number,
            'title_preffix'     =>  $request->title_preffix,
            'last_name'         =>  $request->last_name,
            'first_name'        =>  $request->first_name,
            'middle_name'       =>  $request->middle_name,
            'married_name'      =>  $request->married_name,
            'title_suffix'      =>  $request->title_suffix,
            'department_id'     =>  $request->department_id,
            'job_id'            =>  $request->job_id,
            'email'             =>  $request->email,
            'start_date'        =>  $request->start_date,
            'end_date'          =>  $request->end_date,
            'comment'           =>  $request->comment,
            'phone'             =>  $request->phone,
            'mobile'            =>  $request->mobile,
            'id_card'           =>  $request->id_card,
            'coffee'            =>  $request->coffee,
            'status'            =>  $request->status,
            'employment'        =>  $request->employment,
            'image'             =>  $image_name
        ];

        Employee::create($form_data);

        return response()->json(['success' => 'Zaměstnanec uložen do databáze']);
    }

    /**
     * Display vcards of employees.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function vcards()
    {
        $employees = Employee::with('department', 'job')->orderBy('last_name', 'ASC')->paginate(28);
        return view('vcards')->with(['employees'   => $employees]);
    }

    public function vcardSearch(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $employees = Employee::join('departments', 'department_id', '=', 'departments.id')
                ->join('jobs', 'job_id', '=', 'jobs.id')->orderBy('last_name')
                ->where('personal_number', 'LIKE', '%' . $request->search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('first_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('department_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('job_title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('title_preffix', 'LIKE', '%' . $request->search . '%')
                ->orWhere('title_suffix', 'LIKE', '%' . $request->search . '%')
                ->get()->where('status', 'Aktivní');
            if ($employees->isNotEmpty()) {
                $output .=
                    '<div>
                        <div class="col mt-2">
                            <div class="page-pretitle text-primary">
                                <div class="hr-text text-blue m-2 p-3">Výsledky hledání : nalezeno ' . $employees->count() . ' z ' . Employee::whereStatus('aktivní')->count() . ' zaměstnanců</div>
                            </div>
                        </div>
                    </div>
                <div class="row">';

                foreach ($employees as $employee) {
                    $output .=
                        '<div class="col-12 col-md-3">
                        <div class="card card-sm mt-2 mb-2 shadow-sm">
                                <div class="card-body bg-' . $employee->department->color_id . '-lt">
                                <div class="row align-items-top">
                                    <div class="col-auto">
                                    <img class="avatar text-white mb-1" src="/foto/' .  $employee->image . '" alt="' .  $employee->personal_number . '" style="width: 42px; height:55px"><br>
                                    <span class="px-2 text-' .  $employee->department->color_id . '"><strong>' .  $employee->personal_number . '</strong></span>
                                    </div>
                                    <div class="col">
                                        <h2 class="font-weight-medium text-muted mb-0">' .  $employee->title_preffix . ' ' . $employee->last_name . ' ' . $employee->first_name . ' ' . $employee->title_suffix . '</h2>
                                    <div class="text-' .  $employee->department->color_id . '">' .  $employee->job->job_title . '</div>
                                    <div class="text-' .  $employee->department->color_id . '">
                                        ' .  $employee->department->department_name . '
                                        </div>
                                    <div class="hr-text text-muted my-2" >
                                        <span style="font-size: 0.7rem">' .  __("kontaktní informace")  . '</span>
                                     </div>
                                    <div class="text-muted">
                                        <div>Klapka: <span class="text-blue">' . ($employee->phone ?? '') . '</div>
                                        <div>Mobil: <span class="text-blue">' .  ($employee->mobile  ?? '') . '</div>
                                        <div>Email: <span class="text-blue"><a href="mailto:' . ($employee->email ?? '') . '">' . ($employee->email ?? '') . '</a></div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        ';
                }
                return Response($output);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Employee::with('department')->findOrFail($id);
        if (request()->ajax()) {
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if ($image != '') {
            $rules = [
                'personal_number'   =>
                'required|min:5|max:5|unique:employees,id',
                'title_preffix',
                'last_name'         =>  'required',
                'first_name'        =>  'required',
                'middle_name',
                'married_name',
                'title_suffix',
                'department_id'     =>  'required',
                'job_id'            =>  'required',
                'email',
                'start_date'        =>  'required',
                'end_date',
                'comment',
                'phone',
                'mobile',
                'id_card'           =>  'nullable',
                'coffee',
                'status',
                'employment'        =>  'required',
                'image'             =>  'image|max:4096'
            ];

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $current = Carbon::now()->format('d-m-Y');
            $guessExtension = $image->guessExtension();
            $image_name = $request->personal_number . '_' . $current . '.' . $guessExtension;
            $image->move(public_path('foto'), $image_name);
        } else {
            $rules = [
                'personal_number'   =>  'required',
                'title_preffix',
                'last_name'         =>  'required',
                'first_name'        =>  'required',
                'middle_name',
                'married_name',
                'title_suffix',
                'department_id'     =>  'required',
                'job_id'            =>  'required',
                'email',
                'start_date',
                'end_date',
                'comment',
                'phone',
                'mobile',
                'id_card',
                'coffee',
                'status',
                'position',
                'employment'        =>  'required',
                'image',
            ];

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = [
            'personal_number'   =>  $request->personal_number,
            'title_preffix'     =>  $request->title_preffix,
            'last_name'         =>  $request->last_name,
            'first_name'        =>  $request->first_name,
            'middle_name'       =>  $request->middle_name,
            'married_name'      =>  $request->married_name,
            'title_suffix'      =>  $request->title_suffix,
            'department_id'     =>  $request->department_id,
            'job_id'            =>  $request->job_id,
            'email'             =>  $request->email,
            'start_date'        =>  $request->start_date,
            'end_date'          =>  $request->end_date,
            'comment'           =>  $request->comment,
            'phone'             =>  $request->phone,
            'mobile'            =>  $request->mobile,
            'id_card'           =>  $request->id_card,
            'coffee'            =>  $request->coffee,
            'status'            =>  $request->status,
            'status'            =>  $request->status,
            'position'          =>  $request->position,
            'image'             =>  $image_name
        ];

        Employee::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Zaměstnanec aktualizován']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Employee::find($id);
        $file = $user->image;
        if ($file == 'no_image.png') {
            $user->delete();
            return response()->json(['success' => __('User deleted successfully')]);
        } else {
            $filename = public_path() . '/foto/' . $file;
            File::delete($filename);
            $user->delete();
            return response()->json(['success' => __('User and photo deleted successfully ')]);
        }
    }

    /**
     * Remove photo
     */
    public function destroyPhoto($id)
    {
        $user = Employee::find($id);
        $file = $user->image;
        if ($file == 'no_image.png') {
            return response()->json(['success' => __('The default photo has been set')]);
        } else {
            $filename = public_path() . '/foto/' . $file;
            File::delete($filename);
            $user->image = 'no_image.png';
            $user->save();
            return response()->json(['success' => __('Photo deleted successfully')]);
        }
    }
}
