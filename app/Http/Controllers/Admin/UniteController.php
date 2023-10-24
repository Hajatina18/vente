<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UniteMesure;
use Illuminate\Http\Request;

class UniteController extends Controller
{
    public function index()
    {
        return view('admin.unite');
    }
    public function create(Request $request)
    {
        if($request->id_unite != NULL){
            $unite = UniteMesure::find($request->id_unite);
        }else{
            $unite = new UniteMesure;
        }
        $unite->unite = $request->unite;
        if($unite->save()){
            $array = array(
                'icon' => "success",
                'text' => "Enregistrement effectué"
            );
        }else{
            $array = array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            );
        }
        echo json_encode($array);
    }
    public function liste()
    {
        $unites = UniteMesure::all();
        foreach ($unites as $unite) {
            $unite->action = "<a href='javascript:void(0)' class='badge bg-primary p-2 edit' data-id='".$unite->id_unite."'>Modifier</a><a href='javascript:void(0)' class='badge bg-danger p-2 ms-2 delete_unite' data-id='".$unite->id_unite."'>Supprimer</a>";
        }
        echo json_encode($unites);
    }
    public function delete(Request $request)
    {
        if(UniteMesure::destroy($request->id)){
            $output = array(
                'icon' => 'success',
                'text' => "Unité de mesure supprimée"
            );
        }else{
            $output = array(
                'icon' => 'warning',
                'text' => "Il y a une erreur durant la suppression"
            );
        }
        echo json_encode($output);
    }
}
