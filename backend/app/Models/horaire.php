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
        return $this->belongsToMany(enfant::class, 'dispo_horaire_enfants');
    }

    public function animateur_users()
    {
        return $this->belongsToMany(animateur_user::class, 'dispo_horaire_animateurs', 'animateur_id', 'horaire_id');
    }

    public function activites()
    {
        return $this->belongsToMany(activite::class, 'dispo_horaire_activites', 'horaire_id', 'activite_id');
    }
}
