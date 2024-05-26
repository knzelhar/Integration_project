<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class option_paiement extends Model
{
    use HasFactory;


    protected $fillable = [
        'designation',
        'method_pay',
        'remise'
    ];


    public function offreOptions()
    {
        return $this->belongsToMany(offre::class, 'offre_option_activites','offre_id');
    }

    public function activiteOptions()
    {
        return $this->belongsToMany(activite::class, 'offre_option_activites', 'activite_id');
    }

    public function enfants()
    {
        return $this->belongsToMany(enfant::class, 'enfant_paiements');
    }
}
