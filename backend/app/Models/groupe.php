<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupe extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_activite',
        'id_horaire'

    ];
}
