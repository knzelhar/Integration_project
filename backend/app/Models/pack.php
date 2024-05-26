<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'remise',
        'nbr_enfant',
        'nbr_abtelier'
    ];


    public function demandes()
    {
        return $this->hasMany(demande::class);
    }
}
