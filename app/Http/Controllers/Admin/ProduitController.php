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

class ProduitController extends Controller
{
    public function index()
    {
        $unites = UniteMesure::all();
        return view("admin.produit", compact('unites'));
    }

    public function addProduct(Request $request)
    {
        if($request->file('image_prod') != null){
            $image = $request->file('image_prod')->getClientOriginalName();
            $path = $request->file('image_prod')->storeAs('produit', $image, 'public');
            $image_final = 'storage/produit/'.$image;
        }else{
            $image_final = 'img/default.jpg';
        }
        $product = new Produit;
        $product->ref_prod = $request->ref_prod;
        $product->nom_prod = $request->nom_prod;
        
        if(boolval($request->fait_demande)){
            $product->qte_stock = 0;
        }else{
            $product->qte_stock = str_replace(',', '.', $request->qte_stock);
        }
        $product->image_prod = $image_final;
      
        if($product->save()){
            $stock = new Stock;
            $stock->week = (new DateTime())->format('W');
            $stock->ref_prod = $product->ref_prod;
            $stock->stock = $product->qte_stock;
            $stock->save();
            $array = $product;
        }else{
            $array = array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            );
        }
        echo json_encode($array);
    }


    public function add_unite(Request $request)
    {
        $avoir = new Avoir;
        $avoir->id_unite = $request->unite;
        $avoir->ref_prod = $request->ref_prod;
        $avoir->prix = str_replace(',', '.', $request->prix);
        $avoir->qte_unite = str_replace(',', '.', $request->qte);
        $avoir->save();
        echo json_encode($avoir);
    }

    public function liste()
    {
        $products = Produit::all();
        foreach ($products as $product) {
            $product->action = "<a href='#' class='btn btn-primary' onclick=\"getProduit('".$product->ref_prod."')\">Modifier</a>";
            $unites = DB::table('avoirs')->join('unite_mesures', 'unite_mesures.id_unite', '=', 'avoirs.id_unite')->where('avoirs.ref_prod', $product->ref_prod)->select("unite_mesures.unite", "avoirs.prix")->get();
            $unite = "";
            foreach ($unites as $value) {
                $unite .= "<span>".$value->unite." : ".number_format($value->prix, 2, ',' , ' ')." Ar</span><br>";
            }
            $base = DB::table('avoirs')->join('unite_mesures', 'unite_mesures.id_unite', '=', 'avoirs.id_unite')->where('avoirs.ref_prod', $product->ref_prod)->where('qte_unite', 1)->select("unite_mesures.unite")->first();
            $product->unite = $unite;
            if(boolval($product->fait_demande)){
                $product->qte_stock = "Fait à la demande";
            }else{
                $product->qte_stock = number_format($product->qte_stock, 0, ',', ' ').' '.($product->qte_stock > 1 ? $base->unite.'s' : $base->unite);
            }
            $product->image_prod = "<img src='".url($product->image_prod)."' style='width: 60px'>";
        }
        echo json_encode($products);
    }
    public function getProduit(Request $request)
    {
        $produit = Produit::find($request->ref_prod);
        $produit->unite = Avoir::join('unite_mesures', 'unite_mesures.id_unite', '=', 'avoirs.id_unite')->where('ref_prod', $request->ref_prod)->get();
        echo json_encode($produit);
    }

    public function update(Request $request)
    {
        $produit = Produit::find($request->ref_prod);
        $produit->nom_prod = $request->nom_prod;
        $produit->fait_demande = $request->fait_demandeModif == "false" ? false : true;
        if(boolval($request->fait_demandeModif)){
            $produit->qte_stock = 0;
        }
        if($request->file('image_prod') != null){
            $image = $request->file('image_prod')->getClientOriginalName();
            $path = $request->file('image_prod')->storeAs('produit', $image, 'public');
            $produit->image_prod = 'storage/produit/'.$image;
        }
        if($produit->save()){
            $array = $produit;
        }else{
            $array = array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            );
        }
        echo json_encode($array);
    }
    public function update_unite(Request $request)
    {
        $avoir = Avoir::where('ref_prod', $request->ref_prod)->where('id_unite', $request->unite)->first();
        $avoir->qte_unite = str_replace(',', '.', $request->qte);
        $avoir->prix = str_replace(',', '.', $request->prix);
        $avoir->save();
        echo json_encode($avoir);
    }
}
