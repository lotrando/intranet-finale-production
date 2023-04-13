<?php

namespace App\Models;

use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Paint extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'user_id',
        'date_start',
        'date_end',
        'rooms',
        'specials',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
