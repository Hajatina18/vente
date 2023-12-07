<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depot;
use App\Models\PointVente;
use App\Models\Produit;
use App\Models\Transfert;
use App\Models\Avoir;
use App\Models\Stock;
use App\Models\TransfertProduit;
use Illuminate\Http\Request ;
use DateTime;
use Illuminate\Support\Facades\DB;
use Mpdf\Tag\Tr;

class TransfertController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        $depots = Depot::all();
        $pointVente = PointVente::all();
        return view('admin.transfert', ['produits' => $produits, 'depots' => $depots, 'pointVente'=> $pointVente]);
    }

    public function store(Request $request) {
        $request->validate([
            'bon_de_transfert' => 'required',
            'date_transfert' => 'required',
            'id_demandeur' => 'required',
            'id_approvisionneur' => 'required',
        ]);
       $transferts = new Transfert;
       $transferts->bon_de_transfert = $request->bon_de_transfert;
       $transferts->date_transfert = $request->date_transfert;
        $transferts->id_demandeur = $request->id_demandeur;
       $transferts->id_approvisionneur = $request->id_approvisionneur;
       if($request->is_depot === null){
        $transferts->is_depot = false;
       } else  $transferts->is_depot = true; 
       if($transferts->save()){
        $array = $transferts;
        }
        else{
            $array = (array(
                'icon' => "error",
                'text' => "Votre transfert est echoué"
            ));
        }
       echo json_encode($array);
    }
    
    public function liste(){
        $transferts = Transfert::all();
      foreach($transferts as $transfert){
        $date = new DateTime($transfert->created_at);
        $date_transfert = new DateTime($transfert->date_transfert);
        if($transfert->is_depot === true){
            $transfert->demandeur = DB::table('point_ventes  as nom')->select('nom_pdv')->where('id_pdv', $transfert->id_demandeur)->get();
        }else {
            $transfert->demandeur = DB::table('depots as nom')->select('nom_depot')->where('id_depot', $transfert->id_demandeur)->get();
        } 
        $transfert->approvisionneur = DB::table('depots')->select('nom_depot')->where('id_depot', $transfert->id_approvisionneur)->get();
        $transfert->produits = TransfertProduit::join('produits', 'produits.ref_prod', '=', 'transfert_produits.ref_prod')
        ->join('unite_mesures', 'unite_mesures.id_unite', '=', 'transfert_produits.id_unite')
        ->where('id_transfert', $transfert->id_transfert)
        ->get();
        $transfert->date_transfert = $date_transfert->format('d/m/Y');
        $transfert->date = $date->format('d/m/Y H:i:s');
      }
         return dd($transferts);
        echo json_encode($transferts);
    }

    public function getUnite(Request $request)
    {
        $unite = Avoir::join('unite_mesures', 'avoirs.id_unite', "=", 'unite_mesures.id_unite')->where('ref_prod', $request->ref_prod)->get();
        echo json_encode($unite);
    }

    public function add_panier_transfert(Request $request){
        $panier_transfert = new  TransfertProduit;
        $panier_transfert->id_transfert = $request->id;
        $panier_transfert->ref_prod = $request->ref_prod;
        $panier_transfert->id_unite = $request->unite;
        $panier_transfert->qte_transfert = $request->qte;
        if($panier_transfert->save()){
           
            $stock = new Stock;
            $stock->ref_prod = $request->ref_prod;
            $stock->stock=$request->qte; 
            $stock->id_depot=$request->demandeur;
            $stock->week = (new DateTime())->format('W');
            $stock->save();
            // $produit = Produit::find($request->ref_prod);
            // $unite = Avoir::where('ref_prod', $request->ref_prod)->where('id_unite', $request->unite)->first();
            // $produit->qte_stock += ($unite->qte_unite * floatval($request->qte));
            // $produit->save();
            echo json_encode(array(
                'icon' => "success",
                'text' => "Transfert enregistée avec succès"
            ));
        }else{
            echo json_encode(array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            ));
        }
    }
}