@extends('template')

@section('content')
    <div class="commande-content w-100">
        <div class="card card-commande bg-white">
            <div class="card-body full-container">
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
                    <div class="col-12">
                        <div class="mb-3">
                            
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="card card-dashboard bg-primary">
                                        <div class="card-body ">
                                            <div class="text-dash box shadow1 ">
                                                <h3 class="text-white">CA </h3>
                                                <p class="text-white">1000</p>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 col-lg-12">
                                    <div class="card card-dashboard bg-success">
                                        <div class="card-body">
                                            <div class="text-dash box shadow2">
                                                <h3 class="text-white">CA Client</h3>
                                                <p class="text-white">200</p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 col-lg-12">
                                    <div class="card card-dashboard bg-danger">
                                        <div class="card-body">
                                            <div class="text-dash box shadow3">
                                                <h3 class="text-white">CA Fournisseur</h3>
                                                <p class="text-white">24444</p>
                                            </div>
                                        </div>
                                    </div>
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
            table = $("#liste").DataTable({
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
                sheet: 'Balance ' + (parseInt(($("#semaine").val().substring($("#semaine").val().indexOf('W') + 1,
                    $("#semaine").val().length)))) + 'e Semaine'
            });
            return XLSX.writeFile(wb, 'Balance_' + (parseInt(($("#semaine").val().substring($("#semaine").val().indexOf(
                'W') + 1, $("#semaine").val().length)))) + 'e_Semaine.xlsx');
        }
    </script>
@endpush
