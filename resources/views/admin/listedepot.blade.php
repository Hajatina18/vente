@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">

            <div class="row">
                <div class="d-flex justify-content-start mb-3"> <!-- Espace ajouté -->
                    <div class="ms-5">
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <a href="{{ route('depot_admin') }}" >
                                <span class="navi-icon"><i class="la la-long-arrow-alt-left mx-1"></i></span>
                                <span class="navi-text">Retour</span>
                            </a>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb-md-0 mb-3"> <!-- Espace ajouté -->

                    <form method="POST" id="formDepot">
                        @csrf
                        <h4 class="text-center">Formulaire Dépôt </h4>
                        <div class="mb-3">
                            <label for="depot" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom_depot" name="nom_depot">
                            <input type="hidden" class="form-control" id="id_depot" name="id_depot">
                        </div>
                        <div class="mb-3">
                            <label for="depot" class="form-label">Localisation</label>
                            <input type="text" class="form-control" id="localisation" name="localisation">
                        </div>
                     <div class="mb-0">
                                <label for="nom" class="form-label">Type depot</label>
                              
                                <select class="form-select" id="is_default" name="is_default">
                                                    <option default >Choix de dépôt</option>
                                                    <option value="1">Dépôt principale</option>
                                                    <option value="0">Dépôt péripherique</option>
                                                </select>
                            </div> 

                        <button type="submit" class="btn btn-outline-primary">
                            Enregistrer
                        </button>

                    </form>
                </div>
                <div class="col-12 col-md-6 col-lg-8">
                    <h4 class="text-center mb-2">Liste des Utilisateurs</h4>
                    <table class="table table-striped" id="liste">
                        <thead>
                            
                            <th>Nom</th>
                            <th>Localisation</th>
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
                    "url": '{{ route("getalldepot") }}',
                    "dataSrc": ''
                },
                "columns": [{
                        data: "nom_depot"
                    },
                    {
                        data: "localisation"
                    },

                    {
                        data: "action"
                    }
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                }
            });
        });
        $("#formDepot").on('submit', function() {
            var form = $(this);
           
                $.ajax({
                    url: '{{ route("add_depot") }}',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#loader').removeClass('hidden')
                    },
                    complete: function() {
                        $('#loader', addClass('hidden'))
                    },
                    success: function(response) {
                        $("#formDepot")[0].reset();
                        $("#id_depot").val(null);
                        Swal.fire({
                            icon: response.icon,
                            text: response.text
                        });
                        table.ajax.reload();
                    }
                });

        
        });
    </script>
@endpush
