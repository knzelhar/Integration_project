<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offre_option_activite extends Model
{
    use HasFactory;
    protected $table = 'offre_option_activites';

    protected $fillable = [
        'offre_id',
        'option_pay_id',
        'activite_id',
        'demande_id',
        'tarif',
        'nbr_sceances_sem',
        'duree'
    ];

    public function offre() {
        return $this->belongsTo(offre::class, 'offre_id');
    }

    public function activite() {
        return $this->belongsTo(activite::class, 'activite_id');
    }

    public function demande() {
        return $this->belongsTo(demande::class, 'demande_id');
    }

    public function optionPaiement() {
        return $this->belongsTo(option_paiement::class, 'option_pay_id');
    }
}
