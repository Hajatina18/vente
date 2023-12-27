@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">

            <div class="row p-4">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <!-- start modal -->
                    <div class="d-flex justify-content-between mb-2">
                        <div >
                            <button type="button " class="btn btn-info " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <a href="#" class="btn btn-info">Ajouter une Point de vente</a>
                            </button>
                        </div>
                    </div>
                
                    <!--start add stock -->                   
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- start modal -->
                                <form method="POST" id="formPointVente">
                                    <div class="modal-body">
                                        @csrf
                                        <h4 class="text-center">Formulaire Points de vente </h4>

                                            <div class="mb-2">
                                                <label for="nom_pdv" class="form-label">Nom</label> 
                                                <input type="text" class="form-control" id="nom_pdv" name="nom_pdv">
                                                <input type="hidden" class="form-control" id="id_pdv" name="id_pdv">
                                            </div>
                                            
                                            <div class="mb-2">
                                                <label for="address_pdv" class="form-label">Addresse</label>
                    
                                                    <input type="text" class="form-control" id="address_pdv" name="address_pdv">

                                            </div>
                                            <div class="mb-2">
                                                <label for="telephone_pdv" class="form-label">Téléphone </label>
                                                <input type="text" class="form-control" id="telephone_pdv" name="telephone_pdv">
                                            </div>
                                            <div class="mb-2">
                                                <label for="nif_pdv" class="form-label">NIF </label>
                                                <input type="text" class="form-control" id="nif_pdv" name="nif_pdv">
                                            </div>
                                            <div class="mb-2">
                                                <label for="stat_pdv" class="form-label">STAT</label>
                                                <input type="text" class="form-control" id="stat_pdv" name="stat_pdv">
                                            </div>
                                            <div class="mb-2">
                                                <label for="rcs_pdv" class="form-label">RCS</label> 
                                                <input type="text" class="form-control" id="rcs_pdv" name="rcs_pdv">
                                            </div>
                                            <div class="mb-3">
                                                <label for="logo" class="form-label">Logo</label>
                                                <input class="form-control" type="file" id="logo" name="logo">
                                            </div>
                                    
                                            <button type="submit" id="submitFormPointVente" class="btn btn-primary">
                                                Sauvagarder
                                            </button>
                                            
                                    </div>
                                </form>
                                <!-- end modal-->
                            </div>
                        </div>
                    </div>
                <div class="col-12 col-md-4 col-lg-4 mb-md-0 mb-3"> <!-- Espace ajouté -->

            
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <h4 class="text-center mb-2">Liste des points des ventes</h4>
                    <table class="table table-striped col-12" id="liste">
                        <thead>
                           <th>Nom</th>
                            <th>Addresse</th>
                            <th>Téléphone</th>
                            <th >NIF Stat</th>
                            <th></th>
                             <th>RCS</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                      
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection


@push('js')
    <script type="text/javascript">
        var table;
        $("document").ready(function() {
            table = $("#liste").DataTable({
                "ajax": {
                    "url": '{{ route("liste_point_vente") }}',
                    "dataSrc": ''
                },
                "columns": [{
                        data: "nom_pdv"
                    },
                    {
                        data: "address_pdv"
                    },
                    {
                        data: "telephone_pdv"
                    },
                    {
                        data: "nif_pdv",
                      
                    },
                    {
                        data: "stat_pdv",
                    },
                    {
                        data: "rcs_pdv"
                    },
                    {
                        data: "action"
                    },
                   
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                }
            });
        });
        //validation champ point de vente
        $("#formPointVente").on('submit', function() {
            var form = $(this);
            if($("#nom_pdv").val()){
                $.ajax({
                    url: '{{ route("add_point_vente") }}',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    beforeSend: function() { 
                        $('#loader').removeClass('hidden');
                      
                    },
                    complete: function() { 
                        $('#loader').addClass('hidden');
                      
                    },
                    success: function(response) {
                        $("#formPointVente")[0].reset();
                        $('#exampleModal').modal('hide');
                        $("#id_pdv").val(null);
                        Swal.fire({
                            icon: response.icon,
                            text: response.text
                        });
                     table.ajax.reload();
                    }
                });
            }else{
                Swal.fire({
                    icon: 'warning', 
                    text: 'Veuillez renseigner le champ point de vente pour completer l\'insertion, s\'il vous plait'
                });
            }
           
            return false;
        });
        //champ vide 
        $("#formPointVente").on('submit', function() {
            var form = $(this);
            if($("#addresse_pdv").val()){
                $.ajax({
                    url: '{{ route("add_point_vente") }}',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    beforeSend: function() { 
                        $('#loader').removeClass('hidden');
                      
                    },
                    complete: function() { 
                        $('#loader').addClass('hidden');
                      
                    },
                    success: function(response) {
                        $("#formPointVente")[0].reset();
                        $('#exampleModal').modal('hide');
                        $("#id_pdv").val(null);
                        Swal.fire({
                            icon: response.icon,
                            text: response.text
                        });
                     table.ajax.reload();
                    }
                });
            }else{
                Swal.fire({
                    icon: 'warning', 
                    text: 'Veuillez renseigner le champ point de vente pour completer l\'insertion, s\'il vous plait'
                });
            }
           
            return false;
        });
        $('table').on('click', '.edit', function() {
             $("#exampleModal").find('#id_pdv').val($(this).data('id'));
            $("#exampleModal").find('#nom_pdv').val($(this).parents('tr').find('td:eq(0)').text());
            $("#exampleModal").find('#address_pdv').val($(this).parents('tr').find('td:eq(1)').text());  
            $("#exampleModal").find('#telephone_pdv').val($(this).parents('tr').find('td:eq(2)').text());
            $("#exampleModal").find('#nif_pdv').val($(this).parents('tr').find('td:eq(3)').text());
            $("#exampleModal").find('#stat_pdv').val($(this).parents('tr').find('td:eq(4)').text());
            $("#exampleModal").find('#rcs_pdv').val($(this).parents('tr').find('td:eq(5)').text());
            $("#exampleModal").modal('show');
           
        })
    </script>
@endpush
