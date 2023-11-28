<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avoir;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\UniteMesure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CommController extends Controller
{
    public function index()
    {
        // Logique pour la page d'accueil des utilisateurs commerciaux
        return view("admin.produitcom");
    }

    // public function orders()
    // {
    //     // Logique pour afficher les commandes des utilisateurs commerciaux
    //     return view('commercial.orders');
    // }

    // Ajoutez d'autres méthodes en fonction des fonctionnalités spécifiques aux utilisateurs commerciaux
}
