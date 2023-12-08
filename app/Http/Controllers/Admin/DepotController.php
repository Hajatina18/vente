<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depot;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Stock;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepotController extends Controller
{
    public function index(Request $request)
    {
        $id_depot = $request->id;
        $depot = Depot::where('id_depot',$id_depot)->first();
        $fournisseurs = Fournisseur::all();
        $produits = Produit::all();
       
        if($depot && !$depot->is_default){
            return view('admin.detail-stock',  compact('produits','depot'));
        }else {
         return view('admin.depot',  compact('fournisseurs', 'produits'));
        }
    }

    public function stock (Request $request){
        $id_depot = $request->id;
        $produits = Stock::join('produits','produits.ref_prod','=','stocks.ref_prod')->where('id_depot',$id_depot)->get();
        foreach ($produits as $product) {
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
        echo json_encode($produits);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_depot' => 'required|max:200',
            'localisation' => 'required',
        ]);
        if ($request->id_depot != NULL) {
            $depot = Depot::find($request->id_depot);
        } else {
            $depot = new Depot;
        }
        $depot->nom_depot = $request->nom_depot;
        $depot->localisation = $request->localisation;
        $depot->is_default = $request->is_default;
        if ($depot->save()) {
            $array = array(
                'icon' => "succes",
                'text' => "Dépôt crée avec success"
            );
        } else {
            $array = array(
                'icon' => "error",
                'text' => "Une erreur lors de l'ajout"
            );
        }
        echo json_encode($array);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'localisation' => 'required',
        ]);
        $depot = Depot::find($request->id_depot);
        $depot->update($request->all());
        return redirect()->route('admin.listedepot')
            ->with('success', 'Depot modifier succes !');
    }

    public function delete(Request $request)
    {
        if(Depot::destroy($request->id)){
            $output = array(
                'icon' => 'success',
                'text' => "Depôt supprimée"
            );
        }else{
            $output = array(
                'icon' => 'warning',
                'text' => "Il y a une erreur durant la suppression"
            );
        }
        echo json_encode($output);
    }

    public function create()
    {
        return view('admin.listedepot');
    }

    public function show($id_depot)
    {
        $depot = Depot::find($id_depot);
        return view('admin.listedepot', compact('depot'));
    }

    public function edit($id_depot)
    {
        $depot = Depot::find($id_depot);
        return view('admin.listedepot', compact('depot'));
    }

    public function liste()
    {
        $depots = Depot::orderByDesc('created_at')->get();
        foreach ($depots as $depot) {
            $depot->action = "`<a href='javascript:void(0)' class='badge bg-primary p-2 ms-2  edit_depot'>Modifier</a>
                                <a href='javascript:void(0)' class='badge bg-danger p-2 ms-2 delete_depot' data-id='" . $depot->id_depot . "'>Supprimer</a>
                                <a href='/admin/depots/" . $depot->id_depot . "' class='badge bg-success p-2 ms-2 visit_depot' data-id='" . $depot->id_depot . "'>Visiter</a>`";
        }
        echo json_encode($depots);
    }

   
}
