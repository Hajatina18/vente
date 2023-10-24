<?php

namespace App\Http\Controllers;

use App\Models\FondCaisse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FondCaisseController extends Controller
{
    public function index()
    {
        return view('pages.fond');
    }

    public function create(Request $request)
    {
        if($request->id_fond != NULL){
            $fond = FondCaisse::find($request->id_fond);
        }else{
            $fond = new FondCaisse;
        }
        $fond->montant = $request->montant;
        if($fond->save()){
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
        $fonds = FondCaisse::where(DB::raw('date(created_at)'), date('Y-m-d'))->get();
        foreach ($fonds as $fond) {
            //$fond->action = "<a href='javascript:void(0)' class='badge bg-danger p-2 ms-2 delete_fond' data-id='".$fond->id_fond."'>Supprimer</a>";
            $fond->montant = number_format($fond->montant, 2, ',', ' ').' Ar';
        }
        echo json_encode($fonds);
    }

    public function delete(Request $request)
    {
        if(FondCaisse::destroy($request->id)){
            $output = array(
                'icon' => 'success',
                'text' => "Fond de caisse supprimée"
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
