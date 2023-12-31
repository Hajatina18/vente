<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depot;
use App\Models\PointVente;
use App\Models\Produit;
use App\Models\Transfert;
use App\Models\Avoir;
use App\Models\Stock;
use App\Models\StockPointVente;
use App\Models\TransfertProduit;
use Illuminate\Http\Request ;
use DateTime;
use Illuminate\Support\Facades\DB;
use Mpdf\Tag\Tr;

class TransfertController extends Controller
{
    public function index()
    {
        $produits = DB::table('produits')->join('entrer_produits', 'entrer_produits.ref_prod', '=', 'produits.ref_prod')->select('produits.*',)->get();
        $depots = Depot::all();
        $pointVente = PointVente::all();
        return view('admin.transfert', ['produits' => $produits, 'depots' => $depots, 'pointVente'=> $pointVente]);
    }

    public function store(Request $request) {
        $request->validate([
            'date_transfert' => 'required',
            'id_approvisionneur' => 'required',
        ]);
       $transferts = new Transfert;
       $transferts->date_transfert = $request->date_transfert;
       $transferts->id_approvisionneur = $request->id_approvisionneur;

       if($request->is_depot === "on"){
        $transferts->is_depot = true;
        $transferts->id_demandeur = $request->id_pdv;
       } else {
        $transferts->id_demandeur = $request->id_depot;
        $transferts->is_depot = false; 
       } 
        $transferts->bon_de_transfert = $this->getBonTransfert($transferts->id_demandeur, $transferts->id_approvisionneur);
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
        if($transfert->is_depot == true){
            $transfert->demandeur = DB::table('point_ventes')->join('users', 'users.depot', '=', 'point_ventes.id_pdv')->select('point_ventes.nom_pdv as depot', 'users.nom as nom' )->where('id_pdv', $transfert->id_demandeur)->where('users.is_depot',true)->get();
        }else {
            $transfert->demandeur = DB::table('depots')->join('users', 'users.depot', '=', 'depots.id_depot' )->select('nom_depot as depot', 'users.nom as nom')->where('id_depot', $transfert->id_demandeur)->where('users.is_depot',false)->get();
        } 
        $transfert->approvisionneur = DB::table('depots')->select('nom_depot')->where('id_depot', $transfert->id_approvisionneur)->get();
        $transfert->produits = TransfertProduit::join('produits', 'produits.ref_prod', '=', 'transfert_produits.ref_prod')
        ->join('unite_mesures', 'unite_mesures.id_unite', '=', 'transfert_produits.id_unite')
        ->where('id_transfert', $transfert->id_transfert)
        ->get();
        $transfert->date_transfert = $date_transfert->format('d/m/Y');
        $transfert->date = $date->format('d/m/Y H:i:s');
      }
       
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
            if($request->is_depot === "true"){
                $depots = Stock::where('ref_prod', $request->ref_prod)->where('id_depot', $request->approvisionneur)->first();
                if($depots != null){
                    $depot = $depots->stock - $request->qte;
                    $depots->update(['stock' => $depot]);
                $stock= new StockPointVente;
                $stock->ref_prod = $request->ref_prod;
                $stock->stock=$request->qte;
                $stock->id_pdv = $request->demandeur;
                $stock->week = (new DateTime())->format('W');
                $stock->save();
                $array = array(
                    'icon' => "success",
                    'text' => "Transfert vers un autre  point de vente enregistée avec succès"
                );
                }
                
            } 
            else{
                $depots = Stock::where('ref_prod', $request->ref_prod)->where('id_depot', $request->approvisionneur)->first();
                if($depots != null){
                    $depot = $depots->stock - $request->qte;
                    $depots->update(['stock' => $depot]);
                    $stock = new Stock;
                    $stock->ref_prod = $request->ref_prod;
                    $stock->stock = $request->qte; 
                    $stock->id_depot=$request->demandeur;
                    $stock->week = (new DateTime())->format('W');
                    $stock->save();
                    $array = array(
                        'icon' => "success",
                        'text' => "Transfert vers un dépôt  enregistée avec succès"
                    );
              
                }
                
            }
            // $produit->save();
            echo json_encode($array);
        }else{
            echo json_encode(array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            ));
        }
    }
    public function getQuantité(Request $request)
    {
        $stock = Stock::where('ref_prod', $request->ref_prod)->where('id_depot', $request->depot)->value('stock');
        if($stock >= $request->qte){
          $array = array(
                'icon' => "success",
                'text' => "Quantité suffisante"
            );
        } else {
            $array = array(
                'icon' => "error",
                'text' => "Quantité insuffisante"
            );
        }
        echo json_encode($array);
    }


    public function getBonTransfert($demandeur, $approvisionneur){
            $data = Transfert::orderBy('id_transfert', 'desc')->pluck('id_transfert')->first();
            $nombre =  $data + 1;
            $longueurNombre = 4; 
           $nouveauNombreAvecZeros = str_pad($nombre, $longueurNombre, '0', STR_PAD_LEFT);
           $demandeur = str_pad($demandeur, 2, 'O', STR_PAD_LEFT);
           $approvisionneur = str_pad($approvisionneur, 2, 'O', STR_PAD_LEFT);
            $var = 'BT/'.$demandeur.''.$approvisionneur .'/'. $nouveauNombreAvecZeros;
            return $var;
        
    }
}