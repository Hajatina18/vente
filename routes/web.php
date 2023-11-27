<?php

use App\Http\Controllers\Admin\CommandeController as AdminCommandeController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\EntrerController;
use App\Http\Controllers\Admin\PaiementController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\UniteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepotController;
use App\Http\Controllers\Admin\TransfertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FondCaisseController;
use App\Http\Controllers\PreCommandeController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/add_stock', [BalanceController::class, 'addStock'])->name('add_stock_week');
Route::group(['middleware' => ["auth"]], function(){
    Route::group(['prefix' => "entrer"], function(){
        Route::get('/', [EntrerController::class, 'index'])->name('entrer_admin');
        Route::get('/liste', [EntrerController::class, 'liste'])->name('liste_entrer');
       Route::get('/liste-second', [EntrerController::class, 'listeSecond'])->name('liste_entrer_second');
        Route::post('/', [EntrerController::class, 'addEntrer'])->name('add_entrer');
        Route::post('/add_panier', [EntrerController::class, 'add_panier'])->name('add_panier_entrer');
        Route::post('/get_unite', [EntrerController::class, 'getUnite'])->name('getUnite');
        Route::post('/get_detail', [EntrerController::class, 'getDetail'])->name('getDetail');
    });
});
Route::group(['middleware' => ['vente:0']], function(){
    Route::get('/{id?}', [CommandeController::class, 'index'])->where("id", '[0-9]+')->name('commande');
    Route::get('/getProduit', [CommandeController::class, 'getProduit'])->name('getProduit');
    Route::post('/', [CommandeController::class, 'searchProduct'])->name('search_product');
    Route::post('/commande', [CommandeController::class, 'save_commande'])->name('save_commande');
    Route::post('/add_panier', [CommandeController::class, 'add_panier'])->name('add_panier');
    Route::get('/ticket', [CommandeController::class, 'ticket'])->name('ticket');
    Route::get('/facture', [CommandeController::class, 'facture'])->name('facture');
    Route::post('/verify-stock', [CommandeController::class, 'stock'])->name('verify-stock');
    Route::post('/getDetail', [CommandeController::class, 'getDetail'])->name('getDetail_commande');
    Route::get('/caisse', [CommandeController::class, 'caisse'])->name('caisse');
    Route::get('/getClient', [CommandeController::class, 'getClient'])->name('getClient_commande');

    Route::group(["prefix" => "precommande", "as" => "precommande."], function(){
        Route::get("/", [PreCommandeController::class, "index"])->name("index");
        Route::post("/", [PreCommandeController::class, "save"])->name("save");
        Route::post("/add_prepanier", [PreCommandeController::class, "panier"])->name("panier");
        Route::post('update_panier', [PreCommandeController::class, "updatePanier"])->name("updatePanier");
        Route::post('delete', [PreCommandeController::class, "delete"])->name("delete");
        Route::post('deletePanier', [PreCommandeController::class, "deletePanier"])->name("deletePanier");
        Route::post('transfert', [PreCommandeController::class, "transfert"])->name("transfert_commande");
    });
});

Route::get('/login', [AuthController::class, "index"])->name('login');
Route::post('/login', [AuthController::class, "check_login"])->name('check_login');
Route::get('/logout', function(){
    Auth::logout();
    return redirect(route('login'));
})->middleware(['auth'])->name('logout');
Route::group(['middleware' => ['vente:1'], 'prefix' => "admin"], function(){
    Route::get('/', [Dashboard::class, 'index'])->name("admin");
    Route::group(['prefix' => 'unite'], function(){
        Route::get('/', [UniteController::class, 'index'])->name('unite_admin');
        Route::post('/', [UniteController::class, 'create'])->name('add_unite');
        Route::post('/delete', [UniteController::class, 'delete'])->name('delete_unite');
        Route::get('/liste', [UniteController::class, 'liste'])->name('liste_unite');
    });
    Route::group(['prefix' => 'paiement'], function(){
        Route::get('/', [PaiementController::class, 'index'])->name('paiement_admin');
        Route::post('/', [PaiementController::class, 'create'])->name('add_paiement');
        Route::post('/delete', [PaiementController::class, 'delete'])->name('delete_paiement');
        Route::get('/liste', [PaiementController::class, 'liste'])->name('liste_paiement');
    });
    Route::group(['prefix' => "produit"], function(){
        Route::get('/', [ProduitController::class, 'index'])->name('produit_admin');
        Route::get('/liste', [ProduitController::class, 'liste'])->name('liste_produit');
        Route::post('/', [ProduitController::class, 'addProduct'])->name('add_produit');
        Route::post('/add_unite', [ProduitController::class, 'add_unite'])->name('set_unite_produit');
        Route::post('/update_unite', [ProduitController::class, 'update_unite'])->name('update_unite_produit');
        Route::post('/get', [ProduitController::class, 'getProduit'])->name('getProduct');
        Route::post('/update', [ProduitController::class, 'update'])->name('update_produit');
    });
    // Route::get('/', [DepotController::class, 'index'])->name('depot_admin');
    Route::group(['prefix' => 'depots'],function (){
        Route::get('/',[DepotController::class, 'index'])->name('depot_admin');
        Route::get('/second',[DepotController::class, 'indexSecond'])->name('depot_second');
        Route::get('/third',[DepotController::class, 'indexThird'])->name('depot_third');
        Route::get('/liste',[DepotController::class, 'liste'])->name('listedepot');
        Route::post('/',[DepotController::class, 'addDepot'])->name('addepot_admin');
        Route::get('/create',[DepotController::class, 'create'])->name('create_depot');
    });

    Route::group(['prefix' => 'depotSecond'],function (){
        Route::get('/',[DepotSecondController::class, 'index'])->name('depotSecond_admin');
        
    });

    Route::group(['prefix' => 'transfert'],function (){
        Route::get('/',[TransfertController::class, 'index'])->name('transfert_admin');
    });
    // Route::get('/',function (){
    //     return view'/admin' ('stock');
    // });
    Route::group(['prefix' => 'commande'], function (){
        Route::get('/', [AdminCommandeController::class, 'index'])->name('commande_admin');
        Route::get('/liste', [AdminCommandeController::class, 'liste'])->name('liste_commande_admin');
        Route::post('/getDetail', [AdminCommandeController::class, 'getDetail'])->name('admin_getDetail_commande');
    });
    Route::group(['prefix' => 'balance'], function(){
        Route::get("/", [BalanceController::class, 'index'])->name('balance');
        Route::get("/getWeek/{week?}", [BalanceController::class, 'getWeek'])->name('getWeek');
    });
    
    Route::group(['prefix' => 'fond_caisse'], function(){
        Route::get('/', [FondCaisseController::class, 'index'])->name('fond_caisse');
        Route::post('/', [FondCaisseController::class, 'create'])->name('add_fond');
        Route::get('/liste', [FondCaisseController::class, 'liste'])->name('liste_fond');
        Route::post('/delete', [FondCaisseController::class, 'delete'])->name('delete_fond');
    });
    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [UserController::class, 'index'])->name('user_admin');
        Route::get('/liste', [UserController::class, 'liste'])->name('liste_users');
        Route::post('/', [UserController::class, 'create'])->name('add_user');
        Route::post('/delete', [UserController::class, 'delete'])->name('delete_user');
    });
    Route::get('/config', [ConfigController::class, 'index'])->name('config');
    Route::post('/config_add', [ConfigController::class, 'create'])->name("add_config");
});
