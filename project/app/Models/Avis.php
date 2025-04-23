<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = ['etudiant_id', 'cours_id', 'note', 'commentaire'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
}
