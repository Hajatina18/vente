<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointVente;
use App\Models\Stock;
use App\Models\StockPointVente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.liste-point-vente');
    }

    public function show(Request $request) {
        $magasin = PointVente::where('id_pdv',$request->id)->first();
        return view('admin.detail-magasin',compact('magasin')); 
    }
    
    public function stock (Request $request){
        $id_depot = $request->id;
        $produits = StockPointVente::join('produits','produits.ref_prod','=','stock_point_ventes.ref_prod')->where('id_pdv',$id_depot)->get();
        foreach ($produits as $product) {
            // $product->action = "<a href='#' class='btn btn-primary' onclick=\"getProduit('".$product->ref_prod."')\">Modifier</a>";
            $unites = DB::table('avoirs')->join('unite_mesures', 'unite_mesures.id_unite', '=', 'avoirs.id_unite')->where('avoirs.ref_prod', $product->ref_prod)->select("unite_mesures.unite", "avoirs.prix")->get();
            $unite = "";
            foreach ($unites as $value) {
                $unite .= "<span>".$value->unite." : ".number_format($value->prix, 2, ',' , ' ')." Ar</span><br>";
            }
            $base = DB::table('avoirs')->join('unite_mesures', 'unite_mesures.id_unite', '=', 'avoirs.id_unite')->where('avoirs.ref_prod', $product->ref_prod)->where('qte_unite', 1)->select("unite_mesures.unite")->first();
            $product->unite = $unite;
            $product->qte_stock = number_format($product->stock, 0, ',', ' ').' '.($product->stock > 1 ? $base->unite.'s' : $base->unite);
            $product->image_prod = "<img src='".url($product->image_prod)."' style='width: 60px'>";
        }
        echo json_encode($produits);
    }

    public function store(Request $request)
    {
       if($request->id_pdv != NULL){
            $pointVente = PointVente::where('id_pdv',$request->id_pdv)->first();
        }else{
            $pointVente = new PointVente;
        }
        $pointVente->nom_pdv = $request->nom_pdv;
        $pointVente->address_pdv = $request->address_pdv;
        $pointVente->telephone_pdv = $request->telephone_pdv;
        $pointVente->telephone_pdv = $request->telephone_pdv;
        $pointVente->nif_pdv = $request->nif_pdv;
        $pointVente->stat_pdv = $request->stat_pdv;
        $pointVente->rcs_pdv = $request->rcs_pdv;

        if($pointVente->save()){
            $array = array(
                'icon' => "success",
                'text' => "Enregistrement effectué"
            );
        }else{
            $array = array(
                'icon' => "error",
                'text' => "Il existe une erreur interne, Veillez contacer l'administrateur"
            );
        }
        echo json_encode($array);
    }

    public function liste()
    {
        $pointVente = PointVente::all();
        foreach ($pointVente as $pointvente) {
            $pointvente->action = "`<a href='#' class='badge bg-primary p-2 ms-2 edit' data-bs-toggle='modal' data-bs-target='#exampleModal' data-id='".$pointvente->id_pdv."' >Modifier</a>
                                    <a href='javascript:void(0)' class='badge bg-danger p-2 ms-2 delete_poinvente' data-id='".$pointvente->id_pdv."'>Supprimer</a>
                                    <a href='/admin/points_vente/". $pointvente->id_pdv ."' class='badge bg-success p-2 ms-2 visit_depot' data-id='" . $pointvente->id_pdv . "'>Visiter</a>`";}
        echo json_encode($pointVente);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PointVente  $pointVente
     * @return \Illuminate\Http\Response
     */
    public function edit(PointVente $pointVente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PointVente  $pointVente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PointVente $pointVente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PointVente  $pointVente
     * @return \Illuminate\Http\Response
     */
    public function destroy(PointVente $pointVente)
    {
        //
    }
}
