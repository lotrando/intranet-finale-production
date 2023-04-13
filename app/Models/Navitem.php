<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Navitem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
