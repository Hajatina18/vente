<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EntrerProduit extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_entrer', 'ref_prod', 'id_unite', 'qte_entrer'
    ];

    public function produits_entrer(): HasOne{
        return $this->hasOne(Entrer::class);
    } 
}
