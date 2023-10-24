<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;
    protected $primaryKey = "id_panier";
    protected $fillable = [
        'id_commande', 'ref_prod', "id_unite",'prix_produit', 'qte_commande'
    ];
}
