<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facture extends Model
{
    use HasFactory;


    protected $fillable = [
        'date',
        'statut_paiment',
        'total_ht',
        'total_ttc',
        'facture_pdf'

    ];

    public function devis()
    {
        return $this->belongsTo(devis::class);
    }
}
