<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Document;
use App\Models\Category;


class Addon extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'category_id',
        'position',
        'description',
        'revision',
        'file',
        'onscreen',
        'user_id',



    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
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
