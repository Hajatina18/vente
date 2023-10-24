<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $primaryKey = "id_frns";
    protected $fillable = [
        "nom_frns"
    ];
}
