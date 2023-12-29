<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChiffreAffaireController extends Controller
{
    public function index(){
        
        return view('admin.chiffre_affaire');
    }
}
