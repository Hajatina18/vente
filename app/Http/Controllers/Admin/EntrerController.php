<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avoir;
use App\Models\Depot;
use App\Models\Entrer;
use App\Models\EntrerProduit;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Stock;
use DateTime;
use Illuminate\Http\Request;

class EntrerController extends Controller
{
    public function index()
    {
        $frns = Fournisseur::all();
        $produits = Produit::where('fait_demande', true)->get();
        return view('admin.entrer', ['produits' => $produits, 'fournisseurs' => $frns]);
    }
    public function getUnite(Request $request)
    {
        $unite = Avoir::join('unite_mesures', 'avoirs.id_unite', "=", 'unite_mesures.id_unite')->where('ref_prod', $request->ref_prod)->get();
        echo json_encode($unite);
    }
    public function addEntrer(Request $request)
    {
        $depot = Depot::where('is_default', true)->first();
        if ($depot === null){
            $array = (array(
                'icon' => "error",
                'text' => "Vous n'avez pas encore de dépôt principale"
            ));
        }
        else{
            $nom = ($request->frns != '') ? $request->frns : 'Anonyme';
            $fournisseur = Fournisseur::where('nom_frns', $nom)->first();
            if($fournisseur){
                $id_frns = $fournisseur->id_frns;
            }else{
                $frns = new Fournisseur;
                $frns->nom_frns = $nom;
                $frns->save();
                $id_frns = $frns->id_frns;
            }
            $enter = new Entrer;
            $enter->code_art = $request->code_art;
            $enter->reference_bl_frns = $request->reference_bl_frns;
            $enter->pcb =  $request->pcb;
            $enter->prix_achat_ht = $request->prix_achat_ht;
            $enter->prix_achat_ttc	 = $request->prix_achat_ttc;
            $enter->cout_trans = $request->cout_trans;
            $enter->id_frns = $id_frns;
            $enter->date_facture = $request->date_facture;
            $enter->num_facture = $request->num_facture;
            $enter->num_bl = $request->num_bl;
            $enter->date_echeance = $request->date_echeance;
            $enter->depot = $depot->id_depot;
            if($enter->save()){
            $array = $enter;
            }else{
                $array = (array(
                    'icon' => "error",
                    'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
                ));
            }
        }
       
        echo json_encode($array);
    }
    public function add_panier(Request $request)
    { 
        $entrerProduit = new EntrerProduit;  
        $entrerProduit->id_entrer = $request->id;
        $entrerProduit->ref_prod = $request->ref_prod;
        $entrerProduit->id_unite = $request->unite;
        $entrerProduit->qte_entrer = $request->qte;
        if($entrerProduit->save()){
            $stock = Stock::where('ref_prod',$request->ref_prod)->first();
            $depot = Depot::where('is_default', 1)->first();
            $stock->stock  += $request->qte;
            $stock->update(['stock'=>$stock->stock, 'id_depot'=>$depot->id_depot]);
            $produit = Produit::find($request->ref_prod);
            $unite = Avoir::where('ref_prod', $request->ref_prod)->where('id_unite', $request->unite)->first();
            $produit->qte_stock += ($unite->qte_unite * floatval($request->qte));
            $produit->save();
            echo json_encode(array(
                'icon' => "success",
                'text' => "Bon d'Entrée enregistée avec succès"
            ));
        }else{
            echo json_encode(array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            ));
        }
    }

    public function liste()
    {
        $entrers = Entrer::orderByDesc('created_at')->get();
        foreach ($entrers as $entrer) {
            $date = new DateTime($entrer->created_at);
            $entrer->nom_frns = Fournisseur::find($entrer->id_frns)->nom_frns;
            $entrer->date_facture = ($entrer->date_facture == NULL) ? "" : date('d/m/Y', strtotime($entrer->date_facture));
            $entrer->date_echeance = ($entrer->date_echeance == NULL) ? "" : date('d/m/Y', strtotime($entrer->date_echeance));
            $entrer->action = '<a href="javascript:void(0)" class="badge bg-primary p-2" onclick=\'getDetail("'.$entrer->id_entrer.'")\'>Détail</a>';
            $entrer->date = $date->format('d/m/Y H:i:s');
            $entrer->panier = EntrerProduit::join('produits', 'produits.ref_prod', '=', 'entrer_produits.ref_prod')
                                ->join('unite_mesures', 'unite_mesures.id_unite', '=', 'entrer_produits.id_unite')
                                ->where('id_entrer', $entrer->id_entrer)
                                ->get();
        }
     
        echo json_encode($entrers);
    }



    public function getDetail(Request $request)
    {
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        $id_entrer = $request->id;
        $entrer = Entrer::find($id_entrer);
        $entrer->nom_frns = Fournisseur::find($entrer->id_frns)->nom_frns;
        $entrer->date = utf8_encode(strftime("%d %B %Y", strtotime($entrer->created_at)).utf8_decode(' à ').strftime("%H:%M:%S", strtotime($entrer->created_at)));
        $entrer->date_facture = ($entrer->date_facture == NULL) ? "" : utf8_encode(strftime("%d %B %Y", strtotime($entrer->date_facture)));
        $entrer->date_echeance = ($entrer->date_echeance == NULL) ? "" : utf8_encode(strftime("%d %B %Y", strtotime($entrer->date_echeance)));
        $paniers = EntrerProduit::join('produits', 'produits.ref_prod', '=', 'entrer_produits.ref_prod')
                                ->join('unite_mesures', 'unite_mesures.id_unite', '=', 'entrer_produits.id_unite')
                                ->where('id_entrer', $id_entrer)
                                ->get();
        echo json_encode(array(
            'entrer' => $entrer,
            'paniers' => $paniers
        ));
    }
}
