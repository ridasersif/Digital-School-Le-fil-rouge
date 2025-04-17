<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\EtudiantFactory> */
    use HasFactory;
    protected $fillable = [
        'inscription_id',
        'payment_method',
        'status',
        'transaction_id',
    ];
    public function inscription()
    {
        return $this->belongsTo(Inscription::class);
    }

  
}
