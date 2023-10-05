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
            <tr><td>
                0813 5570 7777 EMAIL <a href="">aislogisticmakassar@gmail.com</a>
                </td>
            </tr>

        </table>
        <hr />
    </header>


    <main>
        @if ($status_si == "Alih-Kapal")


        @foreach ($alihs as $key => $load)
            <div>
                <table class="sub-judul" width="100%">
                    <tr class="judul">
                        <td colspan="7" class="judul">
                            SHIPPING INSTRUCTION
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" width="20%">SHIPPER</td>
                        <td width="4%">:</td>
                        <td colspan="3">{{ $shipper }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">CONSIGNE</td>
                        <td>:</td>
                        <td colspan="3">{{ $consigne }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">FEEDER</td>
                        <td>:</td>
                        <td colspan="3">{{$load->pelayaran_alih}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">VESSEL</td>
                        <td>:</td>
                        <td colspan="3">{{ $load->vesseL_alih }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">VESSEL CODE</td>
                        <td>:</td>
                        <td colspan="3">{{ $load->code_vesseL_alih }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">QTY</td>
                        <td>:</td>
                        <td colspan="3"></td>
                    </tr>
                    @foreach ($quantity as $quantities)
                    <tr>
                        <td colspan="3"></td>
                        <td></td>
                        <td colspan="3">{{$quantities}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">CONTAINER</td>
                        <td>:</td>
                        <td colspan="3"></td>
                    </tr>

                    <tr>
                        <td align="right" valign="top"></td>
                        <td align="center" valign="top">NO.</td>
                        <td colspan="2" align="center" valign="top">CONTAINER</td>
                        <td align="center" valign="top">SIZE/TYPE</td>
                        <td align="center" valign="top">SEAL</td>
                        <td align="center" valign="top">COMMODITY</td>
                    </tr>
                    @foreach ($containers as $container)
                    <tr>
                        <td align="right" valign="top"></td>
                        <td align="center" valign="top">{{ $loop->iteration }}.</td>
                        <td colspan="2" align="center" valign="top">{{ $container['nomor_kontainer'] }}</td>
                        <td align="center" valign="top">{{ $container['size'] }}/{{ $container['type'] }}</td>
                        <td align="center" valign="top">
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
                        <td colspan="3">PORT OF LANDING</td>
                        <td>:</td>
                        <td colspan="3">
                            {{ $load->pol_alih }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">PORT OF TRANSIT</td>
                        <td>:</td>
                        <td colspan="3">
                            @if ($load->pot_alih)
                                {{ $load->pot_alih }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">PORT OF DISCHARGE</td>
                        <td>:</td>
                        <td colspan="3">
                            {{ $load->pod_alih }}
                        </td>
                    </tr>


                </table>
            </div>


        @endforeach

        @else

        @foreach ($loads as $key => $load)
            <div>
                <table class="sub-judul" width="100%">
                    <tr class="judul">
                        <td colspan="7" class="judul">
                            SHIPPING INSTRUCTION
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" width="20%">SHIPPER</td>
                        <td width="4%">:</td>
                        <td colspan="3">{{ $shipper }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">CONSIGNE</td>
                        <td>:</td>
                        <td colspan="3">{{ $consigne }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">FEEDER</td>
                        <td>:</td>
                        <td colspan="3">{{$load->select_company}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">VESSEL</td>
                        <td>:</td>
                        <td colspan="3">{{ $load->vessel }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">VESSEL CODE</td>
                        <td>:</td>
                        <td colspan="3">{{ $load->vessel_code }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">QTY</td>
                        <td>:</td>
                        <td colspan="3"></td>
                    </tr>
                    @foreach ($quantity as $quantities)
                    <tr>
                        <td colspan="3"></td>
                        <td></td>
                        <td colspan="3">{{$quantities}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">CONTAINER</td>
                        <td>:</td>
                        <td colspan="3"></td>
                    </tr>

                    <tr>
                        <td align="right" valign="top"></td>
                        <td align="center" valign="top">NO.</td>
                        <td colspan="2" align="center" valign="top">CONTAINER</td>
                        <td align="center" valign="top">SIZE/TYPE</td>
                        <td align="center" valign="top">SEAL</td>
                        <td align="center" valign="top">COMMODITY</td>
                    </tr>
                    @foreach ($containers as $container)
                    <tr>
                        <td align="right" valign="top"></td>
                        <td align="center" valign="top">{{ $loop->iteration }}.</td>
                        <td colspan="2" align="center" valign="top">{{ $container['nomor_kontainer'] }}</td>
                        <td align="center" valign="top">{{ $container['size'] }}/{{ $container['type'] }}</td>
                        <td align="center" valign="top">
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
                        <td colspan="3">PORT OF LANDING</td>
                        <td>:</td>
                        <td colspan="3">
                            {{ $load->pol }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">PORT OF TRANSIT</td>
                        <td>:</td>
                        <td colspan="3">
                            @if ($pot_container != null)
                                {{ $pot_container }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">PORT OF DISCHARGE</td>
                        <td>:</td>
                        <td colspan="3">
                            {{ $pod_container }}
                        </td>
                    </tr>


                </table>
            </div>


        @endforeach

        @endif




    </main>


</body>

</html>
