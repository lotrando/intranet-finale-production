<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'slide_title',
        'directory',
        'path',
        'position'
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }
}
