<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use App\Models\Produit;
use DateTime;

class TransfertController extends Controller
{
    public function index()
    {
        $frns = Fournisseur::all();
        $produits = Produit::where('fait_demande', true)->get();
        return view('admin.transfert', ['produits' => $produits, 'fournisseurs' => $frns]);
    }

    
}