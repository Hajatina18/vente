@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <form method="POST" id="formUser">
                            @csrf
                            <h4 class="text-center">Formulaire Depot </h4>
                            <div class="mb-2">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                                <input type="hidden" class="form-control" id="" name="">
                            </div>
                            <div class="mb-2">
                                <label for="nom" class="form-label">Localisation</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            
                            
                            <button type="submit" class="btn btn-outline-primary">
                                Ajouter
                            </button>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 col-lg-8">
                        <h4 class="text-center">Liste des Utilisateurs</h4>
                        <table class="table table-striped" id="">
                            <thead>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Localisation</th>
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


