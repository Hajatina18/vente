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
                                    <input class="form-check-input type_user" type="radio" name="is_admin" id="user" value="0" checked>
                                    <label class="form-check-label" for="user">Vendeur(se)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input type_user" type="radio" name="is_admin" id="admin" value="1">
                                    <label class="form-check-label" for="admin">Administrateur</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input type_user" type="radio" name="is_admin" id="commerce" value="2">
                                    <label class="form-check-label" for="commerce">Commercial</label>
                                </div>
                            </div>
                           
                           <div class="row ">
                             
                                <div class="row px-3 mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_depot" name="is_depot">
                                        <label class="form-check-label" id="label_depot" for="is_depot"></label>
                                    </div>
                                </div>
                                <div class="row px-5 my-3">
                                 
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
                                    <div class="col-md-6" id="pointVenteDiv">
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
        $("document").ready(function(){
            $("#depotDiv").show();
            $("#pointVenteDiv").hide();
            $("#label_depot").text("Attribué à une autre dépôt");
            $("#is_depot").change(function () {
                    if (this.checked) {
                        $("#depotDiv").hide();
                        $("#pointVenteDiv").show();
                        $("#label_depot").text("Attribuée à un point de vente");
                    } else {
                        $("#depotDiv").show();
                        $("#pointVenteDiv").hide();
                        $("#label_depot").text("Attribuée à un autre dépôt");
                    }
            });
        
        });
    </script>
@endpush