@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <form method="POST" id="formPaiement">
                            @csrf
                            <h4 class="text-center">Formulaire Mode de Paiement</h4>
                            <div class="mb-2">
                                <label for="mode_paiement" class="form-label">Mode de paiement</label>
                                <input type="text" class="form-control" id="mode_paiement" name="mode_paiement">
                                <input type="hidden" class="form-control" id="id_mode" name="id_mode">
                            </div>
                            <button type="submit" class="btn btn-outline-primary">
                                Enregistrer
                            </button>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 col-lg-8">
                        <h4 class="text-center">Liste des modes de paiement</h4>
                        <table class="table table-striped" id="liste">
                            <thead>
                                <th>Mode de paiement</th>
                                <th>Action</th>
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
        var table;
        $("document").ready(function(){
            table = $("#liste").DataTable({
                "ajax" : {
                    "url" : '{{ route("liste_paiement") }}',
                    "dataSrc" : ''
                },
                "columns" : [
                    {data:"mode_paiement"},
                    {data:"action"}
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                }
            });
        });
        
        $("#formPaiement").on('submit', function(){
            var form = $(this);
            if($("#mode_paiement").val()){
                $.ajax({
                    url : '{{ route("add_paiement") }}',
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
                        $("#formPaiement")[0].reset();
                        $("#id_mode").val(null);
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
                    text: 'Veuillez renseigner le champ Mode de Paiement pour completer l\'insertion, s\'il vous plait'
                });
            }
            return false;
        });
        $('table').on('click', '.edit', function(){
            $("#id_mode").val($(this).data('id'));
            $("#mode_paiement").val($(this).parents('tr').find('td:eq(0)').text());
        });
        $('table').on('click', '.delete_paiement', function(){
            let id = $(this).data('id');
            if (id) {
                Swal.fire({
                    title: 'Vous êtes sur ?',
                    text: "La suppression d'une mode de paiement est irreversible",
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
                            url: "{{ route('delete_paiement') }}",
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
                                $("#formPaiement")[0].reset();
                                $("#id_mode").val(null);
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