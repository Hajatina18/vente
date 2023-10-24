@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <form method="POST" id="formUnite" enctype="multipart/form-data" action="{{ route('add_config') }}">
                            @csrf
                            <h4 class="text-center">Configuration du magasin</h4>
                            <div class="mb-2">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ $config != null ? $config->nom_magasin : "" }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $config != null ? $config->description : "" }}">
                            </div>
                            <div class="mb-2">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $config != null ? $config->adresse : "" }}">
                            </div>
                            <div class="mb-2">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" value="{{ $config != null ? $config->telephone : "" }}">
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $config != null ? $config->email : "" }}">
                            </div>
                            <div class="mb-2">
                                <label for="nif" class="form-label">NIF</label>
                                <input type="text" class="form-control" id="nif" name="nif" value="{{ $config != null ? $config->nif : "" }}">
                            </div>
                            <div class="mb-2">
                                <label for="stat" class="form-label">STAT</label>
                                <input type="text" class="form-control" id="stat" name="stat" value="{{ $config != null ? $config->stat : "" }}">
                            </div>
                            <div class="mb-2">
                                <label for="rcs" class="form-label">RCS</label>
                                <input type="text" class="form-control" id="rcs" name="rcs" value="{{ $config != null ? $config->rcs : "" }}">
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                <input class="form-control" type="file" id="logo" name="logo">
                            </div>
                            <button type="submit" class="btn btn-outline-primary">
                                Enregistrer
                            </button>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center">Information du magasin</h3>
                                <table class="table table-condensed">
                                    <tbody>
                                        <tr>
                                            <td class="align-middle"><h4 class="m-0">Nom</h4></td>
                                            <td class="align-middle"><h4 class="m-0">{{ $config != null ? $config->nom_magasin : "" }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle"><h4 class="m-0">Adresse</h4></td>
                                            <td class="align-middle"><h4 class="m-0">{{ $config != null ? $config->adresse_magasin : "" }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle"><h4 class="m-0">Description</h4></td>
                                            <td class="align-middle"><h4 class="m-0">{{ $config != null ? $config->description_magasin : "" }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle"><h4 class="m-0">Téléphone</h4></td>
                                            <td class="align-middle"><h4 class="m-0">{{ $config != null ? $config->telephone : "" }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle"><h4 class="m-0">Email</h4></td>
                                            <td class="align-middle"><h4 class="m-0">{{ $config != null ? $config->email : "" }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle"><h4 class="m-0">NIF</h4></td>
                                            <td class="align-middle"><h4 class="m-0">{{ $config != null ? $config->nif : "" }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle"><h4 class="m-0">STAT</h4></td>
                                            <td class="align-middle"><h4 class="m-0">{{ $config != null ? $config->stat : "" }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle"><h4 class="m-0">RCS</h4></td>
                                            <td class="align-middle"><h4 class="m-0">{{ $config != null ? $config->rcs : "" }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle"><h4 class="m-0">Logo</h4></td>
                                            <td class="align-middle"><img src="{{ $config != null ? asset($config->logo) : "" }}" alt="" style="width: 100px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
