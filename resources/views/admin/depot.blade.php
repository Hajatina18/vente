@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="border-solid rounded">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <!-- start modal -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div style="margin-right: 10px;"> <!-- Barre de recherche -->
                                <form action="" class="form-inline">
                                    <div class="input-group">
                                        <input type="search" class="form-control me-2" placeholder="Rechercher...">
                                        <button class="btn btn-primary" type="submit"><i class="la la-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="d-flex">
                                <div class="ms-3"> <!-- Bouton depot1 -->
                                    <button type="button" class="btn btn-info " data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <a href="{{ route('depot_second') }}">
                                            <span class="navi-icon"><i class="la la-user mx-1"></i></span>
                                            <span class="navi-text">Dépôt 2</span>
                                        </a>
                                    </button>
                                </div>
                                <div class="ms-3"> <!-- Bouton Magasin -->
                                    <button type="button" class="btn btn-info " data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <a href="#">
                                            <span class="navi-icon"><i class="la la-user mx-1"></i></span>
                                            <span class="navi-text">Magasin</span>
                                        </a>
                                    </button>
                                </div>
                                <div class="ms-3"> <!-- Bouton Ajout nouveau depot -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <div class="navi">
                                            <a class="navi-link" href="{{ route('listedepot') }}">
                                                <span class="navi-icon"><i class="la la-list-ul text-withe"></i></span>
                                                <span class="navi-text">Ajout et listes </span>
                                            </a>
                                        </div>
                                    </button>
                                    {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <a href="{{ route('listedepot') }}" class="btn btn-info">Ajout nouveau depot</a>
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                        <!-- recherche entre deux date -->
                        <div class="d-flex justify-content-between align-items-center my-2">
                            <div class="col-md-5">
                                <form>
                                    <div class="container">
                                        <div class="row px-1">
                                            <div class="input-group col-md-12">
                                                <div class="form-group col-md-4">
                                                    <label for="startDate">Date de début :</label>
                                                    <input type="date" class="form-control" id="startDate">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="endDate">Date de fin :</label>
                                                    <input type="date" class="form-control" id="endDate">
                                                </div>
                                                <div class="col-md-4 my-4"> <!-- Espace entre les champs de date et le bouton -->
                                                    <button type="submit" class="btn btn-primary"><i class="la la-search"></i></button>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        
                        
                        <!-- fin  -->
                    </div>
                </div>

                <!-- end add -->
                <!-- start table -->
                <div class="my-1 p-2 bg-body rounded shadow-sm">

                    <h4 class="text-center">Dépôt principale</h4>
                    <table class="table table-striped" id="liste">
                        <thead>
                            <th>Code Art</th> <!-- new insert -->
                            <th>Réf Bl Frns</th> <!-- new insert -->
                            <th>Fournisseur</th>
                            <th>Date Facture</th>
                            <th>Numero Facture</th>
                            <th>Bon de Livraison</th>
                            <th>P A HT</th>
                            <th>P A TTC</th>
                            <th>C Trans</th>
                            <th>C Revient</th>
                            <th>CUMP</th>
                            <th>Date Echeance</th>
                            <th>Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div> <!-- end table -->
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail de l'entrer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <p class="m-0">Code Art : <span id="" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">PCB : <span id="" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Fournisseur : <span id="frnsModal" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Ref BL FRNS : <span id="" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Date d'enregistrement: <span id="dateModal"
                                    style="font-weight: 600"></span>
                            </p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Date facture : <span id="date_factureModal"
                                    style="font-weight: 600"></span>
                            </p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Numero Facture : <span id="num_factureModal"
                                    style="font-weight: 600"></span>
                            </p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Bon de livraison : <span id="num_blModal" style="font-weight: 600"></span>
                            </p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">P.A HT : <span id="" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">PA TTC : <span id="" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Coût Trans : <span id="num_blModal" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Date Echeance : <span id="date_echeanceModal"
                                    style="font-weight: 600"></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <hr style="height: 3px; width : 100%">
                            <h4 class="text-center">Liste des produits</h4>
                            <table class="table table-striped" id="listePaniers">
                                <thead>
                                    <th>Image</th>
                                    <th>Nom Produit</th>
                                    <th>Quantité</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
        </div>
    </div>

    <div class="modal fade" id="modalFrns" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Liste des fournisseurs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="listeFrns">
                        <thead>
                            <th>Nom</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($fournisseurs as $fournisseur)
                                <tr>
                                    <td>{{ $fournisseur->nom_frns }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary addFrns"
                                            data-nom="{{ $fournisseur->nom_frns }}">
                                            <i class="las la-plus-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        var table;
        var prod = "<option></option>";
        @foreach ($produits as $produit)
            prod += '<option value="{{ $produit->ref_prod }}">{{ $produit->nom_prod }}</option>';
        @endforeach
        var i = 1;
        $("document").ready(function() {
            $("#listeFrns").DataTable({
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                },
                info: false
            });
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
                        data: "code_art"
                    },
                    {
                        data: "reference_bl_frns"
                    },
                    {
                        data: "nom_frns"
                    },
                    {
                        data: "date_facture"
                    },
                    {
                        data: "num_facture"
                    },
                    {
                        data: "num_bl"
                    },
                    {
                        data: "prix_achat_ht"
                    },
                    {
                        data: "prix_achat_ttc"
                    },
                    {
                        data: "cout_trans"
                    },
                    {
                        data: "C Revient"
                    },
                    {
                        data: "CUMP"
                    } {
                        data: "date_echeance"
                    },
                    {
                        data: "action"
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
        $("#formEntrer").on('submit', function() {
            var form = $(this);
            var vide = false;
            $("#produits > tbody > tr").each(function() {
                if (!$(this).find("#produit").val() || !$(this).find("#unite").val() || !$(this).find(
                        "#qte").val()) {
                    vide = true;
                }
            });
            if (!vide) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('add_entrer') }}",
                    data: form.serialize(),
                    dataType: "json",
                    beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('#loader').removeClass('hidden');
                        $("#submitFormEntrer").prop("disabled", true);
                    },
                    complete: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('#loader').addClass('hidden');
                        $("#submitFormEntrer").prop("disabled", false);
                    },
                    success: function(response) {
                        if (response.icon) {
                            Swal.fire({
                                icon: response.icon,
                                text: response.text
                            });
                        } else {
                            var j = 0;
                            $("#produits > tbody > tr").each(function() {
                                var unite = $(this).find("#unite").val();
                                var qte = $(this).find("#qte").val();
                                var ref = $(this).find("#produit").val();
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('add_panier_entrer') }}",
                                    data: {
                                        id: response.id_entrer,
                                        _token: '{{ csrf_token() }}',
                                        unite: unite,
                                        ref_prod: ref,
                                        qte: qte
                                    },
                                    beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                        $('#loader').removeClass('hidden')
                                    },
                                    complete: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                        $('#loader').addClass('hidden')
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        j++;
                                        if (i == j) {
                                            $("#produits > tbody").html(
                                                '<tr><td><select name="produit" id="produit" class="form-select">' +
                                                prod +
                                                '</select></td><td><select name="unite" id="unite" class="form-select"></select></td><td><input type="text" name="qte" id="qte" class="form-control"></td><td><button type="button" class="btn btn-outline-secondary add"><i class="las la-plus-circle"></i></button></td></tr>'
                                            )
                                            $("#formEntrer")[0].reset();
                                            Swal.fire({
                                                icon: response.icon,
                                                text: response.text
                                            });
                                            table.ajax.reload();
                                        }
                                    }
                                });
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    text: "Veuillez renseigner les informations concernant le produit, comme le produit, l'unité ou le quantité"
                });
            }
            return false;
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

        function getDetail(id) {
            if (id) {
                $.ajax({
                    url: '{{ route('getDetail') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('#loader').removeClass('hidden')
                    },
                    complete: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('#loader').addClass('hidden')
                    },
                    dataType: 'json',
                    success: function(response) {
                        $("#modalDetail").find('#frnsModal').text(response.entrer.nom_frns);
                        $("#modalDetail").find('#dateModal').text(response.entrer.date);
                        $("#modalDetail").find('#date_factureModal').text(response.entrer.date_facture);
                        $("#modalDetail").find('#num_factureModal').text(response.entrer.num_facture);
                        $("#modalDetail").find('#num_blModal').text(response.entrer.num_bl);
                        $("#modalDetail").find('#date_echeanceModal').text(response.entrer.date_echeance);
                        $("#listePaniers > tbody").empty();
                        response.paniers.forEach(panier => {
                            $("#listePaniers > tbody").append(
                                "<tr><td><img src='{{ url('/') }}/" + panier.image_prod +
                                "' style='width: 60px'></td><td>" + panier.nom_prod + "</td><td>" +
                                panier.qte_entrer + " " + panier.unite + "</td></tr>");
                        });
                        $("#modalDetail").modal('show');
                    }
                });
            }
        }
        $(".addFrns").on('click', function() {
            $("#frns").val($(this).data('nom'));
            $("#modalFrns").modal('hide');
        })
    </script>
@endpush
