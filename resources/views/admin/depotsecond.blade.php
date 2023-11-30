@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="border-solid rounded" >
                <div class="row">
                    <div class="col-12 col-md-12">
                        <!-- start modal -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div style="margin-right: 10px;" > <!-- Barre de recherche -->
                                <form action="" class="form-inline">
                                    <div class="input-group">
                                        <input type="search" class="form-control me-2" placeholder="Rechercher...">
                                        <button class="btn btn-primary" type="submit"><i class="la la-search"></i> 
                                        </button>
                                    </div>                                 
                                </form>
                            </div>
                            <div class="d-flex"> 
                                <div class="ms-3"> <!-- Bouton Ajout nouveau depot -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <div class="navi"> 
                                            <a class="navi-link" href="{{ route('depot_admin') }}">
                                                <span class="navi-icon"><i class="la la-long-arrow-alt-left"></i></span>
                                                <span class="navi-text">Retour </span>
                                            </a>
                                        </div>
                                    </button>
                                    {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <a href="{{ route('listedepot') }}" class="btn btn-info">Ajout nouveau depot</a>
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end add -->
                <!-- start table -->
                <div class="my-2 p-2 bg-body rounded shadow-sm">

                    <h4 class="text-center">Dépôt Ampopoka</h4>
                    <table class="table table-striped" id="liste">
                        <thead>
                            <th>Code Art</th> <!-- new insert -->
                            <th>Réf Bl Frns</th> <!-- new insert -->
                            <th>Fournisseur</th>
                            <th>Date Facture</th>
                            <th>Numero Facture</th>
                            <th>Bon de Livraison</th>
                            <th>P A HT</th>
                            <th>P A TTC</th>
                            <th>C Trans</th>
                            <th>C Revient</th>
                            <th>CUMP</th>
                            <th>Date Echeance</th>
                            <th>Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div> <!-- end table -->
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail de l'entrer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <p class="m-0">Code Art : <span id="" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">PCB : <span id="" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Fournisseur : <span id="frnsModal" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Ref BL FRNS : <span id="" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Date d'enregistrement: <span id="dateModal" style="font-weight: 600"></span>
                            </p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Date facture : <span id="date_factureModal" style="font-weight: 600"></span>
                            </p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Numero Facture : <span id="num_factureModal" style="font-weight: 600"></span>
                            </p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Bon de livraison : <span id="num_blModal" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">P.A HT : <span id="" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">PA TTC : <span id="" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Coût Trans : <span id="num_blModal" style="font-weight: 600"></span></p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Date Echeance : <span id="date_echeanceModal" style="font-weight: 600"></span>
                            </p>
                        </div>
                        <div class="col-12">
                            <hr style="height: 3px; width : 100%">
                            <h4 class="text-center">Liste des produits</h4>
                            <table class="table table-striped" id="listePaniers">
                                <thead>
                                    <th>Image</th>
                                    <th>Nom Produit</th>
                                    <th>Quantité</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
        </div>
    </div>

    <div class="modal fade" id="modalFrns" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Liste des fournisseurs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="listeFrns">
                        <thead>
                            <th>Nom</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($fournisseurs as $fournisseur)
                                <tr>
                                    <td>{{ $fournisseur->nom_frns }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary addFrns"
                                            data-nom="{{ $fournisseur->nom_frns }}">
                                            <i class="las la-plus-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

