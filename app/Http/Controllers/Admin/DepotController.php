<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\depot;
use App\Models\Fournisseur;
use App\Models\Produit;
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
        public function store()
        {
            $request ->validate([
                'nom' => 'required|max:200',
                'localisation' => 'required',
            ]);
            Post::create($request->all());
            return redirect()->route('admin.listedepot')
            ->with('success', 'Depot creer avec succes');
        }
        public function update(Request $request, $id)
        {
            $request-> validate([
                'nom' => 'required',
                'localisation'=> 'required',
            ]);
            $depot = Depot::find($id_depot);
            $depot->update($request->all());
            return redirect()->route('admin.listedepot')
            ->with('success', 'Depot modifier succes !');
        }

        public function destroy($id_depot)
        {
            $depot = Depot::find($id_depot);
            $depot->delete();
            return redirect()->route('admin.listedepot')
            ->with('success','Depot bien supprimer');
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
            return view('admin.listedepot',compact('depot'));
        }
        // public function liste()
        // {
        //     $depots = depot::all();
        //     return view('admin.listedepot', ['depots' => $depots]);
          
        // }

        // public function create()
        // {
        //     return view('create_depot');
        // }

}