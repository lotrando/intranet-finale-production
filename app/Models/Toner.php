<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toner extends Model
{
    use HasFactory;

    protected $fillable = [
        'toner_code',
        'toner_name',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function printer()
    {
        return $this->belongsTo(Printer::class, 'printer_id');
    }
}
