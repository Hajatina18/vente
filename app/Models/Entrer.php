<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entrer extends Model
{
    use HasFactory;
    protected $primaryKey = "id_entrer";
    protected $fillable = [
        "id_frns", "date_facture", "num_facture", "num_bl", "date_echeance", "prix_achat_ht", "prix_achat_ttc", "cout_trans", "date_echeance", "cout_revient"
    ];

    public function entrer_produits(): BelongsTo{
        return $this->belongsTo(EntrerProduit::class);
    }
}
