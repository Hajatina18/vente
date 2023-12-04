
<div id="sidebar-position">
    <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"> 
        <span><i class="la la-home"></i></span>
        <span class="fs-4 color-white">Vente</span>
    </div>    
    <ul class="list-sidebar">
        <li class="sidebar-item">
            <a href="{{ route('commande') }}" class="sidebar-link">
                <i class="las la-shopping-bag mb-2"></i>
                <span>Commande</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('precommande.index') }}" class="sidebar-link">
                <i class="las la-list-alt mb-2"></i>
                <span>Pre-commande</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('caisse') }}" class="sidebar-link">
                <i class="las la-cash-register mb-2"></i>
                <span>Caisse</span>
            </a>
        </li>
    
        
    </ul>
</div>    