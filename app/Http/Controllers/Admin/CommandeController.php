<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Panier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    public function index()
    {
        return view('admin.commande');
    }
    public function liste()
    {
        $commandes = Commande::all();
        foreach ($commandes as $commande) {
            $total = DB::table('paniers')
                        ->where('id_commande', $commande->id_commande)
                        ->select(DB::raw('SUM(qte_commande * prix_produit) as total'))
                        ->first();
            $commande->date = date('d/m/Y H:i:s', strtotime($commande->created_at));
            $commande->user = User::find($commande->id_user)->nom;
            $commande->total = number_format($total->total, 2, ',', ' ').' Ar';
            $commande->client = Client::find($commande->id_client)->nom_client;
            $commande->action = '<a href="javascript:void(0)" class="badge bg-primary p-2" onclick=\'getDetail("'.$commande->id_commande.'")\'>Détail</a>';
        }
        echo json_encode($commandes);
    }
    public function getDetail(Request $request)
    {
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        $id_commande = $request->id;
        $commande = Commande::find($id_commande);
        $commande->nom_client = Client::find($commande->id_client)->nom_client;
        $commande->date = utf8_encode(strftime("%d %B %Y", strtotime($commande->created_at)).utf8_decode(' à ').strftime("%H:%M:%S", strtotime($commande->created_at)));
        $paniers = Panier::join('produits', 'produits.ref_prod', '=', 'paniers.ref_prod')
                                ->join('unite_mesures', 'unite_mesures.id_unite', '=', 'paniers.id_unite')
                                ->where('id_commande', $id_commande)
                                ->get();
        foreach ($paniers as $panier) {
            $panier->total = number_format($panier->prix_produit * $panier->qte_commande,2,',', ' ').' Ar';
            $panier->prix_produit = number_format($panier->prix_produit, 2, ',', ' ').' Ar';
            $panier->qte_commande = number_format($panier->qte_commande, 2, ',', ' ');
        }
        echo json_encode(array(
            'commande' => $commande,
            'paniers' => $paniers
        ));
    }
}
