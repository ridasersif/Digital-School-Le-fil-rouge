<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /** @use HasFactory<\Database\Factories\ContentFactory> */
    use HasFactory;

    protected $fillable = ['titre', 'description', 'type', 'chemin', 'cours_id'];

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
}
