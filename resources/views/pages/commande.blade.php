@extends('template')

@section('content')
<div class="commande-content">
    <div class="card bg-white">
        <div class="card-body">
            <div class="row mx-0">
                <div class="col-12  mb-4 d-flex align-items-center border-bottom border-dark justify-content-between">
                    <h4>Toutes les Produits dans le Stock</h4>
                    
                    <form action="#" id="formSearch">
                        <div class="form-group mb-2">
                            <input type="text" name="recherche" id="recherche" class="form-control">
                            <i class="las la-search"></i>
                        </div>
                    </form>
                </div>
               
                <div id="product">
                    @include('pages.partials.produits')
                </div> 
            </div>
            
        </div>
    </div>
</div>
<div class="panier-content border">
    <div class="row mx-0">
        <div class="col-12 mx-0 mb-2 p-0" id="panier">
            <h5 class="text-center mt-2 mb-0">Panier</h5>
            <hr class="my-2">
            @if ($precommande && $precommande->paniers)
                @foreach ($precommande->paniers as $panier)
                    <div class="panier-item mb-2" data-id="{{ $panier->id_pre_panier }}">
                        <img src="{{ $panier->produit->image_prod }}" class="panier-item-img" alt="">
                        <div class="product-info">
                            <p class="product-name m-0" data-id="{{ $panier->produit->ref_prod }}">{{ $panier->produit->nom_prod }}</p>
                            <p class="product-price-unity m-0"  data-price="{{ $panier->prix_produit }}" data-unity="{{ $panier->id_unite}}">{{ number_format($panier->prix_produit, 0, ',', ' ') }} Ar / {{ $panier->unite->unite }}</p>
                        </div>
                        <div class="panier-item-qty">
                            <input type="number" class="form-control qte-product" name="panier-qty" data-val="{{ $panier->qte_commande }}" value="{{ $panier->qte_commande }}">
                        </div>
                        <div class="total-product">
                            <span class="total">{{ number_format($panier->qte_commande*$panier->prix_produit, 0, ',', ' ') }}</span> Ar
                        </div>
                        <a href="javascript:void(0)" type="button" class="bagde bg-secondary delete">
                            <i class="las la-trash"></i>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
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
                    <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#modalClient"><i class="las la-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-12 mx-0 border-top border-2 border-dark">
            <div class="d-flex align-items-center justify-content-between py-2">
                <h5 class="m-0">Total</h5>
                <p class="m-0" id="totalPanier">{{ $precommande ? number_format($precommande->paniers_sum, 0, ',', ' ') : 0 }} Ar</p>
            </div>
        </div>
        <div class="col-12 mx-0 border-top border-2 border-dark pt-2">
            <button type="button" class="btn btn-outline-success" onclick="addPrecommande()">Enregistrer la Commande</button>
            <button type="button" class="btn btn-outline-primary" onclick="sendCommande()">Valider la commande</button>
        </div>
    </div>
</div>

