@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="border border-solid rounded">
            
            <form method="POST" id="formEntrer" class="row g-3">

                @csrf
                <h4 class="text-center">Formulaire Entrée</h4>
                <div class="row px-5  ">
                    <div class="col-md-5">
                        <label for="date_facture" class="form-label">Code Article</label> <!-- new insert -->
                        <input type="text" class="form-control form-control-sm" id="code_art" name="code_art">
                    </div>

                    <div class="col-md-5">
                        <label for="ref_prod" class="form-label">Fournisseur</label>
                        <div class="d-flex align-items-center justify-content-between">
                            <input type="text" class="form-control form-control-sm" id="frns" name="frns">
                            <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal"
                                data-bs-target="#modalFrns"><i class="las la-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row px-5 ">
                    <div class="col-md-5">
                        <label for="reference_bl_frns" class="form-label">Réf bon de Livraison
                            Fournisseurs</label>
                        <input type="text" class="form-control form-control-sm" id="reference_bl_frns"
                            name="reference_bl_frns">
                    </div>
                    <div class="col-md-5">
                        <label for="date_facture" class="form-label">Date Facture</label>
                        <input type="date" class="form-control form-control-sm" id="date_facture" name="date_facture">
                    </div>
                </div>
                <div class="row px-5 ">
                    <div class="col-md-5">
                        <label for="num_facture" class="form-label">Numero Facture</label>
                        <input type="text" class="form-control form-control-sm" id="num_facture" name="num_facture">
                    </div>
                    <div class="col-md-5">
                        <label for="date_facture" class="form-label">PCB</label> <!-- new insert -->
                        <input type="text" class="form-control form-control-sm" id="pcb" name="pcb">
                    </div>
                </div>

                <div class="row px-5 ">
                    <div class="col-md-5">
                        <label for="num_bl" class="form-label">Bon de livraison</label>
                        <input type="text" class="form-control form-control-sm" id="num_bl" name="num_bl" required>
                    </div>
                    <div class="col-md-5">
                        <label for="prix_achat_ht" class="form-label">Prix d'Achat HT</label>
                        <input type="text" class="form-control form-control-sm" id="prix_achat_ht" name="prix_achat_ht"
                            required>
                    </div>
                </div>
                <div class="row px-5 ">
                    <div class="col-md-5">
                        <label for="prix_achat_ttc" class="form-label">Prix d'Achat TTC</label>
                        <input type="text" class="form-control form-control-sm" id="prix_achat_ttc" name="prix_achat_ttc"
                            required>
                    </div>
                    <div class="col-md-5">
                        <label for="cout_trans" class="form-label">Cout transport</label>
                        <input type="text" class="form-control form-control-sm" id="cout_trans" name="cout_trans"
                            required>
                    </div>
                </div>

                <div class="col-md-4 px-5">
                    <label for="date_echeance" class="form-label">Date Echeance</label>
                    <input type="date" class="form-control form-control-sm" id="date_echeance" name="date_echeance">
                </div>
                <div class="col-md-6 px-5 ">
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
                <div class="px-5">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" id="submitFormEntrer" class="btn btn-outline-primary">Enregistrer</button>
                </div>


            </form>


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
                            data: "date_echeance"
                        },
                        {
                            data: "action"
                        }
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
                    var route = "{{route('depot_admin')}}";
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

                            window.location.href = route;
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
