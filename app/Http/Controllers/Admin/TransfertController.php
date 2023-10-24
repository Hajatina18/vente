<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DateTime;

class TransfertController extends Controller
{
    public function index()
    {
        return view ("admin.transfert");
    }
}