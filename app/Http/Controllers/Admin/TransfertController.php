<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depot;
use App\Models\PointVente;
use App\Models\Produit;
use App\Models\Transfert;
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
        $request-> validate([
            'bon_de_transfert' => 'required',
            'quantite_transfert'=> 'required',
            'date_transfert' => 'required',
            'id_demandeur' => 'required',
            'id_approvissionner' => 'required',

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
}