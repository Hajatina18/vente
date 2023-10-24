@extends('template')

@section('content')
<style>
    .precommandes {
        padding: 20px 50px;
    }
    .precommande {
        box-shadow: 0px 0px 10px 5px #00000042;
        padding: 15px 10px
    }
</style>
<div class="commande-content w-100">
    <div class="card card-commande bg-white">
        <div class="card-body">
            <h4 class="text-center">Liste des commandes non validés</h4>
            <div class="precommandes row">
                @foreach ($precommandes as $item)
                <div class="col-12">
                    <div class="precommande">
                        <div class="row d-flex align-items-center">
                            <div class="col-4 date_commande">
                                <h4>{{ ucfirst(strftime("%d %B %Y %H:%I:%S", strtotime($item->date_pre_commande))) }}</h4>
                            </div>
                            <div class="col-4">
                                <h3 class=" text-end">{{ number_format($item->sums(), 0, ',', ' ') }} Ar</h3>
                            </div>
                            <div class="col-4 text-end">
                                <button class="btn btn-primary"  data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id_pre_commande }}">Détail</button>
                                <button class="btn btn-success edit_precommande" data-id='{{ $item->id_pre_commande }}'>Modifier</button>
                                <button class="btn btn-success validate_commande" data-id='{{ $item->id_pre_commande }}'>Valider</button>
                            </div>
                        </div>
                        <div class="collapse" id="collapse{{ $item->id_pre_commande }}">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="60%">Designation</th>
                                        <th>Quantité</th>
                                        <th>Prix Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->paniers as $panier)
                                        <tr>
                                            <td>{{ $panier->produit->nom_prod }}</td>
                                            <td>{{ $panier->qte_commande.' '.$panier->unite->unite.($panier->qte_commande > 1 ? "s" : "") }}</td>
                                            <td class=" text-end">{{ number_format($panier->qte_commande*$panier->prix_produit, 0, ',', ' ') }} Ar</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="validateCommande" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Valider la commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mx-0 mb-2 border-bottom py-2 px-1">
                        <div class="d-flex align-items-center justify-content-between form-group">
                            <label for="mode">Mode de paiement</label>
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                @foreach ($modes as $mode)
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="mode" id="mode{{ $mode->id_mode }}" value="{{ $mode->id_mode }}">
                                        <label class="form-check-label" for="mode{{ $mode->id_mode }}">
                                            {{ $mode->mode_paiement }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mx-0 mb-2 border-bottom pb-2">
                        <div class="d-flex align-items-center justify-content-between form-group">
                            <label for="mode">Client</label>
                            <div class="d-flex align-items-center justify-content-between">
                                <input type="text" class="form-control" id="clientName" name="nom_client">
                                <input type="hidden" class="form-control" id="precommandeID" name="precommandeID">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" id="sendCommande">Valider la Commande</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(function(){
            $('.edit_precommande').off().on('click', function(e){
                window.location.href = `{{ route("commande") }}/${$(this).data('id')}`;
            });
            $(".validate_commande").off().on('click', function(e){
                $("#precommandeID").val($(this).data('id'))
                $("#validateCommande").modal('show');
            })
            $("#sendCommande").off().on('click', function(e){
                if ($("input[name=mode]:checked").val()) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('precommande.transfert_commande') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            mode: $("input[name=mode]:checked").val(),
                            client: $("#clientName").val(),
                            precommande: $("#precommandeID").val()
                        },
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        complete : function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').addClass('hidden')
                        },
                        dataType: "json",
                        success: function (response) {
                            $("#validateCommande").modal('hide');
                            Swal.fire({
                                icon: "success",
                                text: "La commande est effectuée",
                                showCancelButton: true,
                                showDenyButton: true,
                                confirmButtonColor: '#3085d6',
                                denyButtonColor: '#00b5ff',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Imprimer ticket',
                                denyButtonText: 'Imprimer Facture',
                                cancelButtonText: 'Fermer'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.open("{{ route('ticket') }}?id="+response.id_commande, '_blank');
                                    window.location.reload();
                                }else if(result.isDenied){
                                    window.open("{{ route('facture') }}?id="+response.id_commande, '_blank');
                                    window.location.reload();
                                }else{
                                    window.location.reload();
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire(
                        '',
                        'Choisissez un mode de paiement',
                        'warning'
                    );
                }
            });
        })
    </script>
@endpush