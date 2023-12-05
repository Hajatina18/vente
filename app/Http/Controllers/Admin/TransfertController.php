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
       Transfert::create($request->all());
       $array = array(
        'icon' => "success",
        'text' => "Transfert enregistré"
    );
    echo json_encode($array);
    }
    
    public function liste(){
        $transferts = Transfert::all();
      
        echo json_encode($transferts);
    }

    public function getUnite(Request $request)
    {
        $unite = Avoir::join('unite_mesures', 'avoirs.id_unite', "=", 'unite_mesures.id_unite')->where('ref_prod', $request->ref_prod)->get();
        echo json_encode($unite);
    }

    public function add_panier_transfert(Request $request){
        $panier_transfert = new  TransfertProduit;
        $panier_transfert->id_transfert = $request->id_transfert;
        $panier_transfert->ref_prod = $request->ref_prod;
        $panier_transfert->id_unite = $request->id_unite;
        $panier_transfert->qte_transfert = $request->qte;
        if($panier_transfert->save()){
            $stock = Stock::where('ref_prod',$request->ref_prod)->first();
            $depot = Depot::where('is_default', 1)->first();
            $stock->update(['stock'=>$request->qte, 'id_depot'=>$depot->id_depot]);
            $produit = Produit::find($request->ref_prod);
            $unite = Avoir::where('ref_prod', $request->ref_prod)->where('id_unite', $request->unite)->first();
            $produit->qte_stock += ($unite->qte_unite * floatval($request->qte));
            $produit->save();
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