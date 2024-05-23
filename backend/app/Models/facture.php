<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facture extends Model
{
    use HasFactory;


    protected $fillable = [
        'date',
<<<<<<< HEAD
        'statut_paiment',
=======
>>>>>>> f8a28ad6 (ajout de OffreController)
        'total_ht',
        'total_ttc',
        'facture_pdf'

    ];

    public function devis()
    {
        return $this->belongsTo(devis::class);
    }
}
