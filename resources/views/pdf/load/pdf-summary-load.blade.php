<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ public_path('/') }}./assetS/css-surat/report.css" rel="stylesheet" />

    <title>SUMMARY DETAIL REPORT</title>
</head>
<body>
    <header>
        <img class="header-online" src="{{ public_path('/') }}./assets/images/online.png" alt="">

    </header>
    <main>
        <h3 class="judul">SUMMARY DETAIL REPORT</h3>



        <table width="100%">
            <tr valign="top">
                <td width="">
                    ACTIVITY
                </td>
                <td width="2%">:</td>
                <td width="">{{ $report }}</td>

                <td width="10%"></td>

                <td width="">
                    Shipping Company (Pelayaran)
                </td>
                <td width="2%">:</td>
                <td width="">{{ $load->select_company }}</td>
            </tr>

            <tr valign="top">
                <td>
                    TANGGAL AWAL
                </td>
                <td width="2%">:</td>
                <td>{{ \Carbon\Carbon::parse($min_date)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                <td width="10%"></td>

                <td>
                    Vessel/Voyage
                </td>
                <td width="2%">:</td>
                <td>{{ $load->vessel }}</td>
            </tr>
            <tr valign="top">
                <td>
                    TANGGAL AKHIR
                </td>
                <td width="2%">:</td>
                <td>{{ \Carbon\Carbon::parse($max_date)->isoFormat('dddd, DD MMMM YYYY') }}</td>

                <td width="10%"></td>

                <td>
                    Vessel Code
                </td>
                <td width="2%">:</td>
                <td>{{ $load->vessel_code }}</td>
            </tr>
            <tr valign="top">
                <td>
                    POL
                </td>
                <td width="2%">:</td>
                <td>{{ $load->pol }}</td>
            </tr>



        </table>



        <table class="table" width="100%" align="center">
            <thead class="hijau">
                <tr>
                    <th>NO</th>
                    <th>Vessel/Vessel Code</th>
                    <th>POL</th>
                    <th>POD</th>
                    <th>CONTAINER</th>
                    <th>SIZE/TYPE</th>
                    <th>CARGO</th>
                    <th>SEAL</th>
                    <th>PENGIRIM</th>
                    <th>PENERIMA</th>
                    <th>BL/DO NUMBER</th>
                    <th>KETERANGAN</th>
                </tr>
            </thead>


            <tbody border="1">
                @foreach ($containers as $container)

                <tr>
                    <td>{{$loop->iteration}}</td>
                    @if ($container->status == "Alih-Kapal")
                    
                        <td>{{$container->alihs->vesseL_alih}}/{{ $container->alihs->code_vesseL_alih }}</td>
                        <td>{{$load->pol}}</td>
                        <td>{{$container->alihs->pod_alih}}</td>
                    @else
                        <td>{{$load->vessel}}/{{ $load->vessel_code  }}</td>
                        <td>{{$load->pol}}</td>
                        <td>{{$load->pod}}</td>
                        
                    @endif

                    @if ($container->status == 'Alih-Kapal')
                    <td>{{ $container->nomor_kontainer }} (Alih-Kapal)</td>
                    @elseif ($container->status == "Batal-Muat")
                        <td>{{ $container->nomor_kontainer }} (Batal Muat)</td>
                    @else
                        <td>{{ $container->nomor_kontainer }}</td>
                    @endif
                  
                    <td>{{$container->size}}/{{$container->type}}</td>
                    <td>{{$container->cargo}}</td>

                    <td align="center" valign="top">
                        @foreach ($seals as $seal)
                            @foreach ($seal as $seal_2)
                                @if ($container->id == $seal_2["kontainer_id"])
                                    @if ($seal[(count($seal) - 1)] != $seal[($loop->iteration - 1)])
                                        {{ $seal_2["seal_kontainer"] }}, &ensp;
                                    @else
                                        {{ $seal_2["seal_kontainer"] }}
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td>{{$container->pengirim}}</td>
                    <td>{{$container->penerima}}</td>
                    <td>{{$container->si_pdf_containers->nomor_bl}}</td>
                    <td>{{$report}}</td>
                   

                </tr>

                @endforeach


            </tbody>

            <tfoot>

            </tfoot>


        </table>



    </main>




</body>
</html>
