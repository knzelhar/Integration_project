<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_activite extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
    ];


    public function activites()
    {
        return $this->hasMany(activite::class);
    }
}
