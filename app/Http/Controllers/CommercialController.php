<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CommercialController;
use App\Models\UniteMesure;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Http\Controllers\Controller;
use App\Models\Avoir;
use App\Models\Stock;
use DateTime;
use Illuminate\Support\Facades\DB;

class CommercialController extends Controller
{
    public function index()
    {
        // Logique pour la page d'accueil des utilisateurs commerciaux
        $unites = UniteMesure::all();
        return view("admin.produitcom", compact('unites'));
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
}
