@extends('template')

@section('content')
<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <h3 class="text-center m-0">Liste des commandes</h3>
                    <hr style="height: 2px">
                    <table class="table table-stripped w-100" id="liste">
                        <thead class="text-center">
                            <th>Date Commande</th>
                            <th>Client</th>
                            <th>Vendeur</th>
                            <th>Total Commande</th>
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

@endsection

@push('js')
<script type="text/javascript">
    $("document").ready(function(){
            table = $("#liste").DataTable({
                "ajax" : {
                    "url" : '{{ route("liste_commande") }}',
                    "dataSrc" : ''
                },
                "order": [[ 0, "desc" ]], //or asc 
                "columnDefs" : [
                    {"targets":0, "type":"date-euro"}
                ],
                "columns" : [
                    {data:"date"},
                    {data:"client"},
                    {data:"user"},
                    {data:"total", className: "text-end"},
                    {data:"action"}
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
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