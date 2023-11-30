<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depot;
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;
use DateTime;


class DepotController extends Controller
{ 
        public function index()
        {
            $frns = Fournisseur::all();
            $produits = Produit::where('fait_demande', true)->get();
            return view('admin.depot', ['produits' => $produits, 'fournisseurs' => $frns]);
           
        }
        public function indexSecond()
        {
            $frns = Fournisseur::all();
            $produits = Produit::where('fait_demande', true)->get();
            return view('admin.depotsecond', ['produits' => $produits, 'fournisseurs' => $frns]);
           
        }
        public function indexThird()
        {
            $frns = Fournisseur::all();
            $produits = Produit::where('fait_demande', true)->get();
            return view('admin.depotthird', ['produits' => $produits, 'fournisseurs' => $frns]);
           
        }
        public function store(Request $request)
        {
           
            if($request->id_depot != NULL){
                $depot = Depot::find($request->id_depot);
            }else{
                $depot = new Depot;
            }
            $depot->nom_depot = $request->nom_depot;
            $depot->localisation = $request->localisation;
            $depot->is_default = $request->is_default;
            if($depot->save()){
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
            $depots = Depot::all();
            return view('admin.listedepot', ['depots' => $depots]);
        }



}