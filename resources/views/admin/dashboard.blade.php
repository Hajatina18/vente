@extends('template')

@section("content")
<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-12 col-lg-3">
                    <div class="card card-dashboard bg-primary">
                        <div class="card-body ">
                            <div class="text-dash box shadow1 ">
                                <h3 class="text-white">Total Journalier</h3>
                                <p class="text-white">{{ number_format($jour[0]->total, 2, ',', ' ') }} Ar</p>
                            </div>
                            <div class="icon-dash">
                                <i class="las la-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 col-lg-3">
                    <div class="card card-dashboard bg-success">
                        <div class="card-body">
                            <div class="text-dash box shadow2">
                                <h3 class="text-white">Commande du jour</h3>
                                <p class="text-white">{{ number_format($nombre[0]->nombre, 0, ',', ' ') }}</p>
                            </div>
                            <div class="icon-dash">
                                <i class="las la-tachometer-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 col-lg-3">
                    <div class="card card-dashboard bg-secondary">
                        <div class="card-body">
                            <div class="text-dash box shadow3">
                                <h3 class="text-white">Total du mois</h3>
                                <p class="text-white">{{ number_format($month[0]->total, 2, ',', ' ') }} Ar</p>
                            </div>
                            <div class="icon-dash">
                                <i class="las la-receipt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 col-lg-3">
                    <div class="card card-dashboard bg-info">
                        <div class="card-body">
                            <div class="text-dash box shadow4">
                                <h3 class="text-white">Client du mois</h3>
                                <p class="text-white">{{ number_format($client[0]->nombre, 0, ',', ' ') }}</p>
                            </div>
                            <div class="icon-dash">
                                <i class="las la-tachometer-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 m-0 mt-3 mb-2">
                    <h3 class="text-center">Liste des produits en rupture de stock</h3>
                    <table class="table table-stripped">
                        <thead>
                            <th>Nom Produit</th>
                            <th>Quantité en stock</th>
                        </thead>
                        <tbody>
                            @foreach ($produits as $produit)
                                <tr>
                                    <td>{{ $produit->nom_prod }}</td>
                                    <td>{{ $produit->qte_stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 m-0 mt-3 mb-2">
                    <h3 class="text-center">Liste des factures en echeance</h3>
                    <table class="table table-stripped">
                        <thead>
                            <th>Date Echeance</th>
                            <th>Fournisseur</th>
                            <th>Numéro Facture</th>
                            <th>Bon de livraison</th>
                        </thead>
                        <tbody>
                            @foreach ($entrers as $entrer)
                                <tr>
                                    <td>{{ $entrer->date_echeance }}</td>
                                    <td>{{ $entrer->nom_frns }}</td>
                                    <td>{{ $entrer->num_facture }}</td>
                                    <td>{{ $entrer->num_bl }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("js")
    <script>
        $(document).ready(function(){
            $(".table").DataTable({
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                },
            });
        })
    </script>
@endpush