@extends('template')

@section('content')
<style>
    .precommandes {
        padding: 20px 50px;
    }
    .precommande {
        box-shadow: 0px 0px 10px 5px #00000042;
        padding: 15px 10px;
    }
</style>
<!--<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <h4 class="text-center">Liste des commandes non validés</h4>
            <div class="precommandes row">
                @foreach ($precommandes as $item)
                <div class="col-12">
                    <div class="precommande">
                        <div class="row d-flex align-items-center">
                            <div class="col-4 date_commande">
                                <h4>{{ utf8_encode(strftime("%d %B %Y", strtotime($item->date_pre_commande)).utf8_decode(' à ').strftime("%H:%M:%S", strtotime($item->created_at))) }}</h4>
                            </div>
                            <div class="col-4">
                                <h3 class=" text-end">{{ number_format($item->sums(), 0, ',', ' ') }} Ar</h3>
                            </div>
                            <div class="col-4 text-end">
                                <button class="btn btn-primary"  data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id_pre_commande }}">Détail</button>
                                <button class="btn btn-success edit_precommande" data-id='{{ $item->id_pre_commande }}'>Modifier</button>
                                <button class="btn btn-success validate_commande" data-id='{{ $item->id_pre_commande }}'>Valider</button>
                            </div>
                        </div>
                        <div class="collapse" id="collapse{{ $item->id_pre_commande }}">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="60%">Designation</th>
                                        <th>Quantité</th>
                                        <th>Prix Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->paniers as $panier)
                                        <tr>
                                            <td>{{ $panier->produit->nom_prod }}</td>
                                            <td>{{ $panier->qte_commande.' '.$panier->unite->unite.($panier->qte_commande > 1 ? "s" : "") }}</td>
                                            <td class=" text-end">{{ number_format($panier->qte_commande*$panier->prix_produit, 0, ',', ' ') }} Ar</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>-->
<div class="commande-content  w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <h3 class="text-center m-0">Liste des précommandes</h3>
                    <hr style="height: 2px">
                    <table class=" col-12 table table-stripped w-100" id="liste">
                        <thead class="text-center">
                             <th>#</th>
                            <th>Date Precommande</th>
                             <th>Vendeur</th>
                            <th>Total precommande</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail de la commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="m-0">Client : <span id="clientModal"></span></p>
                    </div>
                    <div class="col-12 mb-2">
                        <p class="m-0">Date : <span id="dateModal"></span></p>
                    </div>
                    <div class="col-12">
                        <hr style="height: 3px; width : 100%">
                        <h4 class="text-center">Liste des produits</h4>
                        <table class="table table-striped" id="listePaniers">
                            <thead>
                                <th>Image</th>
                                <th>Nom Produit</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Prix Total</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="validateCommande" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Valider la commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mx-0 mb-2 border-bottom py-2 px-1">
                        <div class="d-flex align-items-center justify-content-between form-group">
                            <label for="mode">Mode de paiement</label>
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                @foreach ($modes as $mode)
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="mode" id="mode{{ $mode->id_mode }}" value="{{ $mode->id_mode }}">
                                        <label class="form-check-label" for="mode{{ $mode->id_mode }}">
                                            {{ $mode->mode_paiement }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mx-0 mb-2 border-bottom pb-2">
                        <div class="d-flex align-items-center justify-content-between form-group">
                            <label for="mode">Client</label>
                            <div class="d-flex align-items-center justify-content-between">
                                <input type="text" class="form-control" id="clientName" name="nom_client">
                                <input type="hidden" class="form-control" id="precommandeID" name="precommandeID">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" id="sendCommande">Valider la Commande</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
       
        function format(d) {
            console.log(d)
       return(
                `<table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="60%">Designation</th>
                                        <th>Quantité</th>
                                        <th>Prix Total</th>
                                    </tr>
                                </thead>
                                <tbody>`+
                            d.paniers.map(panier=> `<tr>
                                            <td>`+panier.nom_prod+`</td>
                                            <td>`+panier.qte_commande + ` </td>
                                            <td class=" text-end">`+ panier.qte_commande * panier.prix_produit+`Ar</td>
                                        </tr>` )
                                +`</tbody>
                            </table>`
            )
            
        }
        
         $("document").ready(function(){
            table = $("#liste").DataTable({
                "ajax" : {
                    "url" : '/precommande/liste',
                    "dataSrc" : ''
                },
                "order": [[ 0, "desc" ]], //or asc 
                "columnDefs" : [
                    {"targets":0, "type":"date-euro"}
                ],
                "columns" : [
                    {
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {data:"date"},
                    {data:"user"},
                    {data:"total", className: "text-end"},
                    {data:"action"}
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                }
            });
            
        table.on('click', 'td.dt-control', function (e) {
            let tr = e.target.closest('tr');
            let row = table.row(tr);
        
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
            }
            else {
                // Open this row
                row.child(format(row.data())).show();
            }
        });

        $('table').on('click','.edit_precommande', function(e){
                window.location.href = `{{ route("commande") }}/${$(this).data('id')}`;
            });
            $(".validate_commande").off().on('click', function(e){
                $("#precommandeID").val($(this).data('id'))
                $("#validateCommande").modal('show');
            })
            $("#sendCommande").off().on('click', function(e){
                if ($("input[name=mode]:checked").val()) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('precommande.transfert_commande') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            mode: $("input[name=mode]:checked").val(),
                            client: $("#clientName").val(),
                            precommande: $("#precommandeID").val()
                        },
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').addClass('hidden')
                        },
                        dataType: "json",
                        success: function (response) {
                            $("#validateCommande").modal('hide');
                            Swal.fire({
                                icon: "success",
                                text: "La commande est effectuée",
                                showCancelButton: true,
                                showDenyButton: true,
                                confirmButtonColor: '#3085d6',
                                denyButtonColor: '#00b5ff',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Imprimer ticket',
                                denyButtonText: 'Imprimer Facture',
                                cancelButtonText: 'Fermer'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.open("{{ route('ticket') }}?id="+response.id_commande, '_blank');
                                    window.location.reload();
                                }else if(result.isDenied){
                                    window.open("{{ route('facture') }}?id="+response.id_commande, '_blank');
                                    window.location.reload();
                                }else{
                                    window.location.reload();
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire(
                        '',
                        'Choisissez un mode de paiement',
                        'warning'
                    );
                }
            });
        });
        function getDetail(id) {
            if(id){
                $.ajax({
                    url : '{{ route("admin_getDetail_commande") }}',
                    type : 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id : id
                    },
                    beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('#loader').removeClass('hidden')
                    },
                    complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('#loader').addClass('hidden')
                    },
                    dataType : 'json',
                    success: function(response){
                        $("#modalDetail").find('#clientModal').text(response.commande.nom_client);
                        $("#modalDetail").find('#dateModal').text(response.commande.date);
                        $("#listePaniers > tbody").empty();
                        response.paniers.forEach(panier => {
                            $("#listePaniers > tbody").append("<tr><td><img src='{{ url('/') }}/"+panier.image_prod+"' style='width: 60px'></td><td>"+panier.nom_prod+"</td><td class='text-end'>"+panier.prix_produit+"</td><td class='text-end'>"+panier.qte_commande+" "+panier.unite+"</td><td class='text-end'>"+panier.total+"</td></tr>");
                        });
                        $("#modalDetail").modal('show');
                    }
                });
            }
        }
        
        
    </script>
@endpush