<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrerProduit extends Model
{
    use HasFactory;
    protected $primaryKey = "id_entre";
    protected $fillable = [
        'id_entrer', 'ref_prod', 'id_unite', 'qte_entrer'
    ];
}
