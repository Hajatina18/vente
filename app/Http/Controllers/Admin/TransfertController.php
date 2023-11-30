<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depot;
use App\Models\PointVente;
use App\Models\Produit;

use DateTime;

class TransfertController extends Controller
{
    public function index()
    {
       
        $produits = Produit::all();
        $depots = Depot::all();
        $pointVente = PointVente::all();
        return view('admin.transfert', ['produits' => $produits, 'depots' => $depots, 'pointVente'=> $pointVente]);
    }

    
}