<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offre extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'date_creation',
        'date_mise_a_jour',
        'date_debut_insc',
        'date_fin_insc',
        'description',
        'message_pub',
        'remise',
        'volume_horaire'
    ];


    public function activiteOffres()
    {
        return $this->belongsToMany(activite::class, 'offre_option_activites', 'activite_id', 'offre_id');
    }

    public function optionOffre()
    {
        return $this->belongsToMany(option_paiement::class, 'offre_option_activites', 'offre_id', 'option_pay_id');
    }
    public function demandeOffres()
    {
        return $this->belongsToMany(demande::class, 'offre_option_activites', 'offre_id', 'demande_id');
    }

    public function enfants()
    {
        return $this->belongsToMany(enfant::class, 'offre_enfants');
    }
}
