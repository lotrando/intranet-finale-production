<?php

namespace App\Models;

use App\Models\Addon;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Document extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function addons()
    {
        return $this->hasMany(Addon::class)->where('status', 'Schváleno')->orderBy('position');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
