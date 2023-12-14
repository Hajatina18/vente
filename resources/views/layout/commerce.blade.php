                <ul class="list-sidebar">
                   <li style="padding: 1rem ;"
                      class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                      <span><i class="la la-biking fs-5"></i></span>
                      <span class="fs-4">Commercial</span>
                  </li>
                    <li class="sidebar-item"  style=" border-top: 1px solid white;">
                        <a href="{{ route('commande') }}" class="sidebar-link">
                            <i class="lab la-product-hunt me-2"></i>
                            <span>Produit</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('commande_liste') }}" class="sidebar-link">
                            <i class="las la-shopping-bag me-2"></i>
                            <span>Commande</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('precommande') }}" class="sidebar-link">
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

                {{-- <li class="sidebar-item">
                    <a href="{{route('depots')}}" class="sidebar-link ">
                        <i class="las la-house-damage me-2"></i>
                        <span>Dépôts</span>
                    </a>
                </li> --}}

                <li class="sidebar-item">
                    <a href="{{ route('fond_caisse') }}" class="sidebar-link">
                        <i class="las la-cash-register me-2"></i>
                        <span>Fond de caisse</span>
                    </a>
                </li>
            </ul>
        </div>
