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
    <li class="sidebar-item">
        <a href="{{ route('entrer_admin') }}" class="sidebar-link">
            <i class="las la-truck mb-2"></i>
            <span>Entrer</span>
        </a>
    </li>
    <li class="sidebar-item position-fixed bottom-0">
        <a href="{{ route('logout') }}" class="sidebar-link">
            <i class="la la-sign-out mb-2"></i>
            <span>Se deconnecter</span>
        </a>
    </li>
</ul>