@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="border-solid rounded" >
                <div class="row">
                    <div class="col-12 col-md-12">

                        <!-- Button trigger modal -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div style="margin-right: 10px;" > <!-- Barre de recherche -->
                                <form action="" class="form-inline">
                                    <div class="input-group">
                                        <input type="search" class="form-control me-2" placeholder="Rechercher...">
                                        <button class="btn btn-primary" type="submit"><i class="la la-search"></i> 
                                        </button>
                                    </div>                                 
                                </form>
                            </div>
                    
                            <div class="ms-3"> <!-- Bouton Ajout transfert -->
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="navi"> 
                                        <a class="navi-link" href="#">
                                            <span class="navi-icon"><i class="la la-share-alt mx-1"></i></span>
                                            <span class="navi-text">Transferer des produits </span>
                                        </a>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg mx-auto"> <!-- Ajout de la classe mx-auto pour centrer -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Transfert poduit</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="POST" action="" id="formProduct" class="row g-3">
                                            @csrf
                                            <div class="row px-5">
                                                
                                            </div>
                                            <div class="row px-5">
                                                <div class="col-md-5">
                                                    <label for="ref_prod" class="form-label">nom de produit</label>
                                               

                                                        <select class="form-select" id="ref_prod" name="ref_prod">
                                                    @foreach ($produits as $produit)
                                                    <option value="{{ $produit->ref_prod }}">{{ $produit->nom_prod }}</option>
                                                    @endforeach
                                                </select>
                                                </div>                                                                                       
                                               
                                                <div class="col-md-5">
                                                    <label for="quantite_demender" class="form-label">Quantité démandée</label>
                                                    <input type="text" class="form-control" id="quantite_demender"
                                                        name="quantité" required>
                                                </div>                                                                     
                                                
                                          
                                            </div>
                                            <div class="row px-5 py-3">
                                                <div class="col-md-5">
                                                <input type="checkbox" checked data-toggle="toggle" data-size="normal" onclick="toggleOn()>
                                             <label for="">Transfert entre Dépôt</label>
                                                </div>                                                                     
                                                
                                            </div>

                                            <div class="row px-5">
                                                <div class="col-md-5">
                                                    <label for="id_depot" class="form-label">Dépôt</label>
                                                    <select class="form-select" id="id_depot" name="id_depot">
                                                    <option  default disabled>Choix de Dépôt</option>
                                                    @foreach ($depots as $depot)
        
                                                    <option value="{{ $depot->id_depot }}">{{ $depot->nom_depot }}</option>
                                                    @endforeach
                                                </select>
                                                </div>                                   
                                                <div class="col-md-5">
                                                    <label for="id_pdv" class="form-label">Point de Vente</label>
                                                    <select class="form-select" id="ref_prod" name="ref_prod">
                                                        <option value="" disabled>Choix de point de Vente</option>
                                                    @foreach ($pointVente as $points)
                                                    <option value="{{ $points->id_pdv }}">{{ $points->nom_pdv }}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" id="submitFormProduit" class="btn btn-outline-primary">Enregistrer</button>
                                    </div>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div>
                    <h4 class="text-center">Journal des transferts</h4>
                    <div class="table-responsive">
                        <table class="table table-striped" id="liste">
                            <thead>
                                <th>Code Art</th>
                                <th>Bon de transfert</th>
                                <th>Designation</th>
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
                                        <a href="#" class="las la-delet btn btn-danger"><i
                                                class="la la-trash-alt"></i></a>
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
                    <h5 class="modal-title text-center" id="exampleModalLabel">Modification d'un transfert</h5>
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
        $("document").ready(function() {

            table = $("#liste").DataTable({
                "ajax": {
                    "url": '{{ route('liste_entrer') }}',
                    "dataSrc": ''
                },
                "order": [
                    [0, "desc"]
                ], //or asc 
                "columnDefs": [{
                        "targets": 0,
                        "type": "date-euro"
                    },
                    {
                        "targets": 2,
                        "type": "date-uk"
                    },
                    {
                        "targets": 5,
                        "type": "date-uk"
                    }
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                },
                "columns": [{
                        data: "bon_de_transfert"
                    },
                    {
                        data: "quantite_demender"
                    },
                    {
                        data: "quantite_approuver"
                    },
                    {
                        data: "demandeur"
                    },
                    {
                        data: "approvisisionneur"
                    },
                    {
                        data: "date_transfert"
                    },
                ]
            })
        });
        $("table").on('click', '.add', function() {
            $(this).parents('tbody').append('<tr><td><select name="produit" id="produit" class="form-select">' +
                prod +
                '</select></td><td><select name="unite" id="unite" class="form-select"></select></td><td><input type="text" name="qte" id="qte" class="form-control"></td><td><button type="button" class="btn btn-outline-secondary delete"><i class="las la-trash"></i></button></td></tr>'
            );
            i++;
        });
        $("table").on('click', '.delete', function() {
            $(this).parents('tr').remove();
            i--;
        });
        function toggleOn() {
    $('#toggle-trigger').bootstrapToggle('on')
  }
    </script>
@endpush
