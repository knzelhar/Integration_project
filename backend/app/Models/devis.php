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
        'facture_id'

    ];

    public function demande()
    {
        return $this->belongsTo(demande::class, 'demande_id');
    }

    public function facture()
    {
        return $this->belongsTo(Facture::class, 'facture_id');
    }


}
