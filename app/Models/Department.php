<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_code',
        'center_code',
        'department_name'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(Employee::class);
    }

    public function adversevent()
    {
        return $this->belongsTo(Adversevent::class);
    }
}
