@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <form method="POST" id="formDepot">
                            @csrf
                            <h4 class="text-center">Formulaire Depot </h4>
                            <div class="mb-2">
                                <label for="depot" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom_depot" name="nom_depot">
                                <input type="hidden" class="form-control" id="id_depot" name="id_depot">
                            </div>
                            <div class="mb-2">
                                <label for="depot" class="form-label">Localisation</label>
                                <input type="text" class="form-control" id="localisation" name="localisation">
                            </div>
                            {{-- <div class="mb-0">
                                <label for="nom" class="form-label">Type depot</label>
                                <input type="text" class="form-control" id="is_default" name="type">
                            </div> --}}
                            
                            <button type="submit" class="btn btn-outline-primary">
                                Enregistrer
                            </button>
                            
                            
                            <button type="submit" class="btn btn-outline-primary">
                                
                            </button>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 col-lg-8">
                        <h4 class="text-center">Liste des Utilisateurs</h4>
                        <table class="table table-striped" id="liste">
                            <thead>
                                
                                <th>Nom</th>
                                <th>Localisation</th>
                                <th>Type</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            
                            </tbody>
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
                    "url" : '{{  route("listedepot") }}',
                    "dataSrc" : ''
                },
                "columns" : [
                    {data:"nom_depot"},
                    {data:"localisation"},
                    {data:"is_default"},
                    {data:"action"}
                ]
                "language" : {
                    url: "{{ asset('datatable/french.json') }}"
                }
            });
        });
        $("#formDepot").on('submit', function(){
            var form = $(this);
            if($("#depot").val()){
                $.ajax({
                    url : '{{ route("add_depot") }}',
                    type : 'POST',
                    data : form.serialize(),
                    dataType : 'json',
                    beforeSend: function () {
                        $('#loader').removeClass('hidden')
                    },
                    complete : function (){
                        $('#loader',addClass('hidden'))
                    },
                    success: function(response){
                        $("#formDepot")[0].reset();
                        $("#id_depot").val(null);
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
                    text: 'Veuillez renseigner le champ Depot pour completer l\'insertion, s\'il vous plait'
                });
            }
            return false
        });


    </script>
    
@endpush

