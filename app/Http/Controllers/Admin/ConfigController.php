<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magasin;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Magasin::find(1);
        return view('admin.config',array('config' => $config));
    }

    public function create(Request $request)
    {
        if($request->file('image_prod') != null){
            $image = $request->file('image_prod')->getClientOriginalName();
            $path = $request->file('image_prod')->storeAs('produit', $image, 'public');
            $image_final = 'storage/produit/'.$image;
        }
        $config = (Magasin::find(1) != null ? Magasin::find(1) : new Magasin);
        $config->nom_magasin = $request->nom;
        $config->adresse_magasin = $request->adresse;
        $config->description_magasin = $request->description;
        $config->telephone = $request->telephone;
        $config->email = $request->email;
        $config->nif = $request->nif;
        $config->stat = $request->stat;
        if($request->file('logo') != null){
            $image = $request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('magasin', $image, 'public');
            $image_final = 'storage/magasin/'.$image;
            $config->logo = $image_final;
        }
        $config->rcs = $request->rcs;
        $config->save();
        return redirect(route('config'));
    }
}
