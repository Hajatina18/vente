<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPointVente extends Model
{
    use HasFactory;
    protected $primaryKey = "id_stock_pdv";
    protected $fillable = [
        "week", "ref_prod", "stock", "id_pdv"
    ];
}
