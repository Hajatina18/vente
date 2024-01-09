<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChiffreAffaireController extends Controller
{
    public function index(Request $request){

        // $productFluctuation =  Produit::find($request->produitId);

        // $Client = Client::all();
        // foreach($Client as $clients){
        //     $commande = Commande::where('id_client', $clients->id_client)->get();
        //     foreach ($commande as $commande) {
        //         $total = DB::table('paniers')
        //                     ->where('id_commande', $commande->id_commande)
        //                     ->select(DB::raw('SUM(qte_commande * prix_produit) as total'))
        //                     ->first();
        //         $commande->date = date('d/m/Y H:i:s', strtotime($commande->created_at));
        //         $commande->total = number_format($total->total, 2, ',', ' ').' Ar';
        //     }

        // }
        return view('admin.chiffre_affaire', );

    }
}
