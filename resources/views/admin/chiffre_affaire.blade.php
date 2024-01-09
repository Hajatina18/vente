@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3 ">
                            <h3 for="semaine" class="form-label font-bold text-center">Chiffre d'affaire</h3>
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <button type="button" class="btn btn-outline-primary me-3 mt-md-0 mt-2"
                                        onclick="xlsx()">
                                        <i class="la la-print mr-2"></i> Exporter SAGE
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                              <h5 class="card-title mx-auto mt-1">Chiffre d'affaire des Produits</h5>
                                <div class="card-body">
                                    <!-- Bar Chart -->
                                    <canvas id="barChart" style="max-height: 200px;"></canvas>
                                   
                                    <!-- End Bar CHart -->
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-6">
                          <div class="card">
                            <h5 class="card-title mx-auto mt-1">Chiffre d'affaire Client/Fournisseur</h5>
            
                            <div class="card-body">
            
                              <!-- Line Chart -->
                              <div id="reportsChart"></div>
            
                              <canvas id="lineChart" style="max-height: 400px;"></canvas>
                              <!-- End Line Chart -->
            
                            </div>
            
                          </div>
                        </div>
                        <div class="row">
                          
                        </div>
                        <div class="col-md-12 ">
                            <div class="card card-table">
                                <div class="card-header">
                                    <h4 class="card-subtitle ">Recherche Produits Fluctuation</h4>
                                </div>
                                <div class="card-body my-2">
                                    <form action="" method="get" id="export_excel">
                                        
                                            <div class="row">
                                       
                                                <div class="col-lg-4 ml-">
                                                    <div class="row">
                                                        <label class="col-md-3 col-form-label" for="end_date">1 ère Date:</label>
                                                        <div class="col-md-6">
                                                            <input type="date" class="form-control" id="start_date"
                                                                name="start_date" value="{{ old('start_date') }}">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="row">
                                                        <label class="col-md-3 col-form-label" for="end_date">2 ème Date:</label>
                                                        <div class="col-md-6">
                                                            <input type="date" class="form-control" id="end_date"
                                                                name="end_date" value="{{ old('end_date') }}">

                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="col-lg-4">
                                                    <button class="btn btn-sm btn-primary p-2" type="submit"> <i
                                                            class="fe fe-search"></i> Recherche</button>
                                                </div>
                                            </div>



                                        </div>

                                    </form>
                                      <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0" id="table">
                                            <thead>
                                                <th>Nom Produit</th>
                                                <th>Quantité</th>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>
                              
                           

                        </div>



                    </div>
                </div>
            </div>
          </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/shim.min.js') }}"></script>
    <script src="{{ asset('js/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('js/blob.js') }}"></script>
    <script src="{{ asset('js/filesaver.js') }}"></script>
    <script type="text/javascript">
        $("document").ready(function() {
            table = $("#table").DataTable({
                "language": {
                    url: "{{ asset('datatable/french.json') }}"
                }
            });
        });
        $("#semaine").on('change', function() {
            window.location.href = "{{ route('getWeek') }}/" + $(this).val();
        });

        function xlsx() {
            var table = document.getElementById('export_excel');
            var wb = XLSX.utils.table_to_book(table, {
                sheet: 'Chiffre d\'affaire  ' 
            });
            return XLSX.writeFile(wb, 'Chiffre d\'affaire');
        }
    </script>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            new Chart(document.querySelector('#lineChart'), {
              type: 'line',
              data: {
                labels: ['Janvier ', 'Fevrier ', 'Mars', 'Avril', 'Mai', 'Juin'],
                datasets: [{
                  label: ['Client', ],
                  data: [65, 59, 80, 81, 56, 55, 40],
                  fill: false,
                  borderColor: 'rgb(75, 192, 192)',
                  tension: 0.1
                },
                {
                  label: ['Fournisseurs'],
                  data: [60, 45, 75, 69, 36, 75, 60],
                  fill: false,
                  borderColor: 'rgba(255, 159, 164)',
                  tension: 0.1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          });
        </script>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            new Chart(document.querySelector('#barChart'), {
              type: 'bar',
              data: {
                 labels: ['Janvier ', 'Fevrier ', 'Mars', 'Avril', 'Mai', 'Juin'],
                datasets: [{
                  label: 'Produit 1',
                  data: [65, 59, 80, 81, 56, 55, 40],
                  backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                  ],
                  borderColor: [
                    'rgb(75, 192, 192)',
                    
                  ],
                  borderWidth: 1
                },
                {
                  label: 'Produit 2',
                  data: [60, 45, 75, 69, 36, 75, 60],
                  backgroundColor: [
                          'rgba(255, 159, 64, 0.2)',
                  ],
                  borderColor: [
                   
                    'rgb(255, 159, 64)'
                  ],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          });
        </script>
@endpush    
