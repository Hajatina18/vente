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
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
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
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
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
                                                <label for="id_approvisionneur" class="form-label "
                                                    style="font-weight:bold">Approvisionneur </label>
                                                <div class="col-md-6">

                                                    <label for="id_approvisionneur" class="form-label">Dépôts </label>
                                                    <select class="form-select" id="id_approvisionneur"
                                                        name="id_approvisionneur">
                                                        <option default disabled>Choix de Dépôt</option>
                                                        @foreach ($depots as $depot)
                                                            @if ($depot->is_default == 1)
                                                                <option value="{{ $depot->id_depot }}">
                                                                    {{ $depot->nom_depot }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row px-5 mt-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="is_depot" name="is_depot">
                                                <label class="form-check-label" for="is_depot"></label>
                                              </div>
                                            </div>
                                            <div class="row px-5 mt-3">
                                                <label for="id_depot" class="form-label"
                                                    style="font-weight:bold">Demandeur </label>
                                                <div class="col-md-6" id="depotDiv">
                                                    <label for="id_depot" class="form-label">Dépôt</label>
                                                    <select class="form-select" id="id_depot" name="id_depot">
                                                        <option default disabled>Choix de Dépôt</option>
                                                        @foreach ($depots as $depot)
                                                            @if ($depot->is_default == 0)
                                                                <option value="{{ $depot->id_depot }}">
                                                                    {{ $depot->nom_depot }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5" id="pointVenteDiv">
                                                    <label for="id_pdv" class="form-label">Point de Vente</label>
                                                    <select class="form-select" id="id_pdv" name="id_pdv">
                                                        <option value="" disabled>Choix de point de Vente</option>
                                                        @foreach ($pointVente as $points)
                                                            <option value="{{ $points->id_pdv }}">{{ $points->nom_pdv }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row px-5 mt-3">
                                                <div class="col-md-6">
                                                    <label for="ref_prod" class="form-label">Date de transfert</label>

                                                    <input type="date" class="form-control" name="date_transfert"
                                                        id="date_transfert">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="ref_prod" class="form-label">Bon de transfert</label>
                                                    <input type="text" class="form-control" name="bon_de_transfert"
                                                        id="bon_de_transfert">
                                                </div>
                                                <div>
                                                    <div class="row px-5 mt-3">
                                                        <label for="produits" class="form-label "
                                                            style="font-weight:bold">Les produits en stock </label>

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
                                                                        <select name="produit" id="produit"
                                                                            class="form-select">
                                                                            <option value=""></option>
                                                                            @foreach ($produits as $produit)
                                                                                <option value="{{ $produit->ref_prod }}">
                                                                                    {{ $produit->nom_prod }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select name="unite" id="unite"
                                                                            class="form-select">

                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="qte"
                                                                            id="qte" class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary add">
                                                                            <i class="las la-plus-circle"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-danger"
                                                            data-bs-dismiss="modal">Annuler</button>
                                                        <button type="submit" id="submitFormTransfert"
                                                            class="btn btn-outline-primary">Enregistrer</button>
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
                    <div class="table-responsive ps-3 pe-4">
                        <table class="table table-striped" id="liste">
                            <thead>
                                <th>Bon de transfert</th>
                                <th width="30%">Produit</th>
                                <th>Demandeur </th>
                                <th>Approvisionneur </th>
                                <th>Date de transfert</th>
                                <th>Fait le</th>
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
                            <input tytransfert-pe="text" class="form-control" id="modif_nom" name="nom_prod" required>
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
                "url": '{{ route('liste_transfert') }}',
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
                        data: "produits",
                        render: function (data, type, row) {
                            if (type === 'display' && Array.isArray(data)) {
                    let panierHtml = '<ul style="margin-left:-20px" >';
                        const maxLines = 3;
                        for (let i = 0; i < Math.min(maxLines, data.length); i++) {
                            const produit = data[i];
                        panierHtml += '<li>' + produit.nom_prod + ' - ' + produit.qte_transfert + ' ' + produit.unite + '</li>';
                    };
                    if (data.length > maxLines) {
                        panierHtml += '<li>...</li>';
                    }
                    panierHtml += '</ul>';
                    return panierHtml;
                }
                return data;
            }
                    },
                {
                    data: "demandeur",
                    render: function (data, type, row) {
                            if (type === 'display' && Array.isArray(data)) {
                    let panierHtml = '<ul>';
                      
                        for (let i = 0; i <  data.length; i++) {
                            const produit = data[i];
                        panierHtml += '<li>' + produit.nom + '</li>';
                    };

                    panierHtml += '</ul>';
                    return panierHtml;
                }
                return data;
            }

                },
                {
                    data: "approvisionneur",
                    render: function (data, type, row) {
                            if (type === 'display' && Array.isArray(data)) {
                    let panierHtml = '<ul>';
                      
                        for (let i = 0; i <  data.length; i++) {
                            const produit = data[i];
                        panierHtml += produit.nom_depot;
                    };

                    panierHtml += '</ul>';
                    return panierHtml;
                }
                return data;
            }
                },
                {
                    data: "date_transfert"
                },
                {
                    data: "date"
                },
               
            ]
        });
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
                url: "{{ route('add_transferts') }}",
                data: form.serialize(),
                dataType: "json",
                beforeSend: function() { 
                    
                    $('#loader').removeClass('hidden');
                    $("#submitFormTransfert").prop("disabled", true);
                },
                complete: function() { 
                    
                    $('#loader').addClass('hidden');
                    $("#submitFormTransfert").prop("disabled", false);
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
                                url: "{{ route('add_panier_transfert') }}",
                                data: {
                                    id: response.id_transfert,
                                    _token: '{{ csrf_token() }}',
                                    unite: unite,
                                    ref_prod: ref,
                                    qte: qte,
                                    demandeur: response.id_demandeur,
                                    approvisionneur: response.id_approvisionneur,
                                    is_depot: response.is_depot    
                                },
                                beforeSend: function() { 
                                    $("#exampleModal").modal('hide');
                                    $('#loader').removeClass('hidden')
                                },
                                complete: function() { 
                                    $("#exampleModal").modal('hide');
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
                                        $("#formTransfert")[0].reset();
                                        $("#exampleModal").modal('hide');
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
                    table.ajax.reload();
                    $("#exampleModal").modal('hide');
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
    $("#produits").on('change', '#produit', '#id_approvisionneur', function() {
        var produit = $(this);
        var depot = $("#id_approvisionneur").val();

        if (produit.val()) {
            $.ajax({
                type: "POST",
                url: "{{ route('getUnite') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    ref_prod: produit.val()
                },
                beforeSend: function() { 
                    
                    $('#loader').removeClass('hidden')
                },
                complete: function() { 
                    
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
    });
    
    $("#produits").change( function() {
        var produit = $('#produit').val();
        var unite = $('#unite').val();
        var qte = $('#qte').val();
        var depot = $("#id_approvisionneur").val();
        if (produit && unite && qte && depot) {
            $.ajax({
                type: "POST",
                url: "{{ route('get_quantite') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    ref_prod: produit,
                    unite: unite,
                    qte: qte,
                    depot: depot
                },
                beforeSend: function() { 
                    $('#loader').removeClass('hidden')
                },
                complete: function() { 
                    $('#loader').addClass('hidden')
                },
                dataType: "json",
                success: function(response) {
                    if(response.icon === "error"){
                        $("#submitFormTransfert").prop("disabled", true);
                        Swal.fire({
                                icon: response.icon,
                                text: response.text
                            });
                    }
                    else{
                        $("#submitFormTransfert").prop("disabled", false);
                        Swal.fire({
                                icon: response.icon,
                                text: response.text
                            });
                    }

                    
                        
                }
            });
        }
    });
    

$("document").ready(function(){
    $("#depotDiv").show();
    $("#pointVenteDiv").hide();
    $(".form-check-label").text("Transfert vers un autre dépôt");
    $("#is_depot").change(function () {
            if (this.checked) {
                $("#depotDiv").hide();
                $("#pointVenteDiv").show();
                $(".form-check-label").text("Transfert vers un point de vente");
            } else {
                $("#depotDiv").show();
                $("#pointVenteDiv").hide();
                $(".form-check-label").text("Transfert vers un autre dépôt");
            }
    });
   
});


   

</script>
@endpush
