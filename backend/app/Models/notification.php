<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'date',
        'contenu',
        'statut',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
