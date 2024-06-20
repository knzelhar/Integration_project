<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activite extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'objectif',
        'image_pub',
        'lien_youtube',
        'descriptif',
        'age_min',
        'age_max',
        'eff_min',
        'eff_max',
        'prix',
        'animateur_id',
        'admin_id',
        'type_id'
    ];

    public function animateur_users()
    {
        return $this->belongsTo(animateur_user::class, 'animateur_id');
    }

    public function admin_users()
    {
        return $this->belongsTo(admin_user::class, 'admin_id');
    }

    public function type_activites()
    {
        return $this->belongsTo(type_activite::class, 'type_id');
    }

    public function horaires()
    {
        return $this->belongsToMany(horaire::class, 'dispo_horaire_activites', 'horaire_id', 'activite_id');
    }

    public function enfants()
    {
        return $this->belongsToMany(enfant::class, 'plannings');
    }

    public function enfantActivites()
    {
        return $this->belongsToMany(enfant::class, 'enfant_demande_activites', 'enfant_id', 'activite_id');
    }

    public function demandeActvites()
    {
        return $this->belongsToMany(demande::class, 'enfant_demande_activites', 'demande_id', 'activite_id');
    }

    public function offreAcitvites()
    {
        return $this->belongsToMany(offre::class, 'offre_option_activites', 'activite_id', 'offre_id');
    }

    public function optionActivites()
    {
        return $this->belongsToMany(option_paiement::class, 'offre_option_activites', 'activite_id', 'option_pay_id');
    }

    public function demandeOffreActivites()
    {
        return $this->belongsToMany(demande::class, 'offre_option_activites', 'demande_id', 'activite_id');
    }
}
