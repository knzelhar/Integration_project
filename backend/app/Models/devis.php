<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devis extends Model
{
    use HasFactory;


    protected $fillable = [
        'date',
        'total_ht',
        'total_ttc',
        'devis_pdf',
<<<<<<< HEAD
        'facture_id',
    ];



    public function demande()
    {
        return $this->hasOne(Demande::class, 'devis_id');
    }





    public function facture()
    {
        return $this->belongsTo(Facture::class, 'facture_id');
    }


=======
        'facture_id'

    ];

    public function demandes()
    {
        return $this->belongsTo(demande::class);
    }

    public function factures()
    {
        return $this->hasOne(facture::class);
    }
>>>>>>> f8a28ad6 (ajout de OffreController)
}
