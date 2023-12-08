<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModePaiement;
use App\Models\PreCommande;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;

class CommandecomController extends Controller
{
    public function index()
    {
        // Votre logique de contrôleur ici
        
        return view("commandecom");
    } 
    public function produit($id = null){
        $modes = ModePaiement::all();
        $precommande = PreCommande::withSum(['paniers' => fn ($query) => $query->select(DB::raw("sum(prix_produit*qte_commande)"))], '')->where("id_pre_commande", $id)->first();
        return view("pages.commande",array("precommande" => $precommande,'modes' => $modes, "parametres" => $id));
    }
}

