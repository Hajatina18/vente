<?php

namespace App\Http\Controllers;

use App\Models\Avoir;
use App\Models\Client;
use App\Models\Commande;
use App\Models\ModePaiement;
use App\Models\Panier;
use App\Models\PreCommande;
use App\Models\PrePaniers;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PreCommandeController extends Controller
{
    public function index(Request $request)
    {
        $user= auth()->user();

        setlocale(LC_ALL, 'fr_FR.utf8', 'FRA');
        $Precomm = PreCommande::with("paniers");
        $precommandes =$user->is_admin===1 ? $Precomm->get() : $Precomm->where('id_user',$user->id)->get(
            
        )  ;

        $modes = ModePaiement::all();
        return view("pages.precommande", compact('precommandes', "modes"));
    }
    public function save(Request $request)
    {
        $precommande = new PreCommande;
        $precommande->id_user = Auth::user()->id;
        $precommande->date_pre_commande = date('Y-m-d H:i:s');
        if($precommande->save()){
            echo json_encode($precommande);
        }else{
            echo json_encode(array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            ));
        }
    }

    public function panier(Request $request)
    {
        $panier = new PrePaniers;
        $panier->id_pre_commande = $request->id;
        $panier->ref_prod = $request->ref_prod;
        $panier->id_unite = $request->unite;
        $panier->qte_commande = $request->qte;
        $panier->prix_produit = $request->prix;
        if($panier->save()){
            echo json_encode(array(
                'icon' => "success",
                'text' => "PreCommande enregistré avec success"
            ));
        }else{
            echo json_encode(array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            ));
        }
    }

    public function updatePanier(Request $request) {
        $panier = $request->id_panier ? PrePaniers::find($request->id_panier) : new PrePaniers;
        $panier->id_pre_commande = $request->id;
        $panier->ref_prod = $request->ref_prod;
        $panier->id_unite = $request->unite;
        $panier->qte_commande = $request->qte;
        $panier->prix_produit = $request->prix;
        if($panier->save()){
            echo json_encode(array(
                'icon' => "success",
                'text' => "PreCommande enregistré avec success"
            ));
        }else{
            echo json_encode(array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            ));
        }
    }

    public function delete(Request $request)
    {
        return PreCommande::destroy($request->id_precommande);
    }

    public function deletePanier(Request $request)
    {
        return PrePaniers::destroy($request->id_panier);
    }

    public function transfert(Request $request)
    {
        $precommande = PreCommande::find($request->precommande);
        $nom = ($request->client != '') ? $request->client : 'Anonyme';
        $client = Client::where('nom_client', $nom)->first();
        if($client){
            $id_client = $client->id_client;
        }else{
            $cli = new Client;
            $cli->nom_client = $nom;
            $cli->save();
            $id_client = $cli->id_client;
        }
        $commande = new Commande();
        $commande->id_client = $id_client;
        $commande->id_mode = $request->mode;
        $commande->id_user = Auth::user()->id;
        if($commande->save()){
            foreach($precommande->paniers as $prepanier){
                $panier = new Panier;
                $panier->id_commande = $commande->id_commande;
                $panier->ref_prod = $prepanier->ref_prod;
                $panier->prix_produit = $prepanier->prix_produit;
                $panier->qte_commande = $prepanier->qte_commande;
                $panier->id_unite = $prepanier->id_unite;
                $panier->save();
                $produit = Produit::find($prepanier->ref_prod);
                if(!$produit->fait_demande){
                    $unite = Avoir::where('ref_prod', $prepanier->ref_prod)->where('id_unite', $prepanier->id_unite)->first();
                    $produit->qte_stock -= ($unite->qte_unite * floatval($prepanier->qte_commande));
                    $produit->save();
                }
                $prepanier->delete();
            }
            $precommande->delete();
            return Response::json($commande, 200);
        }else{
            echo json_encode(array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            ));
        }
    }
}
