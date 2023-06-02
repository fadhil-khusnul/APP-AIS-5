<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $vessel }}</title>
    <link href="{{ public_path('/') }}./assetS/css-surat/pdf.css" rel="stylesheet" />

</head>

<body>
    <header class="">
        <img class="header" src="{{ public_path('/') }}./assets/images/icon.png" alt="">
        <table border="0" class="left">

            <tr class="title1">
                <td>PT.AIS LOGISTIK MAKASSAR</td>
            </tr>
            <tr class="title2">
                <td>Jl.PERUMAHAN GREEN RIVER VIEW VINCA RESIDENCE</td>
            </tr>
            <tr class="title2">
                <td>BAROMBONG,TAMALATE-KOTA MAKASSAR SULAWESI SELATAN</td>
            </tr>
            <tr>
                <td>
                    0813 5570 7777 EMAIL <a href="">aislogisticmakassar@gmail.com</a>
                </td>
            </tr>

        </table>
        <hr />
    </header>


    <main>
        @if ($status_si == 'Alih-Kapal')


            @foreach ($alihs as $key => $load)
                <div>
                    <table class="sub-judul" border="0" width="100%">
                        <tr class="judul">
                            <td colspan="5" class="judul">
                                SHIPPING INSTRUCTION
                            </td>
                        </tr>
                        <tr>
                            <td colspan="" width="30%">SHIPPER</td>
                            <td width="4%">:</td>
                            <td colspan="3">{{ $shipper }}</td>
                        </tr>
                        <tr>
                            <td>CONSIGNE</td>
                            <td>:</td>
                            <td colspan="3">{{ $consigne }}</td>
                        </tr>
                        <tr>
                            <td>FEEDER</td>
                            <td>:</td>
                            <td colspan="3">{{ $load->pelayaran_alih }}</td>
                        </tr>
                        <tr>
                            <td>VESSEL</td>
                            <td>:</td>
                            <td colspan="3">{{ $load->vesseL_alih }}</td>
                        </tr>
                        <tr>
                            <td>VESSEL CODE</td>
                            <td>:</td>
                            <td colspan="3">{{ $load->code_vesseL_alih }}</td>
                        </tr>
                        <tr>
                            <td>QTY</td>
                            <td>:</td>
                            <td colspan="3"></td>
                        </tr>
                        @foreach ($quantity as $quantities)
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="3">{{ $quantities }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>CONTAINER</td>
                            <td>:</td>
                            <td colspan="3"></td>
                        </tr>

                        <tr>
                            <td align="center" valign="top">NO. CONTAINER</td>
                            <td colspan="2" align="center" valign="top">SEAL</td>
                            <td align="center" valign="top">COMMODITY</td>
                        </tr>
                        @foreach ($containers as $container)
                            <tr>
                                <td align="center" valign="top">{{ $container['nomor_kontainer'] }}</td>
                                <td colspan="2" align="center" valign="top">
                                    @foreach ($container['seal'] as $seal)
                                        @if ($loop->iteration < count($container['seal']))
                                            {{ $seal->seal_kontainer }}, &ensp;
                                        @else
                                            {{ $seal->seal_kontainer }}
                                        @endif
                                    @endforeach
                                </td>
                                <td align="center" valign="top">{{ $container['cargo'] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>PORT OF LANDING</td>
                            <td>:</td>
                            <td>
                                {{ $load->pol_alih }}
                            </td>
                        </tr>
                        <tr>
                            <td>PORT OF TRANSIT</td>
                            <td>:</td>
                            <td>
                                @if ($load->pot_alih)
                                    {{ $load->pot_alih }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>PORT OF DISCHARGE</td>
                            <td>:</td>
                            <td>
                                {{ $load->pod_alih }}
                            </td>
                        </tr>
                        <tr>
                            <td>YOURS FAITHFULLY</td>
                        </tr>
                        <tr>
                            <td><img class="ttd" src="{{ public_path('/') }}./assets/images/ttd.png" alt="">
                            </td>
                        </tr>


                    </table>
                </div>
            @endforeach
        @else
            @foreach ($loads as $key => $load)
                <div>
                    <table class="sub-judul" border="0" width="100%">
                        <tr class="judul">
                            <td colspan="5" class="judul">
                                SHIPPING INSTRUCTION
                            </td>
                        </tr>
                        <tr>
                            <td colspan="" width="30%">SHIPPER</td>
                            <td width="4%">:</td>
                            <td colspan="3">{{ $shipper }}</td>
                        </tr>
                        <tr>
                            <td>CONSIGNE</td>
                            <td>:</td>
                            <td colspan="3">{{ $consigne }}</td>
                        </tr>
                        <tr>
                            <td>FEEDER</td>
                            <td>:</td>
                            <td colspan="3">{{ $load->select_company }}</td>
                        </tr>
                        <tr>
                            <td>VESSEL</td>
                            <td>:</td>
                            <td colspan="3">{{ $load->vessel }}</td>
                        </tr>
                        <tr>
                            <td>VESSEL CODE</td>
                            <td>:</td>
                            <td colspan="3">{{ $load->vessel_code }}</td>
                        </tr>
                        <tr>
                            <td>QTY</td>
                            <td>:</td>
                            <td colspan="3"></td>
                        </tr>
                        @foreach ($quantity as $quantities)
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="3">{{ $quantities }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>CONTAINER</td>
                            <td>:</td>
                            <td colspan="3"></td>
                        </tr>

                        <tr>
                            <td align="center" valign="top">NO. CONTAINER</td>
                            <td colspan="2" align="center" valign="top">SEAL</td>
                            <td align="center" valign="top">COMMODITY</td>
                        </tr>
                        @foreach ($containers as $container)
                        <tr>
                            <td align="center" valign="top">{{ $container['nomor_kontainer'] }}</td>
                            <td colspan="2" align="center" valign="top">
                                @foreach ($container['seal'] as $seal)
                                    @if ($loop->iteration < count($container['seal']))
                                        {{ $seal->seal_kontainer }}, &ensp;
                                    @else
                                        {{ $seal->seal_kontainer }}
                                    @endif
                                @endforeach
                            </td>
                            <td align="center" valign="top">{{ $container['cargo'] }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>PORT OF LANDING</td>
                            <td>:</td>
                            <td>
                                {{ $load->pol }}
                            </td>
                        </tr>
                        <tr>
                            <td>PORT OF TRANSIT</td>
                            <td>:</td>
                            <td>
                                @if ($load->pot)
                                    {{ $load->pot }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>PORT OF DISCHARGE</td>
                            <td>:</td>
                            <td>
                                {{ $load->pod }}
                            </td>
                        </tr>
                        <tr>
                            <td>YOURS FAITHFULLY</td>
                        </tr>
                        <tr>
                            <td><img class="ttd" src="{{ public_path('/') }}./assets/images/ttd.png" alt="">
                            </td>
                        </tr>


                    </table>
                </div>
            @endforeach
        @endif

    </main>


</body>

</html>
