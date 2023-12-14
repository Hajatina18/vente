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
            <div class="row w-100">
                <div class="col-12 col-md-12 col-lg-12">
                    <h3 class="text-center m-0">Liste des précommandes</h3>
                    <hr style="height: 2px">
                    <table class=" col-12 table table-stripped" id="liste">
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
                        <table class="table table-striped w-100" id="listePaniers">
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


<div class="modal fade " id="validateCommande" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
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
                    <div class="col-12 mx-0 mb-2 border-bottom pb-2">
                        <div class="d-flex align-items-center justify-content-between form-group">
                            <div class="d-flex align-items-center justify-content-between  w-100" id="productTable">
                                
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
       
       var commande;
        function format(d,show) {
            // console.log(d) /* <td  class="${show==true? 'd-block':'d-none'}" > <input class="form-control" type="number" value="${panier.prix_produit}" />*/ 
        return(
                `<table class="table table-striped w-100">
                                <thead>
                                    <tr>
                                        <th >Designation</th>
                                        <th width="30%" class="text-center">Quantité</th>
                                        <th class="${show==true? 'd-block':'d-none'} text-center">Choix du dépot</th>
                                        <th width="" class="text-center ">Total</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>`+
                            d.paniers.map((panier,i)=>`<tr class="product">
                                            <td>`+panier.produit.nom_prod  +`</td>
                                            <td class="qte text-center"> ${panier.qte_commande}  ${panier.qte_commande >1 ? panier.unite.unite+'s' : panier.unite.unite}  </td>
                                            </td>
                                           ${show==true? '<td class="depot "  > '+getDepot(panier,i)+'</td>' : ''}
                                            <td width="20%"  class="sum text-center">`+ panier.qte_commande * panier.prix_produit+`Ar</td>
                                            
                                        </tr>` )
                                +`
                              ${show==true ? `<tr >
                                    <td colspan="3" class="text-end">Total</td>
                                    <td id="total fs-4 text-center">${ d.paniers.reduce((a,b) =>  a + b.qte_commande*b.prix_produit,0)}</td>
                                </tr> ` : ''} 
                             </tbody>
                           </table>`
            )
            
        }
       
        function calc_total(){
            var sum = 0;
            $(".sum").each(function(){
                sum += parseFloat($(this).text());
            });
            $('#total').text(sum);
            }
        
        function getDepot (data,id){
            //    console.log(data)
            $.ajax({
                        type: "POST",
                        url: "/getStock",
                        data: {
                            _token: '{{ csrf_token() }}',
                            ref_prod: data.ref_prod,
                            id_unite: data.id_unite
                        },
                        dataType: "json",
                        success: function (response) {
                        const TotalStock = response.reduce((acc,val) => acc + (val.totalStock /val.qte_unite),0)  
                        //   response.map(val=> { console.log(val.totalStock /val.qte_unite)})
                        const EtatStock = response.reduce((acc,val) => acc + ( (val.totalStock /val.qte_unite) > data.qte_commande),false)
                        //   console.log(response)
                        //   console.log(response.length )
                        let depots = response.length === 0 ? `<div class="blink-grow stock-epuise">
                                                                <span class='badge bg-danger rounded-pill '>Stock épuisé</span>
                                                            </div>`: 
                                                            response.map(depot => `
                                                            <div class='d-flex' >
                                                            <div class="w-100 form-check form-check-inline ">
                                                                    <input class="form-check-input" type="radio" checked='${response.length===1}' name="${depot.ref_prod}/${depot.unite}" id="${depot.ref_prod}/${depot.unite}" value="${depot.id_depot}">
                                                                    <label for="id_depot" class="form-label">${depot.nom_depot} </label>
                                                                    
                                                                </div>
                                                                <div class="ml-auto">
                                                                <span class='badge disabled  ${ data.qte_commande > depot.totalStock /depot.qte_unite ?"btn-danger" : "btn-primary"} '>
                                                                        ${Math.round(depot.totalStock/depot.qte_unite,2)} ${ Math.round(depot.totalStock/depot.qte_unite,2)>1 ? depot.unite+'s' :  depot.unite}
                                                                    </span>
                                                                </div>
                                                            </div>`)

                            depots +=  response.length >1 && !EtatStock ? 
                                    `
                                <div class='d-flex mt-2' >
                                    <div class="w-100 form-check form-check-inline ">
                                            <input class="form-check-input" type="radio" checked="true" name="${response[0].ref_prod}/${response[0].unite}" id="${response[0].ref_prod}/${response[0].unite}" value="all">
                                            <label for="id_depot" class="form-label">Tous les dépots</label>              
                                   </div>
                                   <div class="ml-auto"> 
                                      <span class='badge disabled btn-primary  ml-auto'>
                                         ${Math.round(TotalStock,2)} ${ Math.round(TotalStock,2)>1 ? response[0].unite+'s' :  response[0].unite}
                                       </span>
                                   </div>
                                 </div>` : ''
                        
                            $('.depot').eq(id).html(depots)
                        }
                })
                
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
                row.child(format(row.data(),false)).show();
            }
        });
       
        $("#productTable").on('change','.input',function(e){
                var prix = e.target.value
               var qte = $(this).parents('tr').find('td:eq(1)').text()
                 $(this).parents('tr').find('td:eq(3)').html(qte*prix)
                 calc_total()
        })

        $('table').on('click','.edit_precommande', function(e){
                window.location.href = `{{ route("commande") }}/${$(this).data('id')}`;
            });

        $("table").on('click',".confirm_commande", function(e){
            $("#precommandeID").val($(this).data('id'))
            $("#validateCommande").modal('show');
        })

        $("#sendCommande").off().on('click', function(e){
            //  console.log(commande)
            var paniers = commande.paniers.map((panier,index) =>{
                // console.log(panier.prix_produit) 
                const outOfStock = $("#productTable .stock-epuise").eq(index).text() ? true : false
               return {
                    id_pre_panier: panier.id_pre_panier,
                    ref_prod : panier.ref_prod,
                    qte_commande :panier.qte_commande,
                    id_unite:panier.id_unite,
                    id_depot: $("#productTable input:checked").eq(index).val(),
                    prix_produit: panier.prix_produit, //$("#productTable input").eq(index).val()
                    outofstock : outOfStock
                }
              
            })
        //  console.log(paniers)
            // alert($("#precommandeID").val())
        if ($("input[name=mode]:checked").val()) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('precommande.transfert_commande') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            mode: $("input[name=mode]:checked").val(),
                            client: $("#clientName").val(),
                            precommande: $("#precommandeID").val(), 
                            paniers:paniers
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
                            if(response.icon==="error"){
                                Swal.fire({
                                icon: response.icon,
                                text: response.text
                            }).then((result) => {
                                window.location.reload();
                                
                            });
                            }else{
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
                        }
                    });
            } 
            else {
                Swal.fire(
                    '',
                    'Choisissez un mode de paiement',
                    'warning'
                );
            }
          });
    });

        function getDetail(data) {
            commande = data
            $("#precommandeID").val(data.id_pre_commande)
            $("#validateCommande").modal('show');

            $("#productTable").html(format(data,true))
            // if(id){
            //     $.ajax({
            //         url : '{{ route("admin_getDetail_commande") }}',
            //         type : 'POST',
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             id : id
            //         },
            //         beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
            //             $('#loader').removeClass('hidden')
            //         },
            //         complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
            //             $('#loader').addClass('hidden')
            //         },
            //         dataType : 'json',
            //         success: function(response){
            //             $("#modalDetail").find('#clientModal').text(response.commande.nom_client);
            //             $("#modalDetail").find('#dateModal').text(response.commande.date);
            //             $("#listePaniers > tbody").empty();
            //             response.paniers.forEach(panier => {
            //                 $("#listePaniers > tbody").append("<tr><td><img src='{{ url('/') }}/"+panier.image_prod+"' style='width: 60px'></td><td>"+panier.nom_prod+"</td><td class='text-end'>"+panier.prix_produit+"</td><td class='text-end'>"+panier.qte_commande+" "+panier.unite+"</td><td class='text-end'>"+panier.total+"</td></tr>");
            //             });
            //             $("#modalDetail").modal('show');
            //         }
            //     });
            // }
        }
        
        
    </script>
@endpush