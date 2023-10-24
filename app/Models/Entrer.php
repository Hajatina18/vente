<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrer extends Model
{
    use HasFactory;
    protected $primaryKey = "id_entrer";
    protected $fillable = [
        "id_frns", "date_facture", "num_facture", "num_bl", "date_echeance"
    ];
}
