<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
        'type_route',
        'type_color',
        'svg_icon',
      ];

    public $timestamps = false;

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }
}
