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
    
                <div>
                    <table class="sub-judul" width="100%">
                        <tr class="judul">
                            <td colspan="7" class="judul">
                                REPORT VENDOR TRUCK
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" width="30%">TANGGAL BAYAR</td>
                            <td width="4%">:</td>
                            <td>{{ \Carbon\Carbon::parse($tanggal_bayar)->isoFormat('dddd, DD-MMMM-YYYY') }}

                        </tr>
                        <tr>
                            <td colspan="3">DIBAYARKAN KE</td>
                            <td>:</td>
                            <td colspan="3">{{ $dibayarkan_ke }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">CARA BAYAR</td>
                            <td>:</td>
                            <td colspan="3">{{$cara_bayar}}</td>
                        </tr>
                        <tr>
                            <td colspan="3">KETERANGAN TRANSFER</td>
                            <td>:</td>
                            <td colspan="3">{{ $keterangan_transfer }}</td>
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
                    <table class="report-container"
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>NOMOR KONTAINER</th>
                                <th>SIZE/TYPE KONTAINER</th>
                                <th>CARGO</th>
                                <th>BIAYA TRUCKING</th>
                                <th>ONGKOS SUPIR</th>
                            </tr>
                        
                        </thead>
                        <tbody>
                        
                            @foreach ($containers as $container)
                            <tr>
                                <td align="center" valign="top">{{ $loop->iteration }}.</td>
                                <td align="center" valign="top">{{ $container['nomor_kontainer'] }}</td>
                                <td align="center" valign="top">{{ $container['size'] }}/{{ $container['type'] }}</td>
                                
                                <td align="center" valign="top">{{ $container['cargo'] }}</td>
                                <td align="center" valign="top">@rupiah($container['biaya_trucking'])</td>
                                <td align="center" valign="top">@rupiah($container['ongkos_supir'])</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    </main>


</body>

</html>
