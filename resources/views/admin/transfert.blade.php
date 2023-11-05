@extends('template')

@section('content')
<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                    <form method="POST" action="" id="formProduct">
                        @csrf
                        <h4 class="text-center">Transfert poduit</h4>
                        <div class="mb-2">
                            <label for="ref_prod" class="form-label">Code Article</label>
                            <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                        </div>
                        <div class="mb-2">
                            <label for="ref_prod" class="form-label">Bon de transfert</label>
                            <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                        </div>                        
                        <div class="mb-2">
                            <label for="ref_prod" class="form-label">Réference du produit</label>
                            <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                        </div>
                        <div class="mb-2">
                            <label for="nom_prod" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="nom_prod" name="nom_prod" required>
                        </div>
                        <div class="mb-2">
                            <label for="nom_prod" class="form-label">Quantité démandée</label>
                            <input type="text" class="form-control" id="nom_prod" name="nom_prod" required>
                        </div>
                        <div class="mb-2">
                            <label for="nom_prod" class="form-label">Quantité Approuvée</label>
                            <input type="text" class="form-control" id="nom_prod" name="nom_prod" required>
                        </div>

                        <div class="mb-2">
                            <label for="ref_prod" class="form-label">Demandeur</label>
                            <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                        </div>

                        <div class="mb-2">
                            <label for="ref_prod" class="form-label">Approvisioneur</label>
                            <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                        </div>
        
                        <button type="submit" id="submitFormProduit" class="btn btn-outline-primary">
                            Enregistrer
                        </button>
                    </form>
                </div>
                <div class="col-12 col-md-8 col-lg-8">
                    <h4 class="text-center">Journal des transferts</h4>
                    <div class="table-responsive">
                        <table class="table table-striped" id="liste">
                            <thead>
                                <th>Code Art</th>
                                <th>Bon de transfert</th>
                                <th >Designation</th>
                                <th>Quantité demandée</th>
                                <th>Quantité approuvée </th>
                                <th>Trans </th>
                                <th>Status </th>
                                <th>Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>BT0102/0002</td>
                                  <td>Fresh</td>
                                  <td>20</td>
                                  <td>20</td>
                                  <td>20</td>
                                  <td>En cours</td>
                                  <td>01-Nov-2023</td>                
                                  <td> 
                                      <a href="#" class="btn btn-info ">Modifier</a>
                                      <a href="#" class="las la-delet btn btn-danger">Supprimer</a>
                                  </td>
                                </tr>
                               
                              </tbody>
                        </table>
                    </div>
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
                        <label for="modif_nom" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="modif_nom" name="nom_prod" required>
                    </div>

                    <div class="mb-3">
                        <label for="image_prod" class="form-label">Image</label>
                        <input class="form-control" type="file" id="modif_image" name="image_prod">
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
