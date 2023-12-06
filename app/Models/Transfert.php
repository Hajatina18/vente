<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfert extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_transfert';
    protected $fillable = [
        'bon_de_transfert', 'date_transfert', 'id_demandeur', 'id_approvisionneur'
    ];
}
