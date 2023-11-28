<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\depot;
use DateTime;


class DepotController extends Controller
{ 
        public function index()
        {
            // $depots = depot::orderBy("nom","asc")->paginate(8);
            return view('admin.depot');
        }
        // public function addDepot(Request $request)
        // {
        //     $newDepot = depot::create($request->all());
        //     try {
        //         $newDepot = depot::create($request->all());
        //         return back();
        //     } catch(Exception $e) { 
        //         return response()->json($e->getMessage()); 
        //     }
           
        // }
        public function create(Request $request)
        {
            if($request->id_depot != NULL){
                $depot = Depot::find($request->id_depot);
            }else{
                $depot = new Depot;
            }
            $depot->depots = $request->depots;
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
            $depots = depot::all();
            return view('admin.listedepot', ['depots' => $depots]);
          
        }

        // public function create()
        // {
        //     return view('create_depot');
        // }

}