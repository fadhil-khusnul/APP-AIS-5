<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $load->vessel }}</title>
    <link href="{{ public_path('/') }}./assets/css-surat/pdf.css" rel="stylesheet" />

</head>

<body>
    <header class="">
        {{-- <img class="header" src="{{ public_path('/') }}./assets/images/icon.png" alt=""> --}}
        <img class="header-online" src="{{ public_path('/') }}./assets/images/online.png" alt="">
        {{-- <table border="0" class="left">

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
        <hr /> --}}
    </header>


    <main>
    
                <div>
                    <table class="sub-judul-online" width="100%">
                        <tr class="judul">
                            <td colspan="7" class="judul-online">
                                REPORT VENDOR TRUCK
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" width="20%">TANGGAL BAYAR</td>
                            <td width="2%">:</td>
                            <td>{{ \Carbon\Carbon::parse($tanggal_bayar)->isoFormat('dddd, DD-MMMM-YYYY') }}

                        </tr>
                        <tr>
                            <td colspan="2">DIBAYARKAN KE</td>
                            <td>:</td>
                            <td colspan="4">{{ $dibayarkan_ke }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">CARA BAYAR</td>
                            <td>:</td>
                            <td colspan="4">{{$cara_bayar}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">KETERANGAN TRANSFER</td>
                            <td>:</td>
                            <td colspan="4">{{ $keterangan_transfer }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">VESSEL</td>
                            <td>:</td>
                            <td colspan="4">{{ $load->vessel }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">VESSEL CODE</td>
                            <td>:</td>
                            <td colspan="4">{{ $load->vessel_code }}</td>
                        </tr>
                       
                       
      
                        <tr>
                            <td colspan="2">PORT OF LANDING</td>
                            <td>:</td>
                            <td colspan="4">
                                {{ $load->pol }}
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">PORT OF TRANSIT</td>
                            <td>:</td>
                            <td colspan="4">
                                @if ($load->pot != null)
                                    {{ $load->pot }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        
                        


                    </table>
                </div>

                <div>
                    <table class="report-container" width="100%">
                        <thead>

                            <tr>
                                <th>NO.</th>
                                <th>NOMOR KONTAINER</th>
                                <th>SIZE/TYPE</th>
                                <th>CARGO</th>
                                <th>BIAYA TRUCKING</th>
                                <th>ONGKOS SUPIR</th>
                                <th>TERBAYAR</th>
                                <th>TAGIHAN</th>
                            </tr>
                        
                        </thead>
                        <tbody>
                        
                            @foreach ($containers as $container)
                            <tr>
                                <td align="center" valign="top">{{ $loop->iteration }}.</td>
                                <td align="center" valign="top">{{ $container['nomor_kontainer'] }}</td>
                                <td align="center" valign="top">{{ $container['size'] }}/{{ $container['type'] }}</td>
                                
                                <td align="center" valign="top">{{ $container['cargo'] }}</td>
                                <td align="right" valign="top">@rupiah($container['biaya_trucking'])</td>
                                <td align="right" valign="top">@rupiah($container['ongkos_supir'])</td>
                                <td align="right" valign="top">@rupiah($container['dibayar'])</td>
                                <td align="right" valign="top">@rupiah($container['biaya_trucking'] - $container['ongkos_supir'] - $container['dibayar'])</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="tfoot">
                            <tr>
                                <td colspan="7" align="right">TOTAL TAGIHAN :</td>
                                <td align="right">@rupiah($selisih - $dibayar)</td>
                            </tr>
                            
                        </tfoot>
                    </table>
                </div>
    </main>


</body>

</html>
