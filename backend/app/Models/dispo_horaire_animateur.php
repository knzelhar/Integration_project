<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dispo_horaire_animateur extends Model
{
    use HasFactory;
    protected $table = 'dispo_horaire_animateurs';

    protected $fillable = [
        'horaire_id',
        'animateur_id',
    ];

    public function horairedisponibilite()
    {
        return $this->hasMany(horaire::class, 'dispo_horaire_animateurs', 'horaire_id');
    }

    public function animateurdisponibilite()
    {
        return $this->hasMany(animateur_user::class, 'dispo_horaire_animateurs', 'animateur_id');
    }
}
