@extends('template')

@section('content')
<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                    <form method="POST" id="formFont">
                        @csrf
                        <h4 class="text-center">Formulaire Fond de caisse</h4>
                        <div class="mb-2">
                            <label for="montant" class="form-label">Montant</label>
                            <input type="text" class="form-control" id="montant" name="montant">
                            <input type="hidden" class="form-control" id="id_fond" name="id_fond">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">
                            Enregistrer
                        </button>
                    </form>
                </div>
                <div class="col-12 col-md-8 col-lg-8">
                    <h4 class="text-center">Liste des Fonds de caisses du {{ date('d/m/Y') }}</h4>
                    <table class="table table-striped" id="liste">
                        <thead>
                            <th>Montant</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
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
                "url" : '{{ route("liste_fond") }}',
                "dataSrc" : ''
            },
            "columns" : [
                {data:"montant"}
            ],
            "language": {
                url: "{{ asset('datatable/french.json') }}"
            }
        });
    });
        
    $("#formFont").on('submit', function(){
        var form = $(this);
        if($("#montant").val()){
            $.ajax({
                url : '{{ route("add_fond") }}',
                type : 'POST',
                data : form.serialize(),
                dataType : 'json',
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').addClass('hidden')
                },
                success: function(response){
                    $("#formFont")[0].reset();
                    $("#id_fond").val(null);
                    Swal.fire({
                        icon: response.icon,
                        text: response.text
                    });
                    table.ajax.reload();
                }
            });
        }else{
            Swal.fire({
                icon : 'warning',
                text: 'Veuillez renseigner le champ unité pour completer l\'insertion, s\'il vous plait'
            });
        }
        return false;
    });

    $('table').on('click', '.delete_fond', function(){
        let id = $(this).data('id');
        if (id) {
            Swal.fire({
                title: 'Vous êtes sur',
                text: "Tous les données seront supprimés définitivement",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Supprimer',
                cancelmButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('delete_fond') }}",
                        data: {
                            _token : '{{ csrf_token() }}',
                            id: id
                        },
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').addClass('hidden')
                        },
                        dataType: "json",
                        success: function (response) {
                            table.ajax.reload();
                            $("#formFont")[0].reset();
                            $("#id_fond").val(null);
                            Swal.fire({
                                icon: response.icon,
                                text: response.text
                            });
                        }
                    });
                }
            })
        }
    });
</script>
@endpush