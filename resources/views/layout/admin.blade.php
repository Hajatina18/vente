                <ul class="list-sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('admin') }}" class="sidebar-link">
                            <i class="las la-chart-line mb-2"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('config') }}" class="sidebar-link">
                            <i class="las la-info-circle mb-2"></i>
                            <span>Info</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('user_admin') }}" class="sidebar-link">
                            <i class="las la-users mb-2"></i>
                            <span>Utilisateur</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('unite_admin') }}" class="sidebar-link">
                            <i class="las la-balance-scale mb-2"></i>
                            <span>Unité de mesure</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('paiement_admin') }}" class="sidebar-link">
                            <i class="las la-credit-card mb-2"></i>
                            <span>Mode de Paiement</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('produit_admin') }}" class="sidebar-link">
                            <i class="lab la-product-hunt mb-2"></i>
                            <span>Produit</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('entrer_admin') }}" class="sidebar-link">
                            <i class="las la-truck mb-2"></i>
                            <span>Entrée</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('commande_admin') }}" class="sidebar-link">
                            <i class="las la-shopping-bag mb-2"></i>
                            <span>Commande</span>
                        </a>
                    </li>

                <li class="dropdown sidebar-item">
                        <a href="#" class="sidebar-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="las la-house-damage mb-2"></i>
                            <span>Depots</span>
                        </a>
                        <ul class="dropdown-menu bg-secondary">
                            <li class="sidebar-item "><a href="{{ route('depot_admin') }}" aria-current="true" class="sidebar-link">Principale</a></li>
                            <li class="sidebar-item "><a href="{{ route('depot_second') }}" aria-current="true" class="sidebar-link">Deuxieme</a></li>
                            <li class="sidebar-item "><a href="" class="sidebar-link">Magasin</a></li>
                        </ul>
                    </li>

                    <li class=" sidebar-item">
                        <a href="{{ route('transfert_admin') }}" class="sidebar-link " >
                            <i class="las la-share-square mb-2"></i>
                            <span>Transfert</span>
                        </a>
                    </li>  
                
                    <li class="sidebar-item">
                        <a href="{{route('fond_caisse')}}" class="sidebar-link">
                            <i class="las la-cash-register mb-2"></i>
                            <span>Fond de caisse</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('balance') }}" class="sidebar-link">
                            <i class="las la-clipboard-list mb-2"></i>
                            <span>Balance</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('logout') }}" class="sidebar-link">
                            <i class="la la-sign-out mb-2"></i>
                            <span>Se deconnecter</span>
                        </a>
                    </li>
                </ul>
            