<div class="modal fade" id="modalClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Liste des Clients</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped w-100" id="listeClient">
                    <thead>
                        <th>Nom</th>
                        <th></th>
                    </thead>
                    <tbody>
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
       
        $("document").ready(function(){
            table = $("#liste").DataTable({
                "ajax" : {
                    "url" : `/getProduit`,
                    "dataSrc" : ""
                },
                "columns" : [
                    {data:'ref_prod'},
                     {data:'image_prod'},
                   {data:'nom_prod'},
                    {data:'qte_stock'},
                    {data:'unite'},
                    // {data:'action'}
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                }
            });

            window.sessionStorage.getItem("execute") ? console.log("existe") : window.sessionStorage.setItem('execute', 0);
            if(window.sessionStorage.getItem('execute')){
                if(window.sessionStorage.getItem('execute') == 0){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('add_stock_week') }}",
                        data: {
                            _token : '{{ csrf_token() }}'
                        },
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').addClass('hidden')
                        },
                        dataType: "json",
                        success: function (response) {
                            window.sessionStorage.setItem('execute', 1)
                        }
                    });
                }
            }
            client = $("#listeClient").DataTable({
                "ajax" : {
                    "url" : '{{ route("getClient_commande") }}',
                    "dataSrc" : ""
                },
                'columns' : [
                    {data:'nom_client'},
                    {data:'action'}
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                },
                info : false
            });
        })
        
        var total = {{ $precommande ? $precommande->paniers_sum : 0 }};
        var i = {{ $precommande ? count($precommande->paniers) : 0 }};
        var precommande = null;
        @if ($parametres)
            precommande = {{ $parametres }};
        @endif
        
        $("#panier").on('click', '.delete', function(){
            var price = $(this).parents('.panier-item').find('.product-price-unity').data('price');
            var id = $(this).parents('.panier-item').data('id');
            total -= parseInt(price)*parseFloat($(this).parents('.panier-item').find('.panier-item-qty').children('input').val());
            $("#totalPanier").text((new Intl.NumberFormat('fr').format(total))+' Ar')
            $(this).parents('.panier-item').remove();
            i--;
            if(id){
                $.ajax({
                    type: "POST",
                    url: "{{ route('precommande.deletePanier') }}",
                    data: {
                        _token : '{{ csrf_token() }}',
                        id_panier : id
                    },
                    beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('#loader').removeClass('hidden')
                    },
                    dataType: "json",
                    success: function (response) {
                       
                    },
                    complete: function(){
                        $('#loader').addClass('hidden')
                    }
                });
            }
            
        });

        function addPanier(id_depot,nom_depot,ref_prod, nom_prod, prix_prod,prix_com,id_unite, unite, image_prod,commercial) {
            var existe = false;
            var PRIX = commercial ? prix_com : prix_prod
            $('.panier-item').each(function () {
                var ref = $(this).find('.product-name').data('id');
                var unity = $(this).find('.product-price-unity').data('unity');
                let panier = $(this);
                if(ref == ref_prod && unity == id_unite){
                    existe = true;
                    $.ajax({
                        type: "POST",
                        url: "{{ route('verify-stock') }}",
                        data: {
                            _token : '{{ csrf_token() }}',
                            ref_prod :ref,
                            qte : (parseInt($(this).find('.panier-item-qty').children('input').val())+1),
                            unite : id_unite
                        },
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        dataType: "json",
                        success: function (response) {
                            if(response.stock){
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Stock épuisé',
                                    text: 'Le stock restant du produit '+response.nom_prod+' est seulement '+ response.stock.toFixed(2) +' '+response.unite
                                });
                                panier.find('.panier-item-qty').children('input').val(response.stock);
                            }else{
                                panier.find('.panier-item-qty').children('input').val((parseInt(panier.find('.panier-item-qty').children('input').val())+1));
                            }
                        },
                        complete: function(){
                            panier.find('.total').text((new Intl.NumberFormat('fr').format(parseInt(PRIX)*(parseFloat(panier.find('.panier-item-qty').children('input').val())))));
                            total += (panier.find('.panier-item-qty').children('input').val() - panier.find('.panier-item-qty').children('input').data('val')) * PRIX;
                            $("#totalPanier").text((new Intl.NumberFormat('fr').format(total))+' Ar')
                            panier.find('.panier-item-qty').children('input').data('val', panier.find('.panier-item-qty').children('input').val());
                            $('#loader').addClass('hidden')
                        }
                    });
                }

            });
            if(!existe){
                i++;
                $.ajax({
                    type: "POST",
                    url: "{{ route('verify-stock') }}",
                    data: {
                        _token : '{{ csrf_token() }}',
                        ref_prod :ref_prod,
                        qte : 1,
                        unite : id_unite
                    },
                    beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('#loader').removeClass('hidden')
                    },
                    complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('#loader').addClass('hidden')
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.stock){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Stock épuisé',
                                text: 'Le stock restant du produit '+response.nom_prod+' est seulement '+response.stock.toFixed(2) +' '+response.unite
                            });
                            $("#panier").append('<div class="panier-item mb-2"><img src="'+image_prod+'" class="panier-item-img" alt=""><div class="product-info"><p class="product-name m-0" data-id="'+ref_prod+'">'+nom_prod+'</p><p class="product-price-unity m-0"  data-price="'+PRIX+'" data-unity="'+id_unite+'">'+(new Intl.NumberFormat('fr').format(PRIX))+' Ar / '+unite+'</p></div><div class="panier-item-qty"><input type="number" class="form-control qte-product" name="panier-qty" data-val="'+response.qte_stock+'" value="'+response.qte_stock+'"></div><div class="total-product"><span class="total">'+(new Intl.NumberFormat('fr').format(PRIX*1))+'</span> Ar</div><a href="javascript:void(0)" type="button" class="bagde bg-secondary delete"><i class="las la-trash"></i></a></div>');
                            total += parseInt(PRIX)*Math.trunc(response.stock,2);
                            $("#totalPanier").text((new Intl.NumberFormat('fr').format(total))+' Ar');
                        }else{
                            $("#panier").append('<div class="panier-item mb-2"><img src="'+image_prod+'" class="panier-item-img" alt=""><div class="product-info"><p class="product-name m-0" data-id="'+ref_prod+'">'+nom_prod+'</p><p class="product-price-unity m-0"  data-price="'+PRIX+'" data-unity="'+id_unite+'">'+(new Intl.NumberFormat('fr').format(PRIX))+' Ar / '+unite+'</p></div><div class="panier-item-qty"><input type="number" class="form-control qte-product" name="panier-qty" value="1" data-val="1"></div><div class="total-product"><span class="total">'+(new Intl.NumberFormat('fr').format(PRIX*1))+'</span> Ar</div><a href="javascript:void(0)" type="button" class="bagde bg-secondary delete"><i class="las la-trash"></i></a></div>');
                            total += parseInt(PRIX);
                            $("#totalPanier").text((new Intl.NumberFormat('fr').format(total))+' Ar');
                        }
                    }
                });
            }
        }

        $('body').on('focusin', '.qte-product', function(){
            $(this).data('val', $(this).val());
        });

        $("body").on('change', '.qte-product', function(){
            var qte_input = $(this);
            var prix = $(this).parents('.panier-item').find('.product-price-unity').data('price');           
            if($(this).val()){
                $.ajax({
                    type: "POST",
                    url: "{{ route('verify-stock') }}",
                    data: {
                        _token : '{{ csrf_token() }}',
                        ref_prod : $(this).parents('.panier-item').find('.product-name').data('id'),
                        qte : $(this).val(),
                        unite : $(this).parents('.panier-item').find('.product-price-unity').data('unity')
                    },
                    beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                        $('#loader').removeClass('hidden')
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.stock){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Stock épuisé',
                                text: 'Le stock restant du produit '+response.nom_prod+' est seulement '+response.stock.toFixed(2)+' '+response.unite
                            });
                            qte_input.val(Math.trunc(response.stock));
                        }
                    },
                    complete: function(){
                        qte_input.parents('.panier-item').find('.total').text((new Intl.NumberFormat('fr').format(parseInt(prix)*(parseFloat(qte_input.val())))));
                        total += (qte_input.val() - qte_input.data('val')) * prix;
                        $("#totalPanier").text((new Intl.NumberFormat('fr').format(total))+' Ar')
                        qte_input.data('val', qte_input.val());
                        $('#loader').addClass('hidden')
                    }
                });
            }
        });

        $("#recherche").on('keyup', function(){
            // var formData = new FormData();
            // formData.append('_token', '{{ csrf_token() }}');
            // formData.append('search', $(this).val());  
            // fetch('/',{method: 'POST', body: formData })
            // .then(function(res){ return res.json(); })
            // .then(function(data){
            //     $("#product").html(data);
            // });
        });
        $(".add").on('click', function(){
            alert("azert")
            // $("#clientName").val($(this).data('id'));
            // $("#modalClient").modal('hide');
        })

        function sendCommande() {
            if(i > 0){
                if ($("input[name=mode]:checked").val()) {
                    $.ajax({
                        url : '{{ route("save_commande") }}',
                        type : 'POST',
                        data : {
                            _token: '{{ csrf_token() }}',
                            mode: $("input[name=mode]:checked").val(),
                            client: $("#clientName").val()
                        },
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').addClass('hidden')
                        },
                        dataType : 'json',
                        success: function(response){
                            if(response.icon){
                                Swal.fire({
                                    icon: response.icon,
                                    text: response.text
                                });
                            }else{
                                var j = 0;
                                $("#panier > .panier-item").each(function () {
                                    var unite = $(this).find('.product-price-unity').data('unity');
                                    var prix = $(this).find('.product-price-unity').data('price');
                                    var qte = $(this).find('.panier-item-qty').children('input').val();
                                    var ref = $(this).find('.product-name').data('id');
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('add_panier') }}",
                                        data: {
                                            id: response.id_commande,
                                            _token: '{{ csrf_token() }}',
                                            unite: unite,
                                            ref_prod: ref,
                                            prix: prix,
                                            qte: qte
                                        },
                                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                            $('#loader').removeClass('hidden')
                                        },
                                        complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                            $('#loader').addClass('hidden')
                                        },
                                        dataType: "json",
                                        success: function (data) {
                                            j++;
                                            if(i == j){
                                                $(".panier-item").remove();
                                                $("input[name=mode]:checked").prop('checked', false);
                                                total = 0;
                                                $("#totalPanier").text((new Intl.NumberFormat('fr').format(total))+' Ar')
                                                i = 0;
                                                // $.get("{{ route('getProduit') }}", function(data) {
                                                //     $("#product" ).html(data);
                                                // });
                                                if(precommande){
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "{{ route("precommande.delete") }}",
                                                        data: {
                                                            id_precommande: precommande
                                                        },
                                                        dataType: "json",
                                                        success: function (response) {
                                                        }
                                                    });
                                                }
                                                client.ajax.reload();
                                                Swal.fire({
                                                    icon: data.icon,
                                                    text: data.text,
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
                                                    }else if(result.isDenied){
                                                        window.open("{{ route('facture') }}?id="+response.id_commande, '_blank');
                                                    }else{
                                                        if(precommande){
                                                            window.location.href = window.location.origin;
                                                        }
                                                    }
                                                });
                                            }
                                        }
                                    });
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire(
                        '',
                        'Choisissez un mode de paiement',
                        'warning'
                    );
                }
            }else{
                Swal.fire(
                    '',
                    'Veuillez ajouter au moins un produit pour passer la commande',
                    'warning'
                );
            }
        }
        function addPrecommande() {
            if(i > 0){
                if(precommande){
                    var j = 0;
                    $("#panier > .panier-item").each(function () {
                        var id_panier = $(this).data('id');
                        var unite = $(this).find('.product-price-unity').data('unity');
                        var prix = $(this).find('.product-price-unity').data('price');
                        var qte = $(this).find('.panier-item-qty').children('input').val();
                        var ref = $(this).find('.product-name').data('id');
                        $.ajax({
                            type: "POST",
                            url: "{{ route('precommande.updatePanier') }}",
                            data: {
                                id: precommande,
                                id_panier: id_panier,
                                _token: '{{ csrf_token() }}',
                                unite: unite,
                                ref_prod: ref,
                                prix: prix,
                                qte: qte
                            },
                            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                $('#loader').removeClass('hidden')
                            },
                            complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                $('#loader').addClass('hidden')
                            },
                            dataType: "json",
                            success: function (data) {
                                j++;
                                if(i == j){
                                    window.location.href = window.location.origin;
                                }
                            }
                        });
                    });
                }else{
                    $.ajax({
                        url : '{{ route("precommande.save") }}',
                        type : 'POST',
                        data : {
                            _token: '{{ csrf_token() }}'
                        },
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').addClass('hidden')
                        },
                        dataType : 'json',
                        success: function(response){
                            if(response.icon){
                                Swal.fire({
                                    icon: response.icon,
                                    text: response.text
                                });
                            }else{
                                var j = 0;
                                $("#panier > .panier-item").each(function () {
                                    var unite = $(this).find('.product-price-unity').data('unity');
                                    var prix = $(this).find('.product-price-unity').data('price');
                                    var qte = $(this).find('.panier-item-qty').children('input').val();
                                    var ref = $(this).find('.product-name').data('id');
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('precommande.panier') }}",
                                        data: {
                                            id: response.id_pre_commande,
                                            _token: '{{ csrf_token() }}',
                                            unite: unite,
                                            ref_prod: ref,
                                            prix: prix,
                                            qte: qte
                                        },
                                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                            $('#loader').removeClass('hidden')
                                        },
                                        complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                            $('#loader').addClass('hidden')
                                        },
                                        dataType: "json",
                                        success: function (data) {
                                            j++;
                                            if(i == j){
                                                $(".panier-item").remove();
                                                $("input[name=mode]:checked").prop('checked', false);
                                                total = 0;
                                                $("#totalPanier").text((new Intl.NumberFormat('fr').format(total))+' Ar')
                                                i = 0;
                                                // $.get("{{ route('getProduit') }}", function(data) {
                                                //     $("#product").html(data);
                                                // });
                                                client.ajax.reload();
                                            }
                                        }
                                    });
                                });
                            }
                        }
                    });
                }
            }else{
                Swal.fire(
                    '',
                    'Veuillez ajouter au moins un produit pour passer la commande',
                    'warning'
                );
            }
        }
        
      
    </script>
@endpush
