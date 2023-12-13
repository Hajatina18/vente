@extends('template')

@section('content')
<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-5 col-lg-5">
                    <form method="POST" action="" id="formProduct">
                        @csrf
                        <h4 class="text-center">Formulaire Produit</h4>
                        <div class="mb-2">
                            <label for="ref_prod" class="form-label">Réference du produit</label>
                            <input type="text" class="form-control" id="ref_prod" name="ref_prod" required>
                        </div> 
                        <div class="mb-2">
                            <label for="nom_prod" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="nom_prod" name="nom_prod" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_prod" class="form-label">Image</label>
                            <input class="form-control" type="file" id="image_prod" name="image_prod">
                        </div>
                        <div class="card bg-white p-0 mb-2">
                            <div class="card-header bg-white text-center">
                                <h5 class="m-0">Unité du produit</h5>
                            </div>
                            <div class="card-body">
                                <table class="table" id="unite_mesure">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="30%">Unité</th>
                                            <th width="30%">Prix</th>
                                            <th width="30%">
                                                Quantité
                                                <i class="las la-question-circle" style="cursor: pointer"></i>
                                            </th>
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-select" id="unite" name="unite">
                                                    @foreach ($unites as $unite)
                                                    <option value="{{ $unite->id_unite }}">{{ $unite->unite }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td width="40%">
                                                <input type="number" class="form-control mb-1" placeholder="Prix caisse" id="prix" name="prix"
                                                    required>
                                                <input type="number" class="form-control" placeholder="Prix commercial" id="prix_com" name="prix_com" >
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" id="qte" name="qte" required>
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
                        </div>
                        {{-- <div class="my-3">
                            <label for="" class="form-label me-3">Fait à la demande</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fait_demande" value="true" id="demandeOui">
                                <label class="form-check-label" for="demandeOui">
                                    Oui
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fait_demande" value="false" id="demandeNon" checked>
                                <label class="form-check-label" for="demandeNon">
                                    Non
                                </label>
                            </div>
                        </div> --}}
                        {{-- <div class="mb-2">
                            <label for="qte_stock" class="form-label">Quantité en stock</label>
                            <input type="text" class="form-control" id="qte_stock" name="qte_stock" required>
                        </div> --}}
                        <button type="submit" id="submitFormProduit" class="btn btn-outline-primary">
                            Enregistrer
                        </button>
                    </form>
                </div>
                <div class="col-12 col-md-7 col-lg-7">
                    <h4 class="text-center">Liste des produits</h4>
                    <div class="table-responsive">
                        <table class="table table-striped" id="liste">
                            <thead>
                                <th>Réference</th>
                                <th width="25%">Designation</th>
                                <th>Image</th>
                                <th width="40%">Prix par unité</th>
                                <th>Action</th>
                            </thead>
                            <tbody></tbody>
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
                        <label for="modif_ref" class="form-label">Réference du produit</label>
                        <input type="text" class="form-control" id="modif_ref" name="ref_prod" readonly required>
                    </div>
                    <div class="mb-2">
                        <label for="modif_nom" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="modif_nom" name="nom_prod" required>
                    </div>
                    <div class="my-3">
                        <label for="" class="form-label me-3">Fait à la demande</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fait_demandeModif" value="true" id="demandeOuiModif">
                            <label class="form-check-label" for="demandeOuiModif">
                                Oui
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fait_demandeModif" value="false" id="demandeNomModif" checked>
                            <label class="form-check-label" for="demandeNomModif">
                                Non
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image_prod" class="form-label">Image</label>
                        <input class="form-control" type="file" id="modif_image" name="image_prod">
                    </div>
                    <div class="card bg-white p-0 mb-2">
                        <div class="card-header bg-white text-center">
                            <h5 class="m-0">Unité du produit</h5>
                        </div>
                        <div class="card-body">
                            <table class="table" id="modif_unite_mesure">
                                <thead>
                                    <tr class="text-center">
                                        <th width="40%">Unité</th>
                                        <th width="30%">Prix</th>
                                        <th width="30%">
                                            Quantité
                                            <i class="las la-question-circle" style="cursor: pointer"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
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
    var unite = "";
        @foreach ($unites as $unite)
            unite += '<option value="{{ $unite->id_unite }}">{{ $unite->unite }}</option>';
        @endforeach
        $(".add").on('click', function(){
            $(this).parents('tbody').append('<tr class="new_unite" ><td><select class="form-select" id="unite" name="unite">'+unite+'</select></td><td><input type="number" class="form-control mb-1" placeholder="Prix caisse" id="prix" name="prix" required><input type="number" class="form-control" placeholder="Prix commercial" id="prix_com" name="prix_com" ></td><td><input type="text" class="form-control" id="qte" name="qte" required></td><td><button type="button" class="btn btn-outline-secondary delete"><i class="las la-trash"></i></button></td></tr>');
        });
        $("table").on('click', '.delete', function(){
            $(this).parents('tr').remove();
        });
        var table;
        $("document").ready(function(){
            table = $("#liste").DataTable({
                "ajax" : {
                    "url" : '{{ route("liste_produit") }}',
                    "dataSrc" : ""
                },
                "columns" : [
                    {data:'ref_prod'},
                    {data:'nom_prod'},
                    {data:'image_prod'},
                    {data:'unite'},
                    {data:'action'}
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                }
            });
        });
        $("#formProduct").submit(function(){
            var form = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('add_produit') }}",
                data : form,                                    
                cache: false,
                contentType: false,
                processData: false,
                dataType : 'json',
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden');
                    $("#submitFormProduit").prop("disabled", true);
                },
                complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').addClass('hidden');
                    $("#submitFormProduit").prop("disabled", false);
                },
                success: function (response) {
                    if(response.icon){
                        Swal.fire({
                            icon: response.icon,
                            text: response.text
                        });
                    }else{
                        $("#unite_mesure > tbody > tr").each(function () {
                            var unite = $(this).find('td:eq(0)').children('#unite').val();
                            var prix = $(this).find('td:eq(1)').children('#prix').val();
                            var prix_com = $(this).find('td:eq(1)').children('#prix_com').val();
                            var qte = $(this).find('td:eq(2)').children('#qte').val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('set_unite_produit') }}",
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    unite: unite,
                                    ref_prod: $("#ref_prod").val(),
                                    prix: prix,
                                    prix_com:prix_com,
                                    qte: qte
                                },
                                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                    $('#loader').removeClass('hidden')
                                },
                                complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                    $('#loader').addClass('hidden')
                                },
                                dataType: "json",
                                success: function (response) {
                                    $("#formProduct")[0].reset();
                                    $('.new_unite').each(function(){
                                        $(this).remove()
                                    });
                                    table.ajax.reload();
                                }
                            });
                        });
                    }
                }
            });
            return false;
        });

        function getProduit(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('getProduct') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    ref_prod: id
                },
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').addClass('hidden')
                },
                dataType: "json",
                success: function (response) {
                    $("#modif_ref").val(response.ref_prod);
                    $("#modif_nom").val(response.nom_prod);
                    $("[name=fait_demandeModif][value="+Boolean(response.fait_demande)+"]").prop('checked', true);
                    $("#modif_unite_mesure > tbody").empty();
                    response.unite.forEach(element => {
                        $("#modif_unite_mesure > tbody").append('<tr><td><input type="text" class="form-control" name="unite" id="modif_unite" data-id="'+element.id_unite+'" value="'+element.unite+'" readonly></td><td><input type="number" class="form-control" id="modif_prix" name="prix" placehokder="Prix caisse" value="'+element.prix+'" required><input type="number" class="form-control" id="modif_prix_com" placehokder="Prix commercial" name="prix_com" value="'+element.prix_com+'" required></td><td><input type="text" class="form-control" id="modif_qte" name="qte" value="'+element.qte_unite+'" required></td></tr>')
                    });
                    $("#modalModif").modal('show');
                }
            });
        }
        $("#formModifProd").on('submit', function () {
            var form = new FormData(this);
			form.fait_demandeModif = $("[name=fait_demandeModif]:checked").val();
			console.log("Fait demande", form);
            $.ajax({
                type: "POST",
                url: "{{ route('update_produit') }}",
                data : form,                                    
                cache: false,
                contentType: false,
                processData: false,
                dataType : 'json',
                success: function (response) {
                    if(response.icon){
                        Swal.fire({
                            icon: response.icon,
                            text: response.text
                        });
                    }else{
                        $("#modif_unite_mesure > tbody > tr").each(function () {
                            var unite = $(this).find('#modif_unite').data('id');
                            var prix = $(this).find('#modif_prix').val();
                            var qte = $(this).find('#modif_qte').val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('update_unite_produit') }}",
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    unite: unite,
                                    ref_prod: $("#modif_ref").val(),
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
                                success: function (response) {
                                    $("#formModifProd")[0].reset();
                                    $("#modif_unite_mesure > tbody").empty();
                                    table.ajax.reload();
                                    $("#modalModif").modal('hide');
                                }
                            });
                        });
                    }
                }
            });
            return false;
        })
</script>
@endpush