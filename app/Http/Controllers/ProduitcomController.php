<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProduitcomController;
use App\Models\UniteMesure;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Http\Controllers\Controller;
use App\Models\Avoir;
use App\Models\Stock;
use DateTime;
use Illuminate\Support\Facades\DB;

class ProduitcomController extends Controller
{
    public function index()
    {
        // la page d'accueil des utilisateurs commerciaux
        
        return view("produitcom");
    } 
    
}
