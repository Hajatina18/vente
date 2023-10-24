<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avoir extends Model
{
    use HasFactory;
    protected $primaryKey = "id_avoir";
    protected $fillable = [
        'id_unite', 'ref_prod', 'prix', 'qte_unite'
    ];
    public function unite() {
        return $this->belongsTo(UniteMesure::class);
    }
}
