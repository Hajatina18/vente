<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depot;
use App\Models\PointVente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $pointVente = PointVente::all();
        $depots = Depot::all();

        return view('admin.users',compact('pointVente','depots'));
    }

    public function liste(Request $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->is_admin = ($user->is_admin == 1) ? "Administrateur" : "Vendeur(se)";
            $user->action = "<a href='javascript:void(0)' class='badge bg-primary p-2 edit' data-id='".$user->id."'>Modifier</a><a href='javascript:void(0)' class='badge bg-danger p-2 ms-2 delete_user' data-id='".$user->id."'>Supprimer</a>";
        }
        echo json_encode($users);
    }
    public function create(Request $request)
    {
        
        if($request->id_user != NULL){
            $user = User::find($request->id_user);
            if(($request->password != "") || ($request->password != NULL)){
                $user->password = Hash::make($request->password);
            }
        }else{
            $user = new User;
            $user->password = Hash::make($request->password);
        }
        $user->nom = $request->nom;
        $user->is_admin = $request->is_admin;
        $user->username = $request->username;

        $caisse =$request->caisse;

        if($request->is_admin==0){

            $user->id_pdv= $caisse =="magasin"? $request->id_pdv : NULL;
            $user->id_depot= $caisse =="depot"? $request->id_depot : NULL;
        }

        if($user->save()){
            $array = array(
                'icon' => "success",
                'text' => "Enregistrement effectué"
            );
        }else{
            $array = array(
                'icon' => "error",
                'text' => "Il existe un erreur interne, Veillez contacter l'administrateur"
            );
        }
        echo json_encode($array);
    }
    
    public function delete(Request $request)
    {
        if(User::destroy($request->id)){
            $output = array(
                'icon' => 'success',
                'text' => "Utilisateur supprimé"
            );
        }else{
            $output = array(
                'icon' => 'warning',
                'text' => "Il y a une erreur durant la suppression"
            );
        }
        echo json_encode($output);
    }
}
