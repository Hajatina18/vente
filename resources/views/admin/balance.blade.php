@extends('template')

@section('content')
<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="semaine" class="form-label">Semaine</label>
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <input type="week" class="form-control" id="semaine" name="week" value="{{ $week }}">
                            </div>
                            <div class="col-12 col-lg-4">
                                <button type="button" class="btn btn-outline-primary me-3 mt-md-0 mt-2" onclick="xlsx()">
                                    <i class="la la-print mr-2"></i> Exporter Excel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <h3 class="text-center m-0">Balance de la semaine {{ substr($week, strpos($week, 'W')+1, strlen($week)) }}</h3>
                    <hr style="height: 2px">
                    <table class="table table-stripped w-100" id="liste">
                        <thead class="text-center">
                            <th>Produit</th>
                            <th>Stock Initial</th>
                            <th>Stock Week</th>
                            <th>Entrée</th>
                            <th>Sortie</th>
                            <th>Solde</th>
                        </thead>
                        <tbody>
                            @foreach ($produits as $produit)
                                <tr>
                                    <td>{{ $produit->nom_prod }}</td>
                                    <td class="text-end">{{ number_format($produit->stock_initial, 2, ',' ,' ').' '.$produit->unite.'(s)' }}</td>
                                    <td class="text-end">{{ number_format($produit->stock_week, 2, ',' ,' ').' '.$produit->unite.'(s)'  }}</td>
                                    <td class="text-end">{{ number_format($produit->entrer, 2, ',' ,' ').' '.$produit->unite.'(s)'  }}</td>
                                    <td class="text-end">{{ number_format($produit->sortie, 2, ',' ,' ').' '.$produit->unite.'(s)'  }}</td>
                                    <td class="text-end">{{ number_format($produit->qte_stock, 2, ',' ,' ').' '.$produit->unite.'(s)'  }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table class="table table-stripped d-none" id="export_excel">
                        <thead class="text-center">
                            <tr>
                                <th colspan="8"><center><h4>Balance de la {{ substr($week, strpos($week, 'W')+1, strlen($week)) }}<sup>e</sup>  Semaine</h4></center></th>
                            </tr>
                            <tr>
                                <th>Produit</th>
                                <th>Unite de stock</th>
                                <th>Stock Initial</th>
                                <th>Stock Week</th>
                                <th>Entrée</th>
                                <th>Sortie</th>
                                <th>Solde</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produits as $produit)
                                <tr>
                                    <td>{{ $produit->nom_prod }}</td>
                                    <td>{{ $produit->unite }}</td>
                                    <td class="text-end">{{ $produit->stock_initial }}</td>
                                    <td class="text-end">{{ $produit->stock_week }}</td>
                                    <td class="text-end">{{ $produit->entrer }}</td>
                                    <td class="text-end">{{ $produit->sortie }}</td>
                                    <td class="text-end">{{ $produit->qte_stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    $("document").ready(function(){
        table = $("#liste").DataTable({
            "language": {
                url: "{{ asset('datatable/french.json') }}"
            }
        });
    });
    $("#semaine").on('change', function(){
        window.location.href = "{{ route('getWeek') }}/"+$(this).val();
    });
    
    function xlsx() {
        var table = document.getElementById('export_excel');
        var wb = XLSX.utils.table_to_book(table, {sheet: 'Balance '+(parseInt(($("#semaine").val().substring($("#semaine").val().indexOf('W')+1, $("#semaine").val().length))))+'e Semaine'});
        return XLSX.writeFile(wb, 'Balance_'+(parseInt(($("#semaine").val().substring($("#semaine").val().indexOf('W')+1, $("#semaine").val().length))))+'e_Semaine.xlsx');
    }
</script>
@endpush