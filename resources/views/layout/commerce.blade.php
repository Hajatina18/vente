                <ul class="list-sidebar">
                   <li>
                   <a style="padding: 1rem ;"
                      class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                      <span><i class="la la-bars"></i></span>
                      <span class="fs-4">Dashboard</span>
                  </a>
                   </li>
                    <li class="sidebar-item">
                        <a href="{{ route('produit_com') }}" class="sidebar-link">
                            <i class="lab la-product-hunt mb-2"></i>
                            <span>Produit</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('commande_admin') }}" class="sidebar-link">
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

                <li class="dropdown sidebar-item">
                        <a href="#" class="sidebar-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="las la-house-damage mb-2"></i>
                            <span>Depots</span>
                        </a>
                        <ul class="dropdown-menu bg-secondary">
                            <li class="sidebar-item "><a href="{{ route('depot_admin') }}" aria-current="true" class="sidebar-link">Principale</a></li>
                            <li class="sidebar-item "><a href=""aria-current="true" class="sidebar-link">Deuxieme</a></li>
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
                        <a href="{{ route('logout') }}" class="sidebar-link">
                            <i class="la la-sign-out mb-2"></i>
                            <span>Se deconnecter</span>
                        </a>
                    </li>
                </ul>
            