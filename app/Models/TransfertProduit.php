<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransfertProduit extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'is_transfert', 'ref_prod', 'id_unite', 'qte_transfert'
    ];
}

