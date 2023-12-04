@extends('template')

@section('content')
<div class="commande-content">
    <div class="card bg-white">
        <div class="card-body">
            <div class="row mx-0">
                <div class="col-12  mb-4 d-flex align-items-center border-bottom border-dark justify-content-between">
                    <h4>Touts Produits</h4>
                    
                    <form action="#" id="formSearch">
                        <div class="form-group mb-2">
                            <input type="text" name="recherche" id="recherche" class="form-control">
                            <i class="las la-search"></i>
                        </div>
                    </form>
                </div>
                <table class="table table-striped" id="">
                    <thead>
                        <th>Code Art</th> 
                        <th>Designation</th> 
                        <th>Quantite</th>
                        <th>Prix</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
<div class="panier-content border">
    <div class="row mx-0">
        <div class="col-12 mx-0 mb-2 p-0" id="">
            <h5 class="text-center mt-2 mb-0">Panier</h5>
            <hr class="my-2">
             
                    <div class="panier-item mb-2" data-id="">
                        <img src="" class="panier-item-img" alt="">
                        <div class="product-info">
                            <p class="product-name m-0" data-id=""></p>
                            <p class="product-price-unity m-0"  data-price="" data-unity=""></p>
                        </div>
                        <div class="panier-item-qty">
                            <input type="number" class="form-control qte-product" name="panier-qty" data-val="">
                        </div>
                        <div class="total-product">
                            <span class="total"></span> 
                        </div>
                        <a href="javascript:void(0)" type="button" class="bagde bg-secondary delete">
                            <i class="las la-trash"></i>
                        </a>
                    </div>
        
        </div>
        <div class="col-12 mx-0 mb-2 border-bottom py-2 px-1">
            <div class="d-flex align-items-center justify-content-between form-group">
                <label for="mode">Mode de paiement</label>
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                   
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" name="" id="mode" value="">
                            <label class="form-check-label" for="mode">
                    
                            </label>
                        </div>
                   
                </div>
            </div>
        </div>
        <div class="col-12 mx-0 mb-2 border-bottom pb-2">
            <div class="d-flex align-items-center justify-content-between form-group">
                <label for="mode">Client</label>
                <div class="d-flex align-items-center justify-content-between">
                    <input type="text" class="form-control" id="clientName" name="nom_client">
                    <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#modalClient"><i class="las la-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-12 mx-0 border-top border-2 border-dark">
            <div class="d-flex align-items-center justify-content-between py-2">
                <h5 class="m-0">Total</h5>
                <p class="m-0" id=""> Ar</p>
            </div>
        </div>
        <div class="col-12 mx-0 border-top border-2 border-dark pt-2">
            <button type="button" class="btn btn-outline-success" onclick="">Enregistrer la Commande</button>
            <button type="button" class="btn btn-outline-primary" onclick="">Valider la commande</button>
        </div>
    </div>
</div>

<div class="modal fade" id="modalClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Liste des Clients</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped w-100" id="listeClient">
                    <thead>
                        <th>Nom</th>
                        <th></th>
                    </thead>
                    <tbody>
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
