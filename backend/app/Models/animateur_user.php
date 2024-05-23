<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class animateur_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'domaine_comp',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function horaires()
    {
        return $this->belongsToMany(horaire::class, 'dipo_horaire_animateurs');
    }

    public function activites()
    {
        return $this->hasMany(activite::class);
    }
}
