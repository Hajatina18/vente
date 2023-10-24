@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <form method="POST" id="formUser">
                            @csrf
                            <h4 class="text-center">Formulaire Utilisateurs</h4>
                            <div class="mb-2">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                                <input type="hidden" class="form-control" id="id_user" name="id_user">
                            </div>
                            <div class="mb-2">
                                <label for="nom" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-2">
                                <label for="nom" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-0">
                                <label for="nom" class="form-label">Type d'utilisateur</label>
                            </div>
                            <div class="mb-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_admin" id="user" value="0" checked>
                                    <label class="form-check-label" for="user">Vendeur(se)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_admin" id="admin" value="1">
                                    <label class="form-check-label" for="admin">Administrateur</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">
                                Enregistrer
                            </button>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 col-lg-8">
                        <h4 class="text-center">Liste des Utilisateurs</h4>
                        <table class="table table-striped" id="liste">
                            <thead>
                                <th>Nom</th>
                                <th>Nom d'utilisateur</th>
                                <th>Type</th>
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
                    "url" : '{{ route("liste_users") }}',
                    "dataSrc" : ''
                },
                "columns" : [
                    {data:"nom"},
                    {data:"username"},
                    {data:"is_admin"},
                    {data:"action"}
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                }
            });
        });
        
        $("#formUser").on('submit', function(){
            var form = $(this);
            if($("#id_user").val()){
                sendUser(form);
            }else{
                if($("#password").val()){
                    sendUser(form);
                }else{
                    Swal.fire({
                        icon : 'warning',
                        text: 'Veuillez renseigner le champ Mot de passe pour completer l\'insertion, s\'il vous plait'
                    });
                }
            }
            return false;
        });

        function sendUser(form) {
            $.ajax({
                url : '{{ route("add_user") }}',
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
                    $("#formUser")[0].reset();
                    $("#id_user").val(null);
                    Swal.fire({
                        icon: response.icon,
                        text: response.text
                    });
                    table.ajax.reload();
                }
            });
        }
        $('table').on('click', '.edit', function(){
            $("#id_user").val($(this).data('id'));
            $("#nom").val($(this).parents('tr').find('td:eq(0)').text());
            $("#username").val($(this).parents('tr').find('td:eq(1)').text());
            let type = $(this).parents('tr').find('td:eq(2)').text();
            if(type == "Administrateur"){
                $("#admin").prop('checked', true);
            }else{
                $("#user").prop('checked', true);
            }
        });
        $('table').on('click', '.delete_user', function(){
            let id = $(this).data('id');
            if (id) {
                Swal.fire({
                    title: 'Vous êtes sur ?',
                    text: "La suppression d'un utilisateur est irreversible",
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
                            url: "{{ route('delete_user') }}",
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
                                $("#formUser")[0].reset();
                                $("#id_user").val(null);
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