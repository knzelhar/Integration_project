<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dispo_horaire_activite extends Model
{
    use HasFactory;
    protected $table = 'dispo_horaire_activites';

    protected $fillable = [
        'activite_id',
        'horaire_id',
    ];

    public function horairedispo()
    {
        return $this->hasMany(horaire::class, 'dispo_horaire_activites', 'horaire_id');
    }

    public function activitedispo()
    {
        return $this->hasMany(activite::class, 'dispo_horaire_activites', 'activite_id');
    }

}
