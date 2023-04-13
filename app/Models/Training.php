<?php

namespace App\Models;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category'
    ];

    public function slide()
    {
        return $this->hasMany(Slide::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
