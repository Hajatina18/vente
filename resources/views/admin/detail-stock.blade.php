@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="border-solid rounded">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <!-- start modal -->
                        <div class="d-flex justify-content-between align-items-center">
                                <div class="m-3">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <div class="navi"> 
                                            <a class="navi-link" href="{{ route('list_depot') }}">
                                                <span class="navi-icon"><i class="la la-list-ul text-white"></i></span>
                                                <span class="navi-text">Voir les listes dépôts</span>
                                            </a>
                                        </div>
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>

                <!-- end add -->
                <!-- start table -->
                <div class="col-12 col-md-11 col-lg-11 ps-4 item-center">
                    <h4 class="text-center fs-3">Liste des produits en stock  <span class="fs-6">(Dépot à {{$depot->localisation}})</span></h4>
                     <div id="product">
                          @include('pages.partials.stock-produit')
                     </div> 
                </div>
               
                <!-- end table -->
            </div>
        </div>
    </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        
        var table;
        var prod = "<option></option>";
        @foreach ($produits as $produit)
            prod += '<option value="{{ $produit->ref_prod }}">{{ $produit->nom_prod }}</option>';
        @endforeach

         var id = <?php echo json_encode($depot->id_depot) ?>
      
      
        $("document").ready(function(){
            table = $("#liste").DataTable({
                "ajax" : {
                    "url" : `/admin/depots/${id}/stock`,
                    "dataSrc" : ""
                },
                "columns" : [
                    {data:'ref_prod'},
                     {data:'image_prod'},
                   {data:'nom_prod'},
                    {data:'qte_stock'},
                    {data:'unite'},
                    {data:'action'}
                ],
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                }
            });
        });
    </script>
@endpush
