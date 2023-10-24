<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrePaniers extends Model
{
    use HasFactory;
    protected $primaryKey = "id_pre_panier";
    protected $fillable = [
        'id_pre_commande', 'ref_prod', "id_unite",'prix_produit', 'qte_commande'
    ];

    public function produit()
    {
        return $this->hasOne(Produit::class, "ref_prod", "ref_prod");
    }

    public function unite()
    {
        return $this->hasOne(UniteMesure::class, "id_unite", "id_unite");
    }
}
