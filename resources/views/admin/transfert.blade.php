@extends('template')

@section('content')
<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                   
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Transferer des produits
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Transfert poduit</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                
                                <form method="POST" action="" id="formProduct">
                                    @csrf
                                    
                                    <div class="mb-2">
                                        <label for="ref_prod" class="form-label">Code Article</label>
                                        <select class="form-select" id="ref_prod" name="ref_prod" required>
                                            <option value="valeur1">Option 1</option>
                                            <option value="valeur2">Option 2</option>
                                            <!-- Ajoutez d'autres options si nécessaire -->
                                        </select>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <label for="bon_de_transfert" class="form-label">Bon de transfert</label>
                                        <input type="text" class="form-control" id="bon_de_transfert" name="bon_de_transfert" required>
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
                                        <label for="quantite_demender" class="form-label">Quantité démandée</label>
                                        <input type="text" class="form-control" id="quantite_demender" name="quantite_demender" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="quantite_approuver" class="form-label">Quantité Approuvée</label>
                                        <input type="text" class="form-control" id="quantite_approuver" name="quantite_approuver" required>
                                    </div>
    
                                    <div class="mb-2">
                                        <label for="demandeur" class="form-label">Demandeur</label>
                                        <input type="text" class="form-control" id="demandeur" name="demandeur" required>
                                    </div>
    
                                    <div class="mb-2">
                                        <label for="approvisisionneur" class="form-label">Approvisioneur</label>
                                        <input type="text" class="form-control" id="approvisisionneur" name="approvisisionneur" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="submitFormProduit" class="btn btn-outline-primary">
                                            Enregistrer
                                        </button>
                                    </div>
                                </form>

                            </div>
                                 
                        </div>
                        </div>
                    </div>
                            
                </div>
                <div >
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
                                      <a href="#" class="btn btn-info "><i class="la la-pencil"></i></a>
                                      <a href="#" class="las la-delet btn btn-danger"><i class="la la-trash-alt"></i></a>
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

@push('js')
<script type="text/javascript">
    var table;
      
        var i = 1;
        $("document").ready(function(){
            
            table = $("#liste").DataTable({
                "ajax": {
                    "url" : '{{ route("liste_entrer") }}',
                    "dataSrc": ''
                },
                "order": [[ 0, "desc" ]], //or asc 
                "columnDefs" : [
                    {"targets":0, "type":"date-euro"},
                    {"targets":2, "type":"date-uk"},
                    {"targets":5, "type":"date-uk"}
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                },
                "columns" : [
                    {data:"bon_de_transfert"},
                    {data:"quantite_demender"},      
                    {data:"quantite_approuver"},
                    {data:"demandeur"},
                    {data:"approvisisionneur"},
                    {data:"date_transfert"},
                ]
            })
        });
        $("table").on('click','.add', function(){
            $(this).parents('tbody').append('<tr><td><select name="produit" id="produit" class="form-select">'+prod+'</select></td><td><select name="unite" id="unite" class="form-select"></select></td><td><input type="text" name="qte" id="qte" class="form-control"></td><td><button type="button" class="btn btn-outline-secondary delete"><i class="las la-trash"></i></button></td></tr>');
            i++;
        });
        $("table").on('click', '.delete', function(){
            $(this).parents('tr').remove();
            i--;
        });
     
</script>
@endpush