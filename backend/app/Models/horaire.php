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
        return $this->morphedByMany(enfant::class, 'dispo_horaire');
    }

    public function activites()
    {
        return $this->morphedByMany(activite::class, 'dispo_horaire');
    }

    public function animateur_users()
    {
        return $this->morphedByMany(animateur_user::class, 'dispo_horaire');
    }
}
