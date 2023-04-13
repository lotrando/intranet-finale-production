<?php

namespace App\Models;

use App\Models\Training;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'personal_number',
        'last_name',
        'first_name',
        'start_time',
        'end_time'
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }
}
