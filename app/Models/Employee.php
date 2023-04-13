<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'personal_number',
        'image',
        'title_preffix',
        'last_name',
        'first_name',
        'middle_name',
        'married_name',
        'title_suffix',
        'department_id',
        'job_id',
        'email',
        'start_date',
        'end_date',
        'comment',
        'phone',
        'mobile',
        'id_card',
        'coffee',
        'employment',
        'position',
        'status'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'personal_number');
    }

    protected function serializeDate($dates)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $dates)->format('Y-m-d');
    }
}
