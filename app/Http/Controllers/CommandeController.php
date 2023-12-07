<?php

namespace App\Http\Controllers;

use App\Models\Avoir;
use App\Models\Client;
use App\Models\Commande;
use App\Models\FondCaisse;
use App\Models\Magasin;
use App\Models\ModePaiement;
use App\Models\Panier;
use App\Models\PreCommande;
use App\Models\PrePaniers;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\UniteMesure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class CommandeController extends Controller
{
    public function index($id = null)
    {
        $modes = ModePaiement::all();
        $precommande = PreCommande::withSum(['paniers' => fn ($query) => $query->select(DB::raw("sum(prix_produit*qte_commande)"))], '')->where("id_pre_commande", $id)->first();
        return view('pages.commande', array("precommande" => $precommande,'modes' => $modes, "parametres" => $id));
    }
    public function searchProduct(Request $request)
    {
        $word = $request->search;
        $produits = DB::table('produits')
            ->join('avoirs', "avoirs.ref_prod", "=", "produits.ref_prod")
            ->join('unite_mesures', 'unite_mesures.id_unite', "=", "avoirs.id_unite")
            ->select('produits.*', 'avoirs.prix', 'unite_mesures.unite', 'unite_mesures.id_unite')
            ->where(function ($query) use ($word) {
                $query->where('nom_prod', 'like', "%$word%")
                ->orWhere('produits.ref_prod', 'like', "%$word%");
            })->where('qte_stock', '>', 0)
            ->orWhere('fait_demande', true)
            ->get();
        $view = view('pages.partials.produits', compact('produits'))->render();
        echo json_encode($view);
    }
    public function save_commande(Request $request)
    {
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
        $commande = new Commande;
        $commande->id_client = $id_client;
        $commande->id_mode = $request->mode;
        $commande->id_user = Auth::user()->id;
        if($commande->save()){
            echo json_encode($commande);
        }else{
            echo json_encode(array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            ));
        }
    }

    public function add_panier(Request $request)
    {
        $panier = new Panier;
        $panier->id_commande = $request->id;
        $panier->ref_prod = $request->ref_prod;
        $panier->id_unite = $request->unite;
        $panier->qte_commande = $request->qte;
        $panier->prix_produit = $request->prix;
        if($panier->save()){
            $produit = Produit::find($request->ref_prod);
            if(!$produit->fait_demande){
                $unite = Avoir::where('ref_prod', $request->ref_prod)->where('id_unite', $request->unite)->first();
                $produit->qte_stock -= ($unite->qte_unite * floatval($request->qte));
                $produit->save();
            }
            echo json_encode(array(
                'icon' => "success",
                'text' => "Commande enregistré avec success"
            ));
        }else{
            echo json_encode(array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            ));
        }
    }
    
    public function getClient()
    {
        $clients = Client::all();
        foreach ($clients as $client) {
            $client->action = '<a class="btn btn-sm btn-secondary " data-id="'.$client->nom_client.'">
                <i class="las la-plus-circle add"></i>
            </a>';
        }
        echo json_encode($clients);
    }
    public function ticket(Request $request)
    {
        $id_commande = $request->id;
        $commande = Commande::find($id_commande);
        $commande->client = Client::find($commande->id_client)->nom_client;
        $commande->user = User::find($commande->id_user)->nom;
        $paniers = Panier::where('id_commande', $commande->id_commande)->get();
        foreach ($paniers as $panier) {
            $panier->designation = Produit::find($panier->ref_prod)->nom_prod;
            $panier->unite = UniteMesure::find($panier->id_unite)->unite;
        }
        $config = Magasin::find(1);
        $config->logo = public_path($config->logo);
        $view = view('pages.partials.ticket', compact('commande', "paniers", 'config'))->render();
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => [48, 280],//@le ticket ty 70*280 ty fa afaka atao page le izy (A4, A3, ...)
            'orientation' => 'P'
        ]);
        $pdf->WriteHTML($view);
        $pdf->Output();
    }
    public function facture(Request $request)
    {
        $id_commande = $request->id;
        $commande = Commande::find($id_commande);
        $commande->client = Client::find($commande->id_client)->nom_client;
        $paniers = Panier::where('id_commande', $commande->id_commande)->get();
        foreach ($paniers as $panier) {
            $panier->designation = Produit::find($panier->ref_prod)->nom_prod;
            $panier->unite = UniteMesure::find($panier->id_unite)->unite;
        }
        $config = Magasin::find(1);
        $config->logo = $config->logo != null ? public_path($config->logo) : null;
        $view = view('pages.partials.facture', compact('commande', "paniers", 'config'))->render();
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',//@le ticket ty 70*280 ty fa afaka atao page le izy (A4, A3, ...)
            'orientation' => 'P'
        ]);
        $pdf->WriteHTML($view);
        $pdf->Output();
    }

    public function stock(Request $request)
    {
        $ref_prod = $request->ref_prod;
        $qte = $request->qte;
        $unite = $request->unite;
        $produit = Produit::find($ref_prod);
        $avoir = Avoir::where('ref_prod', $ref_prod)->where('avoirs.id_unite', $unite)->join('unite_mesures', 'avoirs.id_unite', '=', 'unite_mesures.id_unite')->select('*')->first();
        if(($avoir->qte_unite * $qte) > $produit->qte_stock){
            $produit->qte_stock /= $avoir->qte_unite;
            $produit->unite = $avoir->unite;
            echo json_encode($produit);
        }else{
            echo json_encode(true);
        }
    }
    public function caisse()
    {
        $user = auth()->user(); 
        $caisse = FondCaisse::where(DB::raw('date(created_at)'), date('Y-m-d'))->select(DB::raw('SUM(montant) as total'))->first();
        $command = $user->is_admin ===1 ? DB::table('commandes') : DB::table('commandes')->where('id_user',$user->id);
        $jour =  $command
                    ->where(DB::raw('date(commandes.created_at)'), '=' , date('Y-m-d'))
                    ->join('paniers', 'commandes.id_commande', '=', 'paniers.id_commande')
                    ->select(DB::raw('SUM(qte_commande * prix_produit) as total'))
                    ->first();
        $commandes = Commande::where('id_user', Auth::user()->id)->where(DB::raw('date(created_at)'), date('Y-m-d'))->get();
        foreach ($commandes as $commande) {
            $total = DB::table('paniers')
                        ->where('id_commande', $commande->id_commande)
                        ->select(DB::raw('SUM(qte_commande * prix_produit) as total'))
                        ->first();
            $commande->date = date('d/m/Y H:i:s', strtotime($commande->created_at));
            $commande->total = number_format($total->total, 2, ',', ' ').' Ar';
            $commande->client = Client::find($commande->id_client)->nom_client;
        }
        $total = $caisse->total + $jour->total;
        $data = array(
            'caisse' => $caisse,
            'commande' => $jour,
            'commandes' => $commandes,
            'total' => $total
        );
        return view('pages.caisse', $data);
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
    public function getProduit()
    {
        $user =auth()->user();
        $id_depot = $user->id_depot;
        $id_pdv = $user->id_pdv;

        $commercial = $user->is_admin === 2;
 
        $produits = $commercial ? Stock::join('produits','produits.ref_prod','=','stocks.ref_prod')->get() 
                                : ($id_depot ? Stock::join('produits','produits.ref_prod','=','stocks.ref_prod')
                                               ->where('id_depot',$id_depot)->get() : "");
        foreach ($produits as $product) {
        //     $product->action = "<a href='#' class='btn btn-primary' onclick=\"getProduit('".$product->ref_prod."')\">Modifier</a>";
            $unites = DB::table('avoirs')->join('unite_mesures', 'unite_mesures.id_unite', '=', 'avoirs.id_unite')->where('avoirs.ref_prod', $product->ref_prod)->select("unite_mesures.id_unite","unite_mesures.unite", "avoirs.prix")->get();
            $unite = "";
            foreach ($unites as $value) {
                $unite .= "<div class='d-flex justify-content-between' >
                                <span>".$value->unite." : ".number_format($value->prix, 2, ',' , ' ')." Ar</span>
                                <i style='cursor:pointer;' class='las text-primary la-plus-circle fs-2 me-2' onclick=\"addPanier('$product->ref_prod','$product->nom_prod','$value->prix','$value->id_unite','$value->unite','url($product->image_prod) ')\" ></i>  
                            </div>";
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
        echo json_encode($produits);
    
    }
}
