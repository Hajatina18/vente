
 @extends('template')

@section('content')

 <div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-2 col-lg-12">
                    <!-- start modal -->
                    <!-- Button trigger modal -->

                    <div class="d-flex justify-content-between mb-2"> 
                        <form class="d-flex ">
                            <input type="search" class="form-control me-3" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <div >
                            <button type="button " class="btn btn-info " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <a href="#" class="btn btn-info">Ajouter en stock</a>
                            </button>
                        </div>

                    </div>
                    
                    <!-- Start add stock -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajout Stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- start modal -->
                            <form action="('DepotController')" method="POST" action="" id="formProduct">
                            <div class="modal-body">
                            
                                @csrf
                                <h4 class="text-center">Formulaire Depot</h4>
                                <div class="mb-2">
                                    <label for="ref_prod" class="form-label">Réference du stock</label>
                                    <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                                </div>
        
                                <div class="mb-2">
                                    <label for="ref_prod" class="form-label">Code Article</label>
                                    <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                                </div>
        
                                <div class="mb-2">
                                    <label for="ref_prod" class="form-label">Designation</label>
                                    <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                                </div>         
        
                                <div class="mb-2">
                                    <label for="ref_prod" class="form-label">Fournisseur</label>
                                    <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                                </div>
                                <div class="mb-2">
                                    <label for="ref_prod" class="form-label">Réference Fournisseur</label>
                                    <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                                </div>                        
        
                                <div class="mb-2">
                                    <label for="nom_prod" class="form-label">Prix d'Achat</label>
                                    <input type="text" class="form-control" id="nom_prod" name="nom_prod" required>
                                </div>
                                <div class="mb-3">
                                    <label for="image_prod" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="image_prod" name="image_prod">
                                </div>
                                <div class="card bg-white p-0 mb-2">
                                    <div class="card-header bg-white text-center">
                                        <h5 class="m-0">Unité du produit</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table" id="unite_mesure">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="30%">Unité</th>
                                                    <th width="30%">
                                                        Quantité
                                                        <i class="las la-question-circle" style="cursor: pointer"></i>
                                                    </th>
                                                    <th width="10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select class="form-select" id="unite" name="unite">
                                                          
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" id="prix" name="prix"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" id="qte" name="qte" required>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-secondary add">
                                                            <i class="las la-plus-circle"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <label for="" class="form-label me-3">Fait à la demande</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="fait_demande" value="true" id="demandeOui">
                                        <label class="form-check-label" for="demandeOui">
                                            Oui
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="fait_demande" value="false" id="demandeNon" checked>
                                        <label class="form-check-label" for="demandeNon">
                                            Non
                                        </label>
                                    </div>
                                </div>
                                                        
                        </div> 
                        </form>  

                            <!-- end modal -->
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" id="submitFormProduit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- end add -->
                    <!-- start table -->
                    <div class="my-3 p-3 bg-body rounded shadow-sm"> 
                     
                    <h6 class="border-bottom pb-2 mb-4">Liste des stock</h6>
                    <table class="table table-bordered table-hover mt-2">
                        <thead>
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Code Art</th>
                            <th scope="col">Désign</th>
                            <th scope="col">Réf BLF FRNS</th>
                            <th scope="col">Prix A HT</th>
                            <th scope="col">Prix A TTC</th>
                            <th scope="col">C.Revient</th>
                            <th scope="col">C.Trans</th>
                            <th scope="col">CUMP</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>Otto</td>
                            <td>
                                <a href="#" class="btn btn-info">Modifier</a>
                                <a href="#" class="btn btn-danger">Supprimer</a>
                            </td>
                          </tr>
                         
                        </tbody>
                      </table>
                    </div>
                      <!-- end table-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalModif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Modification d'un produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="formModifProd">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="modif_ref" class="form-label">Réference du produit</label>
                        <input type="text" class="form-control" id="modif_ref" name="ref_prod" readonly required>
                    </div>
                    <div class="mb-2">
                        <label for="modif_nom" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="modif_nom" name="nom_prod" required>
                    </div>
                    <div class="my-3">
                        <label for="" class="form-label me-3">Fait à la demande</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fait_demandeModif" value="true" id="demandeOuiModif">
                            <label class="form-check-label" for="demandeOuiModif">
                                Oui
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fait_demandeModif" value="false" id="demandeNomModif" checked>
                            <label class="form-check-label" for="demandeNomModif">
                                Non
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image_prod" class="form-label">Image</label>
                        <input class="form-control" type="file" id="modif_image" name="image_prod">
                    </div>
                    <div class="card bg-white p-0 mb-2">
                        <div class="card-header bg-white text-center">
                            <h5 class="m-0">Unité du produit</h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="modif_unite_mesure">
                                <thead>
                                    <tr class="text-center">
                                        <th width="40%">Unité</th>
                                        <th width="30%">Prix</th>
                                        <th width="30%">
                                            Quantité
                                            <i class="las la-question-circle" style="cursor: pointer"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div> 
@endsection 