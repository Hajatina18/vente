<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class DepotSecondController extends Controller
{
    public function index()
    {
        return view
        ('admin.depotSecond');
    }
}