@extends('template')

@section('content')
<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="border-solid rounded">
            <div class="row">
                <div class="col-12 col-md-12">

                    <!-- Button trigger modal -->
                    <div class="d-flex justify-content-between align-items-center">
                    

                        <div class="m-3"> <!-- Bouton Ajout transfert -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <div class="navi">
                                    <a class="navi-link" href="#">
                                        <span class="navi-icon"><i class="la la-share-alt mx-1 text-white"></i></span>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Transfert des produits</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="" id="formTransfert" class="row">
                                        @csrf
                                        <div class="row px-5">
                                            <label for="id_approvisionneur" class="form-label " style="font-weight:bold">Approvisionneur </label>
                                            <div class="col-md-6">

                                                <label for="id_approvisionneur" class="form-label">Dépôts </label>
                                                <select class="form-select" id="id_approvisionneur" name="id_approvisionneur">
                                                    <option default disabled>Choix de Dépôt</option>
                                                    @foreach ($depots as $depot)
                                                        @foreach ($depot->principale as $principale)
                                                            <option value="{{$principale->id_depot }}">{{ $depot->nom_depot }}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                        <div class="row px-5 mt-3">
                                            <label for="id_demandeur" class="form-label " style="font-weight:bold">Demandeur </label>
                                            <div class="col-md-6">
                                                <label for="id_demandeur" class="form-label">Dépôt</label>
                                                <select class="form-select" id="id_demandeur" name="id_demandeur">
                                                    <option default disabled>Choix de Dépôt</option>
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

                                        <div class="row px-5 mt-3">
                                            <div class="col-md-6">
                                                <label for="ref_prod" class="form-label">Date de transfert</label>

                                                <input type="date" class="form-control" name="date_transfert" id="date_transfert">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="ref_prod" class="form-label">Bon de transfert</label>
                                                <input type="text" class="form-control" name="bon_de_transfert" id="bon_de_transfert">
                                            </div>
                                         <div>
                                                <div class="row px-5 mt-3">
                                                    <label for="produits" class="form-label " style="font-weight:bold">Les produits en stock </label>

                                                    <table class="table table-striped table-hover" id="produits">
                                                        <thead>
                                                            <th width="50%">Produit</th>
                                                            <th width="25%">Unite</th>
                                                            <th width="20%">Qte</th>
                                                            <th width="5%"></th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <select name="produit" id="produit" class="form-select">
                                                                        <option value=""></option>
                                                                        @foreach ($produits as $produit)
                                                                        <option value="{{ $produit->ref_prod }}">{{ $produit->nom_prod }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="unite" id="unite" class="form-select">

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="qte" id="qte" class="form-control">
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
                
            </div>
            <div>
                <h4 class="text-center">Journal des transferts</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="liste">
                        <thead>
                            <th>Bon de transfert</th>
                            <th>Produit</th>
                            <th>Approvisionneur </th>
                            <th>Demandeur </th>
                            <th>Date de transfert</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
    var prod = "<option></option>";
    @foreach($produits as $produit)
    prod += '<option value="{{ $produit->ref_prod }}">{{ $produit->nom_prod }}</option>';
    @endforeach

    var i = 1;
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
    $("document").ready(function() {

        table = $("#liste").DataTable({
            "ajax": {
                "url": '{{ route("liste_transfert") }}',
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
                    data: "panier"
                },

                {
                    data: "date_transfert"
                },
                {
                    data: "approvisisionneur"
                },
                {
                    data: "demandeur"
                },
                {
                    data: "created_at"
                }
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
    $("#formTransfert").on('submit', function() {
        var form = $(this);

        $.ajax({
            url: '{{ route("add_transfert") }}',
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#loader').removeClass('hidden')
            },
            complete: function() {
                $('#loader', addClass('hidden'))
            },
            success: function(response) {
                $("#formTransfert")[0].reset();
                $('#exampleModal').modal('hide');
                Swal.fire({
                    icon: response.icon,
                    text: response.text
                });
                table.ajax.reload();
            }
        });


    });
    $("#produits").on('change', '#produit', function() {
                var produit = $(this);
                if (produit.val()) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('getUnite') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            ref_prod: produit.val()
                        },
                        beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        complete: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').addClass('hidden')
                        },
                        dataType: "json",
                        success: function(response) {
                            var unite = "<option></option>";
                            response.forEach(element => {
                                unite += "<option value='" + element.id_unite + "'>" + element
                                    .unite + "</option>";
                            });
                            produit.parents('tr').find('#unite').html(unite);
                        }
                    });
                }
            })
</script>
@endpush