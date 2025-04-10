<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    /** @use HasFactory<\Database\Factories\CoursFactory> */
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'image', 'video_intro',
        'status', 'formateur_id', 'category_id', 'price'
    ];

    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
