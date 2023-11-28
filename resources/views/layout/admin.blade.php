                <ul class="list-sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('admin') }}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="las la-chart-line mb-2"></i>
                                <span>Tableau de bord</span>
                            </div>
                            *  
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('config') }}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="las la-info-circle mb-2"></i>
                                <span>Info</span>
                            </div>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('user_admin') }}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="las la-users mb-2"></i>
                                <span>Utilisateur</span>
                            </div>                           
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('unite_admin') }}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="las la-balance-scale mb-2"></i>
                                <span>Unité de mesure</span>
                            </div>                           
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('paiement_admin') }}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="las la-credit-card mb-2"></i>
                                <span>Mode de Paiement</span>
                            </div>                           
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('produit_admin') }}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="lab la-product-hunt mb-2"></i>
                                <span>Produit</span>
                            </div>                         
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('entrer_admin') }}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="las la-truck mb-2"></i>
                            <span>Entrée</span>
                            </div>                            
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('commande_admin') }}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="las la-shopping-bag mb-2"></i>
                                <span>Commande</span>
                            </div>                           
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
                        <div class="sidebar">
                            <a href="{{ route('transfert_admin') }}" class="sidebar-link " >
                                <i class="las la-share-square mb-2"></i>
                                <span>Transfert</span>
                            </a>   
                        </div>                       
                    </li>  
                
                    <li class="sidebar-item">
                        <a href="{{route('fond_caisse')}}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="las la-cash-register mb-2"></i>
                            <span>Fond de caisse</span>
                            </div>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('balance') }}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="las la-clipboard-list mb-2"></i>
                                <span>Balance</span>
                            </div>                         
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('logout') }}" class="sidebar-link">
                            <div class="sidebar">
                                <i class="la la-sign-out mb-2"></i>
                                <span>Se deconnecter</span>
                            </div>
                            
                        </a>
                    </li>
                </ul>
            