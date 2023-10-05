<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ public_path('/') }}./assetS/css-surat/report.css" rel="stylesheet" />

    <title>COST DETAIL REPORT</title>
</head>

<body>
    <header>
        <img class="header-online" src="{{ public_path('/') }}./assets/images/online.png" alt="">

    </header>
    <main>
        <h3 class="judul">COST DETAIL REPORT</h3>

        @foreach ($loads as $load)
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


                {{-- <tr>
                    <td>
                        Shipping Company (Pelayaran)
                    </td>
                    <td>:</td>
                    <td>{{ $load->select_company }}</td>
                </tr>
                <tr>
                    <td>
                        Vessel/Voyage
                    </td>
                    <td>:</td>
                    <td>{{ $load->vessel }}</td>
                </tr>
                <tr>
                    <td>
                        Vessel Code
                    </td>
                    <td>:</td>
                    <td>{{ $load->vessel_code }}</td>
                </tr> --}}

            </table>



            <table class="table" width="100%" align="center">
                <thead class="biru">
                    <tr valign="top">
                        <th>NO</th>
                        <th>CONTAINER</th>
                        <th>CARGO</th>
                        <th>SEAL</th>
                        <th>ONGKOS SUPIR</th>
                        <th>BIAYA TRUCKING</th>
                        <th>THC</th>
                        <th>BIAYA STUFFING</th>
                        <th>BIAYA ALIH KAPAL</th>
                        <th>BIAYA BATAL MUAT</th>
                        <th>BIAYA SEAL</th>
                        <th>FREIGHT</th>
                        <th>LSS</th>
                        <th>THC POD</th>
                        <th>LOLO</th>
                        <th>DOORING</th>
                        <th>DEMURRAGE</th>
                        <th>TOTAL BIAYA LAIN</th>
                    </tr>
                </thead>


                <tbody border="1">
                    @foreach ($containers as $container)
                        <tr valign="top">
                            <td>{{ $loop->iteration }}</td>
                            @if ($container->status == 'Alih-Kapal')
                                <td>{{ $container->nomor_kontainer }} (Alih-Kapal)</td>
                            @else
                                <td>{{ $container->nomor_kontainer }}</td>
                            @endif
                            <td>{{ $container->cargo }}/{{ $container->type }}</td>
                            <td align="center" valign="top">
                                @foreach ($seals as $seal)
                                    @if ($container->id == $seal->kontainer_id)
                                        @if ($loop->iteration < count($seals))
                                            {{ $seal->seal_kontainer }}, &ensp;
                                        @else
                                            {{ $seal->seal_kontainer }}
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            <td class="harga">@rupiah2($container->ongkos_supir)</td>
                            <td class="harga">@rupiah2($container->biaya_trucking)</td>
                            <td class="harga">@rupiah2($container->biaya_thc)</td>
                            <td class="harga">@rupiah2($container->biaya_stuffing)</td>
                            @if ($container->status == 'Alih-Kapal')
                                <td class="harga">@rupiah2($container->alihs->harga_alih_kapal)</td>
                            @else
                                <td class="harga">0</td>
                            @endif
                            @if ($container->status == 'Batal-Muat')
                                <td class="harga">@rupiah2($container->harga_batal)</td>
                            @else
                                <td class="harga">0</td>
                            @endif
                            <td class="harga">@rupiah2($container->biaya_seal)</td>
                            <td class="harga">@rupiah2($container->freight)</td>
                            <td class="harga">@rupiah2($container->lss)</td>
                            <td class="harga">@rupiah2($container->thc_pod)</td>
                            <td class="harga">@rupiah2($container->lolo)</td>
                            <td class="harga">@rupiah2($container->dooring)</td>
                            <td class="harga">@rupiah2($container->demurrage)</td>
                            <td class="harga">@rupiah2($container->total_biaya_lain)</td>

                        </tr>
                    @endforeach


                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4" align="right">SUB TOTAL :</td>
                        <td>@rupiah2($container->sum('ongkos_supir'))</td>
                        <td>@rupiah2($container->sum('biaya_trucking'))</td>
                        <td>@rupiah2($container->sum('biaya_thc'))</td>
                        <td>@rupiah2($container->sum('biaya_stuffing'))</td>
                        <td>@rupiah2($sum_alih)</td>
                        <td>@rupiah2($container->sum('harga_batal'))</td>
                        <td>@rupiah2($container->sum('biaya_seal'))</td>
                        <td>@rupiah2($container->sum('freight'))</td>
                        <td>@rupiah2($container->sum('lss'))</td>
                        <td>@rupiah2($container->sum('thc_pod'))</td>
                        <td>@rupiah2($container->sum('lolo'))</td>
                        <td>@rupiah2($container->sum('dooring'))</td>
                        <td>@rupiah2($container->sum('demurrage'))</td>
                        <td>@rupiah2($container->sum('total_biaya_lain'))</td>

                    </tr>
                    <tr>
                        <td colspan="18">TOTAL : @rupiah(($container->sum('ongkos_supir') + $container->sum('biaya_trucking') + $container->sum('biaya_thc') + $container->sum('biaya_stuffing') + $sum_alih + $container->sum('harga_batal') + $container->sum('biaya_seal') + $container->sum('freight') + $container->sum('lss') + $container->sum('thc_pod') + $container->sum('lolo') + $container->sum('dooring') + $container->sum('demurrage') + $container->sum('total_biaya_lain'))) </td>
                    </tr>

                </tfoot>


            </table>
        @endforeach


    </main>




</body>

</html>
