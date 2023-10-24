<?php

namespace App\Http\Controllers;

use App\Models\EntrerProduit;
use App\Models\Panier;
use App\Models\Produit;
use App\Models\Stock;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        foreach ($produits as $produit) {
            $entrer = EntrerProduit::join("avoirs", function($join){
                        $join->on('entrer_produits.ref_prod', '=', 'avoirs.ref_prod')
                            ->on('entrer_produits.id_unite', '=',"avoirs.id_unite");
                    })->where('entrer_produits.ref_prod', $produit->ref_prod)
                    ->where(DB::raw('week(entrer_produits.created_at)'), (new DateTime())->format('W'))
                    ->sum(DB::raw('qte_entrer*qte_unite'));
            $sortie = Panier::join("avoirs", function($join){
                        $join->on('paniers.ref_prod', '=', 'avoirs.ref_prod')
                            ->on('paniers.id_unite', '=',"avoirs.id_unite");
                    })->where('paniers.ref_prod', $produit->ref_prod)
                    ->where(DB::raw('week(paniers.created_at)'), (new DateTime())->format('W'))
                    ->sum(DB::raw('qte_commande*qte_unite'));
            $stock = Stock::where('ref_prod', $produit->ref_prod)->where('week', (new DateTime())->format('W'))->first();
            $base = DB::table('avoirs')->join('unite_mesures', 'unite_mesures.id_unite', '=', 'avoirs.id_unite')->where('avoirs.ref_prod', $produit->ref_prod)->where('qte_unite', 1)->select("unite_mesures.unite")->first();
            $produit->unite = $base->unite;
            $produit->entrer = $entrer;
            $produit->sortie = $sortie;
            $produit->stock_initial = ($stock == null ? 0 : $stock->stock);
            $produit->stock_week = $produit->stock_initial + $produit->entrer - $produit->sortie;
        }
        $week = (new DateTime())->format('Y-\WW');
        return view("admin.balance", compact("produits", "week"));
    }
    public function getWeek($week)
    {
        $week1 = substr($week, strpos($week, 'W')+1, strlen($week));
        $produits = Produit::all();
        foreach ($produits as $produit) {
            $entrer = EntrerProduit::join("avoirs", function($join){
                        $join->on('entrer_produits.ref_prod', '=', 'avoirs.ref_prod')
                            ->on('entrer_produits.id_unite', '=',"avoirs.id_unite");
                    })->where('entrer_produits.ref_prod', $produit->ref_prod)
                    ->where(DB::raw('week(entrer_produits.created_at)'), $week1)
                    ->sum(DB::raw('qte_entrer*qte_unite'));
            $sortie = Panier::join("avoirs", function($join){
                        $join->on('paniers.ref_prod', '=', 'avoirs.ref_prod')
                            ->on('paniers.id_unite', '=',"avoirs.id_unite");
                    })->where('paniers.ref_prod', $produit->ref_prod)
                    ->where(DB::raw('week(paniers.created_at)'), $week1)
                    ->sum(DB::raw('qte_commande*qte_unite'));
            $stock = Stock::where('ref_prod', $produit->ref_prod)->where('week', $week1)->first();
            $base = DB::table('avoirs')->join('unite_mesures', 'unite_mesures.id_unite', '=', 'avoirs.id_unite')->where('avoirs.ref_prod', $produit->ref_prod)->where('qte_unite', 1)->select("unite_mesures.unite")->first();
            $produit->unite = $base->unite;
            $produit->entrer = $entrer;
            $produit->sortie = $sortie;
            $produit->stock_initial = ($stock == null ? 0 : $stock->stock);
            $produit->stock_week = $produit->stock_initial + $produit->entrer - $produit->sortie;
        }
        return view("admin.balance", compact("produits", "week"));
    }

    public function addStock()
    {
        $produits = Produit::all();
        foreach ($produits as $produit) {
            $existe = Stock::where('ref_prod', $produit->ref_prod)->where('week', (new DateTime())->format('W'))->get();
            if(count($existe) < 1){
                $stock = new Stock;
                $stock->week = (new DateTime())->format('W');
                $stock->ref_prod = $produit->ref_prod;
                $stock->stock = $produit->qte_stock;
                $stock->save();
            }
        }
        echo json_encode(true);
    }
}
