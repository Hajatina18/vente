<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DateTime;
// use App\Models\Depot;

class DepotController extends Controller
{ 
        public function index()
        {
            // $depots = depot::orderBy("nom","asc")->paginate(8);
            return view('admin.depot');
        }

        // public function create()
        // {
        //     return view('create_depot');
        // }

}