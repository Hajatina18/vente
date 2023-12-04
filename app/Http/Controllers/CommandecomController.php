<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;

class CommandecomController extends Controller
{
    public function index()
    {
        // Votre logique de contrôleur ici
        
        return view("commandecom");
    } 
}

