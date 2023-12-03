<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depot;
use App\Models\Fournisseur;
use App\Models\Produit;
use DateTime;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        $produits = Produit::all();
        return view('admin.depot',  compact('fournisseurs', 'produits'));
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

    public function destroy($id_depot)
    {
        $depot = Depot::find($id_depot);
        $depot->delete();
        return redirect()->route('admin.listedepot')
            ->with('success', 'Depot bien supprimer');
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
            $depot->action = "<a href='#' class='badge bg-primary p-2 ms-2' onclick=\"getProduit('" . $depot->id_depot . "')\">Modifier</a><a href='javascript:void(0)' class='badge bg-danger p-2 ms-2 delete_depot' data-id='" . $depot->id_depot . "'>Supprimer</a>";
        }
        echo json_encode($depots);
    }
}
