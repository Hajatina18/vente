<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModePaiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        return view('admin.paiement');
    }
    public function create(Request $request)
    {
        if($request->id_mode != NULL){
            $mode = ModePaiement::find($request->id_mode);
        }else{
            $mode = new ModePaiement;
        }
        $mode->mode_paiement = $request->mode_paiement;
        if($mode->save()){
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
        $modes = ModePaiement::all();
        foreach ($modes as $mode) {
            $mode->action = "<a href='javascript:void(0)' class='badge bg-primary p-2 edit' data-id='".$mode->id_mode."'>Modifier</a><a href='javascript:void(0)' class='badge bg-danger p-2 ms-2 delete_paiement' data-id='".$mode->id_mode."'>Supprimer</a>";
        }
        echo json_encode($modes);
    }
    public function delete(Request $request)
    {
        if(ModePaiement::destroy($request->id)){
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
