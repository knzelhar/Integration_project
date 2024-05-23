<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class parent_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'fonction',
        'user_id',
    ];

    public function users()
    {
<<<<<<< HEAD
        return $this->belongsTo(User::class,'user_id');
=======
        return $this->belongsTo(User::class);
>>>>>>> f8a28ad6 (ajout de OffreController)
    }

    public function enfants()
    {
        return $this->hasMany(enfant::class);
    }

    public function demandes()
    {
        return $this->hasMany(demande::class);
    }
}
