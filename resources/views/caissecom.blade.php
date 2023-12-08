@extends('template')

@section("content")
<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <h4 class="text-center">Total caisse du <?php setlocale(LC_ALL, 'fr_FR.utf8', 'FRA'); echo ucfirst(utf8_encode(strftime('%A %d %B %Y', strtotime(date('Y-m-d'))))) ?></h4>
            <div class="row">
                <div class="col-md-4 col-12 col-lg-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <div class="text-dash">
                                <h3>Fond de caisse</h3>
                                <p>{{ number_format($caisse->total, 2, ',', ' ') }} Ar</p>
                            </div>
                            <div class="icon-dash">
                                <i class="las la-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 col-lg-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <div class="text-dash">
                                <h3>Commande du jour</h3>
                                <p>{{ number_format($commande->total, 2, ',', ' ') }} Ar</p>
                            </div>
                            <div class="icon-dash">
                                <i class="las la-tachometer-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 col-lg-4">
                    <div class="card card-dashboard">
                        <div class="card-body">
                            <div class="text-dash">
                                <h3>Total du jour</h3>
                                <p>{{ number_format($total, 2, ',', ' ') }} Ar</p>
                            </div>
                            <div class="icon-dash">
                                <i class="las la-receipt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h4 class="text-center">Liste des commandes de {{ auth()->user()->nom }}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="text-center">
                                <th>Date</th>
                                <th>Client</th>
                                <th>Total</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($commandes as $item)
                                    <tr>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->client }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td><a href="javascript:void(0)" class="badge bg-primary p-2" onclick="getDetail('{{ $item->id_commande }}')">Détail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail de la commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="m-0">Client : <span id="clientModal"></span></p>
                    </div>
                    <div class="col-12 mb-2">
                        <p class="m-0">Date : <span id="dateModal"></span></p>
                    </div>
                    <div class="col-12">
                        <hr style="height: 3px; width : 100%">
                        <h4 class="text-center">Liste des produits</h4>
                        <table class="table table-striped" id="listePaniers">
                            <thead>
                                <th>Image</th>
                                <th>Nom Produit</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Prix Total</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection