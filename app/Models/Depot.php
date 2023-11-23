<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;
    protected $primaryKey = "id_depot";
    protected $fillable = [
        "nom_depot", "localisation", "is_default"
    ];
}
