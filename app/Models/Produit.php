<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $primaryKey = "ref_prod";
    public $incrementing = false;
    protected $fillable = [
        'nom_prod', 'qte_stock', 'image_prod', "fait_demande"
    ];

    public function prepaniers()
    {
        return $this->hasOne(PrePaniers::class, "ref_prod", "ref_prod");
    }
}
