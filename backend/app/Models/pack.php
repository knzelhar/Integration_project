<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
<<<<<<< HEAD
        'remise',
        'nbr_enfant',
        'nbr_abtelier'
=======
        'remise'
>>>>>>> f8a28ad6 (ajout de OffreController)
    ];


    public function demandes()
    {
        return $this->hasMany(demande::class);
    }
}
