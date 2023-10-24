<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        .contenu {
            width: 100%;
        }
        table {
            border-collapse: collapse;
        }

        .table {
            width: 100%;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.5rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-bordered th,
        .table-bordered td,
        .table-bordered thead th,
        .table-bordered tbody+tbody {
            border: 1;
        }
        .text-right {
            text-align: right !important;
        }
        .text-left {
            text-align: left !important;
        }
        .text-center {
            text-align: center !important;
        }
        .no-border{
            border: 0px !important;
        }
        h1{
            font-size: 2rem;
            margin: 0 0 10px 0;
        }
        h2{
            font-size: 1.5rem;
            margin: 0 0 10px 0;
        }
        p{
            font-size: 1rem;
            margin: 0 0 10px 0;
        }
        img{
            margin: 0 0 10px 0;
        }
    </style>
</head>

<body>
    <div class="contenu">
        <table class="table">
            <tbody>
                <tr class="no-border">
                    <td width="50%" class="text-center">
                        @if ($config->logo)
                            <img src="{{ $config->logo }}" alt="" style="width: 60px;">
                        @endif
                        <h2>{{ $config->nom_magasin }}</h2>
                        @if ($config->description_magasin)
                            <p>{{ $config->description_magasin }}</p>
                        @endif
                        @if ($config->adresse_magasin)
                            <p>{{ $config->adresse_magasin }}</p>
                        @endif
                        @if ($config->telephone)
                            <p>Tel : {{ $config->telephone }}</p>
                        @endif
                        @if ($config->email)
                            <p>Email : {{ $config->email }}</p>
                        @endif
                        @if ($config->stat)
                            <p>STAT : {{ $config->stat }}</p>                        
                        @endif
                        @if ($config->nif)
                            <p>NIF : {{ $config->nif }}</p>
                        @endif
                        @if ($config->stat)
                            <p>STAT : {{ $config->stat }}</p>                        
                        @endif
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <h2 style="text-transform: uppercase; margin : 0">Facture n° {{ $commande->id_commande }}</h2>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table">
            <tbody>
                <tr class="no-border">
                    <td width="50%" class="text-left">
                        
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        {{-- <h3>Mr/Mme {{ $commande->client }}</h3> --}}
                    </td>
                </tr>
                <tr class="no-border">
                    <td width="50%" class="text-left">
                        <p>Réference : {{ strtotime($commande->created_at) }}</p>
                        <p>Date : {{ date('d/m/Y', strtotime($commande->created_at)) }}</p>
                        {{-- <p>Numéro Client : {{ $commande->id_client }}</p> --}}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="section_table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Qte</th>
                        <th>Designation</th>
                        <th>P.U</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    @foreach ($paniers as $panier)
                    <tr>
                        <td class="text-right" style="vertical-align: middle">{{ number_format($panier->qte_commande, 2, ',', '') }}</td>
                        <td>
                            {{ $panier->designation }}
                            <br>
                            {{ $panier->unite }}
                        </td>
                        <td class="text-right" style="vertical-align: middle">{{ number_format($panier->prix_produit, 2, ',', ' ') }} Ar</td>
                        <td class="text-right" style="vertical-align: middle">{{ number_format($panier->prix_produit*$panier->qte_commande, 2, ',', ' ') }} Ar</td>
                        <?php $total += $panier->prix_produit*$panier->qte_commande; ?>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right">
                            Total : {{ number_format($total, 2, ',', ' ') }} Ar
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <table class="table">
            <tbody>
                <tr class="no-border">
                    <td width="50%" class="text-left">
                        <p>En votre aimable règlement</p>
                        <p>Cordialement</p>
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
</body>

</html>