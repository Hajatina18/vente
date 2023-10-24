<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    use HasFactory;
    protected $primaryKey = "id_magasin";
    protected $fillable = [
        'nom_magasin',
        'logo',
        'nif',
        'stat',
        'rcs',
        'adresse_magasin',
        'description_magasin',
        'telephone',
        'email'
    ];
}
