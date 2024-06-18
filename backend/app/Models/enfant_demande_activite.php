<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enfant_demande_activite extends Model
{
    use HasFactory;
    protected $table = 'enfant_demande_activites';

    protected $fillable = [
        'enfant_id',
        'demande_id',
        'activite_id',
    ];

    public function enfants()
    {
        return $this->hasMany(enfant::class, 'enfant_demande_activites', 'enfant_id');
    }

    public function activites()
    {
        return $this->hasMany(activite::class, 'enfant_demande_activites', 'activite_id');
    }

    public function demandes()
    {
        return $this->hasMany(demande::class, 'enfant_demande_activites', 'demande_id');
    }
}
