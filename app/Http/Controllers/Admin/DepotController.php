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