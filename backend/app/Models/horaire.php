<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class horaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'jour_par_semaine',
        'debut',
        'fin',
    ];

    public function enfants()
    {
        return $this->belongsToMany(enfant::class, 'dipo_horaire_enfants');
    }

    public function animateur_users()
    {
        return $this->belongsToMany(animateur_user::class, 'dipo_horaire_animateurs');
    }

    public function activites()
    {
        return $this->belongsToMany(activite::class, 'dipo_horaire_activites');
    }
}
