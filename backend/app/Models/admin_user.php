<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class admin_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function activites()
    {
        return $this->hasMany(activite::class);
    }

    public function demandes()
    {
        return $this->hasMany(demande::class);
    }
}
