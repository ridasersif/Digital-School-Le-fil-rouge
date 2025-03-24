<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable = ['nom', 'created_by','icon','description'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
