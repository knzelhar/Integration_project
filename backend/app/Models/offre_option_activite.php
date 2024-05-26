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
        'nbr_sceances_sem',
        'duree'
    ];

    public function offre() {
        return $this->belongsTo(Offre::class);
    }

    public function activite() {
        return $this->belongsTo(Activite::class);
    }

    public function optionPaiement() {
        return $this->belongsTo(OptionPaiement::class);
    }
}
