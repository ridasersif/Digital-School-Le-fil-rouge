<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    /** @use HasFactory<\Database\Factories\CoursFactory> */
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'image',
        'video_intro',
        'status',
        'formateur_id',
        'category_id',
        'price',
        'old_price'
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
        return $this->hasMany(Content::class)->latest();
    }
    public function paniers()
    {
        return $this->belongsToMany(Etudiant::class, 'panier')->withTimestamps();
    }
    public function inscriptions()
    {
        return $this->belongsToMany(Etudiant::class, 'inscriptions', 'cours_id', 'etudiant_id')
                    ->withPivot('status')
                    ->withTimestamps();
    }
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }
    public function certificats()
    {
        return $this->hasMany(Certificat::class);
    }

}
