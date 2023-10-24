<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PreCommande extends Model
{
    use HasFactory;
    protected $primaryKey = "id_pre_commande";
    protected $fillable = [
        "date_pre_commande",
        "id_user"
    ];

    public function paniers()
    {
        return $this->hasMany(PrePaniers::class, "id_pre_commande", "id_pre_commande");
    }

    public function sums()
    {
        return PrePaniers::join("avoirs", function($query){
            $query->on("avoirs.ref_prod", '=', "pre_paniers.ref_prod")->on("avoirs.id_unite", '=', "pre_paniers.id_unite");
        })->where("id_pre_commande", $this->id_pre_commande)->sum(DB::raw("pre_paniers.prix_produit * pre_paniers.qte_commande"));
    }
}
