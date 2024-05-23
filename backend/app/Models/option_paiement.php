<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class option_paiement extends Model
{
    use HasFactory;


    protected $fillable = [
        'designation',
        'remise'
    ];


    public function offreOptions()
    {
        return $this->belongsToMany(offre::class, 'offre_option_activites');
    }

    public function activiteOptions()
    {
        return $this->belongsToMany(activite::class, 'offre_option_activites');
    }
}
