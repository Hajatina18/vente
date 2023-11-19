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
        public function addDepot(Request $request)
        {
            $newDepot = depot::create($request->all());
            try {
                $newDepot = depot::create($request->all());
                return back();
            } catch(Exception $e) { 
                return response()->json($e->getMessage()); 
            }
           
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