<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grp_enf extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_grp',
        'id_enfant',
    ];

    
}
