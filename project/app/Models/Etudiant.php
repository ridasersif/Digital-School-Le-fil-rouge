<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    /** @use HasFactory<\Database\Factories\EtudiantFactory> */
    use HasFactory;
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cours()
    {
        return $this->belongsToMany(Cours::class, 'inscriptions', 'etudiant_id', 'cours_id')->withTimestamps();
    }

    public function panier()
    {
        return $this->belongsToMany(Cours::class, 'panier')->withTimestamps();
    }
   

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

}
