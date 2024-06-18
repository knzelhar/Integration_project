<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupe extends Model
{
    use HasFactory;


    protected $fillable = [
        'activite_id',
        'horaire_id',
        'enfant_id'

    ];
}
