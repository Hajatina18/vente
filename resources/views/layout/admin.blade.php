           <!--   <div id="sidebar-position">-->
                 
                  <ul class="list-sidebar nav nav-pills flex-column mb-auto">
                    <li style="padding: 0.5rem ;"
                      class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                     <i class="la la-user-shield me-2 fs-4"></i>
                      <span class="fs-4">Admin</span>
                  </li>
                      <li class="sidebar-item" style=" border-top: 1px solid white;">
                          <a href="{{ route('admin') }}" class="sidebar-link">
                              <div class="sidebar">
                                  <i class="las la-chart-line me-2"></i>
                                  <span>Tableau de bord</span>
                              </div>
                          </a>
                      </li>
                     <div class="accordion accordion-flush w-100 " id="accordionExample">
                        <li class="accordion-item ">
                            <h2 class="accordion-header " id="headingOne">
                                <a class="accordion-button  collapsed  bg-layout"  data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">   
                                <i class=" la la-clipboard-list me-2 text-white"></i>
                                    <span class="text-white 25px">Stockage</span>
                                </a>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                              <ul class="accordion-body text-small shadow bg-layout" >
                                  <li class="sidebar-item">
                                      <a href="{{ route('depot_admin') }}" class="sidebar-link ">
                                          <div class=""> 
                                              <i class="las la-house-damage me-2"></i>
                                              <span>Dépôts</span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="sidebar-item">
                                      <a href="{{ route('points_vente') }}" class="sidebar-link">
                                          <div class="">
                                              <i class="las la-house-damage me-2"></i>
                                              <span>Points de vente </span>
                                          </div>
                                      </a>
                                  </li>
                                  <li class=" sidebar-item">
                                      <div class="">
                                          <a href="{{ route('transfert_admin') }}" class="sidebar-link ">
                                              <i class="las la-share-square me-2"></i>
                                              <span>Transferts</span>
                                          </a>
                                      </div>
                                  </li>
                              </ul>
                            </div>
                        </li>
                        <li class="accordion-item">
                            <h2 class="accordion-header " id="headingTwo">
                              <a data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#collapseTwo"  class="accordion-button collapsed  bg-layout" >
                                  <i class=" la la-clipboard-list me-2 text-white"></i>
                                  <span class="text-white 25px">Inventaire</span> <!-- modif dernier-->
                              </a>
                            </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse " aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                              <ul class="accordion-body text-small shadow bg-layout">
                                  <li class="sidebar-item">
                                      <a href="{{ route('produit_admin') }}" class="sidebar-link ">
                                          <div class="">
                                              <i class="lab la-product-hunt me-2"></i>
                                              <span>Produit</span>
                                          </div>
                                      </a>
                                    </li>
                                    <li class="sidebar-item">
                                      <a href="{{ route('entrer_admin') }}" class="sidebar-link ">
                                          <div class="">
                                              <i class="las la-truck me-2"></i>
                                              <span>Entrée</span>
                                          </div>
                                      </a>
                                    </li>
                                  <li class="sidebar-item">
                                      <a href="{{ route('commande_liste') }}" class="sidebar-link ">
                                          <div class="">
                                              <i class="las la-shopping-bag me-2"></i>
                                              <span>Commande</span>
                                          </div>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                        </li>

                        <li class="accordion-item">
                            <h2 class="accordion-header " id="headingThree">
                                <a class="accordion-button collapsed  bg-layout"  data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">   
                                   <i class="la la-cog text-white"></i>
                                    <span class="text-white 25px">Parametre</span>
                                </a>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse " aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                              <ul class="accordion-body text-small shadow bg-layout" >
                             
                                    <li class="sidebar-item">
                                        <a href="{{ route('user_admin') }}" class="sidebar-link ">
                                            <div class="sidebar">
                                                <i class="las la-users me-2"></i>
                                                Utilisateur
                                            </div>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('unite_admin') }}" class="sidebar-link ">
                                            <div class="sidebar">
                                                <i class="las la-balance-scale me-2"></i>
                                                <span>Unité de mesure</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('paiement_admin') }}" class="sidebar-link ">
                                            <div class="sidebar">
                                                <i class="las la-credit-card "></i>
                                                <span>Mode de Paiement</span>
                                            </div>
                                        </a>
                                    </li>
                              </ul>
                            </div>
                        </li>

                      
                     </div>
                    
                      <li class="sidebar-item"  style=" border-top: 1px solid white;">
                          <a href="{{ route('fond_caisse') }}" class="sidebar-link">
                              <div class="sidebar">
                                  <i class="las la-cash-register me-2"></i>
                                  <span>Fond de caisse</span>
                              </div>
                          </a>
                      </li>


                      <li class="sidebar-item">
                          <a href="{{ route('balance') }}" class="sidebar-link">
                              <div class="sidebar">
                                  <i class="las la-clipboard-list me-2"></i>
                                  <span>Balance</span>
                              </div>
                          </a>
                      </li>
                  </ul>
    <!--</div>-->
