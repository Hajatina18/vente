<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
        @page {
            margin: 0mm
        }
        .contenu {
            width: 100%;
        }
        body{
            font-size: .75rem
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
            padding: 0.5rem 0.25rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #000000;
        }

        .table tbody+tbody {
            border-top: 1px solid #000000;
        }
        .table-bordered {
            border: 1px solid #000000;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000000;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 1px;
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
        .font-1{
            font-size: 1.25rem;
        }
        p{
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
                    <td width="100%" class="text-center">
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
                </tr>
                <tr>
                    <td class="text-center" style="vertical-align: middle">
                        <h2 style="text-transform: uppercase; margin : 0; font-size: 1.5rem">Ticket n° {{ $commande->id_commande }}</h2>
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
                        {{-- <h4 class="font-1">Mr/Mme {{ $commande->client }}</h4> --}}
                    </td>
                </tr>
                <tr class="no-border">
                    <td width="100%" class="text-left">
                        <p>Réference : {{ strtotime($commande->created_at) }}</p>
                        <p>Date : {{ date('d/m/Y', strtotime($commande->created_at)) }}</p>
                        {{-- <p>Vendeur(se) : {{ $commande->user }}</p> --}}
                    </td>
                </tr>
            </tbody>
        </table>
        
        <div id="section_table">
            <table class="table">
                <tbody>
                    <tr class="no-border">
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="no-border">
                        <td></td>
                        <td></td>
                    </tr>
                    <?php $total = 0; ?>
                    @foreach ($paniers as $panier)
                    <tr>
                        <td>
                            {{ number_format($panier->qte_commande, 0, ',', '') }} x {{ $panier->designation }} {{ $panier->unite }}
                            <br>
                            {{ number_format($panier->prix_produit, 0, ',', ' ') }} Ar
                        </td>
                        <td class="text-right" style="vertical-align: middle">{{ number_format($panier->prix_produit*$panier->qte_commande, 0, ',', ' ') }} Ar</td>
                        <?php $total += $panier->prix_produit*$panier->qte_commande; ?>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right" style="padding: 20px 0;">
                            Total : {{ number_format($total, 0, ',', ' ') }} Ar
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>