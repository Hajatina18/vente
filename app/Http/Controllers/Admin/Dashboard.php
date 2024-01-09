<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entrer;
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index()
    {
        $jour = DB::table('commandes')
                    ->where(DB::raw('date(commandes.created_at)'), '=' , date('Y-m-d'))
                    ->join('paniers', 'commandes.id_commande', '=', 'paniers.id_commande')
                    ->select(DB::raw('SUM(qte_commande * prix_produit) as total'))
                    ->get();
        $nombre = DB::table('commandes')
                    ->where(DB::raw('date(commandes.created_at)'), date('Y-m-d'))
                    ->select(DB::raw('count(*) as nombre'))
                    ->get();
        $client = DB::table('commandes')
                    ->where(DB::raw('month(commandes.created_at)'), date('m'))
                    ->select(DB::raw('count(id_client) as nombre'))
                    ->get();
        $month = DB::table('commandes')
                    ->where(DB::raw('month(commandes.created_at)'), date('m'))
                    ->join('paniers', 'commandes.id_commande', '=', 'paniers.id_commande')
                    ->select(DB::raw('SUM(qte_commande * prix_produit) as total'))
                    ->get();
        $produits = Produit::where('qte_stock', '<=', 5)->get();
        foreach ($produits as $product) {
            $base = DB::table('avoirs')->join('unite_mesures', 'unite_mesures.id_unite', '=', 'avoirs.id_unite')->where('avoirs.ref_prod', $product->ref_prod)->select("unite_mesures.unite")->first();
            $product->qte_stock = number_format($product->qte_stock, 0, ',', ' ').' '.($product->qte_stock > 1 ? $base->unite.'s' : $base->unite);
        }
        $entrers = Entrer::where("date_echeance", ">=", date('Y-m-d'))->where('date_echeance', '<=', date('Y-m-d', strtotime('+ 7days')))->get();
        foreach ($entrers as $entrer) {
            $entrer->nom_frns = Fournisseur::find($entrer->id_frns)->nom_frns;
            $entrer->date_facture = ($entrer->date_facture == NULL) ? "" : date('d/m/Y', strtotime($entrer->date_facture));
            $entrer->date_echeance = ($entrer->date_echeance == NULL) ? "" : date('d/m/Y', strtotime($entrer->date_echeance));
        }
        return view('admin.dashboard', compact('jour', 'nombre', 'client', 'month', 'produits', 'entrers'));
    }
}
