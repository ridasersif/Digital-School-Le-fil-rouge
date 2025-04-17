<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    /** @use HasFactory<\Database\Factories\EtudiantFactory> */
    use HasFactory;
    protected $fillable = [
        'cours_id',
        'etudiant_id',
        'status',
    ];
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
