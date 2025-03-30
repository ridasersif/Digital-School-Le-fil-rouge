<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'avatar', 'bio', 'address','phone','birthdate','website','occupation','facebook_profile'];
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
