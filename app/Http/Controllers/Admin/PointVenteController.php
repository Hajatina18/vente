<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointVente;
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
