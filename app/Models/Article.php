<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Autorise ces champs à être remplis via le formulaire
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'is_headline',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}