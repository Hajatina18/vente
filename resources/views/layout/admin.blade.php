              <div id="sidebar-position">
                <div
                      class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                      <span><i class="la la-bars"></i></span>
                      <span class="fs-4">Dashboard</span>
                  </a>
                  <ul class="list-sidebar nav nav-pills flex-column mb-auto">

                      <li class="sidebar-item">
                          <a href="{{ route('admin') }}" class="sidebar-link">
                              <div class="sidebar">
                                  <i class="las la-chart-line mb-2"></i>
                                  <span>Tableau de bord</span>
                              </div>
                          </a>
                      </li>
                      <div class="md-2">
                          <div class="dropdown dropdown-menu-md py-3">
                            
                              <a href="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                  id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false" class="sidebar-link dropdown-toggle text-white">
                                  <i class=" la la-clipboard-list mb-2 text-white"></i>
                                  <span class="text-white 25px">Inventaire</span> <!-- modif dernier-->
                              </a>
                              <ul class="dropdown-menu text-small shadow " aria-labelledby="dropdownUser">
                                  <li class="sidebar-item">
                                      <a href="{{ route('produit_admin') }}" class="sidebar-link dropdown-item">
                                          <div class="sidebar">
                                              <i class="lab la-product-hunt mb-2"></i>
                                              <span>Produit</span>
                                          </div>
                                      </a>
                                    </li>
                                    <li class="sidebar-item">
                                      <a href="{{ route('entrer_admin') }}" class="sidebar-link dropdown-item">
                                          <div class="sidebar">
                                              <i class="las la-truck mb-2"></i>
                                              <span>Entrée</span>
                                          </div>
                                      </a>
                                    </li>
                                  <li class="sidebar-item">
                                      <a href="{{ route('commande_admin') }}" class="sidebar-link dropdown-item">
                                          <div class="sidebar">
                                              <i class="las la-shopping-bag mb-2"></i>
                                              <span>Commande</span>
                                          </div>
                                      </a>
                                  </li>
                              </ul>
                          </div>

                          <div class="dropdown dropdown-menu-md py-3">
                              <a href="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                  id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false" class="sidebar-link dropdown-toggle text-white">
                                  <i class=" la la-clipboard-list mb-2 text-white"></i>
                                  <span class="text-white 25px">Stockage</span> <!-- modif dernier-->
                              </a>
                              <ul class="dropdown-menu text-small shadow " aria-labelledby="dropdownUser">
                                  <li class="sidebar-item">
                                      <a href="{{ route('depot_admin') }}" class="sidebar-link dropdown-item">
                                          <div class="sidebar">
                                              <i class="las la-house-damage mb-2"></i>
                                              <span>Dépôts</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="sidebar-item">
                                      <a href="{{ route('points_vente') }}" class="sidebar-link dropdown-item">
                                          <div class="sidebar">
                                              <i class="las la-house-damage mb-2"></i>
                                              <span>Points de vente </span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class=" sidebar-item">
                                      <div class="sidebar">
                                          <a href="{{ route('transfert_admin') }}" class="sidebar-link dropdown-item ">
                                              <i class="las la-share-square mb-2"></i>
                                              <span>Transferts</span>
                                          </a>
                                      </div>
                                  </li>
                              </ul>
                          </div>


                          <div class="dropdown dropdown-menu-md py-3">
                              <a href="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                  id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false" class="sidebar-link dropdown-toggle text-white">
                                  <i class="la la-cog text-white"></i>
                                  <span class="text-white 25px">Parametre</span> <!-- modif dernier-->
                              </a>
                              <ul class="dropdown-menu text-small shadow " aria-labelledby="dropdownUser">
                                  <li class="sidebar-item">
                                      <a href="{{ route('config') }}" class="sidebar-link dropdown-item">
                                          <div class="sidebar">
                                              <i class="las la-info-circle mb-2"></i>

                                          </div>
                                          Info
                                      </a>
                                  </li>
                                  <li class="sidebar-item">
                                      <a href="{{ route('user_admin') }}" class="sidebar-link dropdown-item">
                                          <div class="sidebar">
                                              <i class="las la-users mb-2"></i>
                                              Utilisateur
                                          </div>
                                      </a>
                                  </li>
                                  <li class="sidebar-item">
                                      <a href="{{ route('unite_admin') }}" class="sidebar-link dropdown-item">
                                          <div class="sidebar">
                                              <i class="las la-balance-scale mb-2"></i>
                                              <span>Unité de mesure</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="sidebar-item">
                                      <a href="{{ route('paiement_admin') }}" class="sidebar-link dropdown-item">
                                          <div class="sidebar">
                                              <i class="las la-credit-card mb-2"></i>
                                              <span>Mode de Paiement</span>
                                          </div>
                                      </a>
                                  </li>
                              </ul>

                          </div>
                      </div>

                      <li class="sidebar-item">
                          <a href="{{ route('fond_caisse') }}" class="sidebar-link">
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
                  </ul>
              </div>
