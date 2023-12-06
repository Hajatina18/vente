<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointVente;
use App\Models\User;
use Illuminate\Http\Request;

class PointVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    $users= User::all()->whereNotIn('id', $caissier)->where('is_admin',0);
        return view('admin.liste-point-vente');
    }

 
    public function store(Request $request)
    {
        if($request->id_pdv != NULL){
            $pointVente = PointVente::find($request->id_pdv);
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
            $pointvente->action = "`<a href='#' class='badge bg-primary p-2 ms-2 ' onclick=\"getPoint('".$pointvente->id_pdv."')\">Modifier</a>
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
