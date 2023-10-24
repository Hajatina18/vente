<div class="row mx-0">
    @foreach ($produits as $produit)
        <div class="col-12 col-md-6 col-lg-3 mx-0 mb-2">
            <div class="product-box" onclick='addPanier("{{ $produit->ref_prod }}","{{ $produit->nom_prod }}","{{ $produit->prix }}","{{ $produit->id_unite }}","{{ $produit->unite }}","{{ url($produit->image_prod) }}")'>
                <img src="{{ url($produit->image_prod) }}" class="product-img" alt="">
                <div class="product-info">
                    <p class="product-name m-0">{{ $produit->nom_prod }}</p>
                    <p class="product-price-unity m-0">{{ number_format($produit->prix, 2, ',', ' ').' Ar' }} / {{ $produit->unite }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>