<ul class="list-sidebar">
    <li style="padding: 0.5rem ;"
        class="d-flex align-items-center me-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span><i class="me-2 la la-store-alt fs-4"></i></span>
        <span class="fs-4">Caissier</span>
   </li>
   <li class="sidebar-item"  style=" border-top: 1px solid white;">
        <a href="{{ route('commande') }}" class="sidebar-link">
            <i class="lab la-product-hunt me-2"></i>
            <span>Produit</span>
        </a>
    </li>
    <li class="sidebar-item" style=" border-top: 1px solid white;">
        <a href="{{ route('commande_liste') }}" class="sidebar-link">
            <i class="las la-shopping-bag me-2"></i>
            <span>Commande</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="{{ route('precommande.index') }}" class="sidebar-link">
            <i class="las la-list-alt me-2"></i>
            <span>Pre-commande</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="{{ route('caisse') }}" class="sidebar-link">
            <i class="las la-cash-register me-2"></i>
            <span>Caisse</span>
        </a>
    </li>
</ul>