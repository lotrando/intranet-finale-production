<?php

namespace App\Models;

use App\Models\Addon;
use App\Models\Document;
use App\Models\Navitem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function navitems()
    {
        return $this->hasMany(Navitem::class);
    }

    public function addon()
    {
        return $this->hasMany(Addon::class);
    }
}
