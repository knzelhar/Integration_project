<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enfant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'date_naiss',
        'niveau_etu',
        'parent_id',
    ];
    public function parent_users()
    {
        return $this->belongsTo(parent_user::class);
    }

    public function horaires()
    {
        return $this->morphToMany(horaire::class, 'dispo_horaire');
    }


    public function activites()
    {
        return $this->belongsToMany(activite::class, 'plannings');
    }

    public function activiteEnfants()
    {
        return $this->belongsToMany(activite::class, 'enfant_demande_activites');
    }

    public function demandeEnfants()
    {
        return $this->belongsToMany(demande::class, 'enfant_demande_activites');
    }


    public function offres()
    {
        return $this->belongsToMany(offre::class, 'offre_enfants');
    }
}
