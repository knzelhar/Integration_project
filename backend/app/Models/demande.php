<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_dem',
        'statut_dem',
        'statut_admin',
        'motif_refus_parent',
        'date_traitement',
        'motif_refus_admin',
        'parent_id',
        'pack_id',
        'admin_id',
        'devis_id'

    ];

    public function activiteDemandes()
    {
        return $this->belongsToMany(activite::class, 'enfant_demande_activites');
    }

    public function enfantDemandes()
    {
        return $this->belongsToMany(enfant::class, 'enfant_demande_activites');
    }

    public function admin_users()
    {
        return $this->belongsTo(admin_user::class);
    }

    public function packs()
    {
        return $this->belongsTo(pack::class,'pack_id');
    }

    public function parent_users()
    {
        return $this->belongsTo(parent_user::class,'parent_id');
    }
    public function devis()
    {
        return $this->belongsTo(Devis::class, 'devis_id');
    }



    public function factures()
    {
        return $this->hasOneThrough(facture::class, devis::class);
    }
}
