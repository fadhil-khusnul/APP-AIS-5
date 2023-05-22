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

    </header>
    <main>
        <h3 class="judul">COST DETAIL REPORT</h3>

        @foreach ($loads as $load)
            <table>
                <tr>
                    <td width="46%">
                        ACTIVITY
                    </td>
                    <td width="4%">:</td>
                    <td width="50%">{{ $report }}</td>
                </tr>

                <tr>
                    <td>
                        TANGGAL AWAL
                    </td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($min_date)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                </tr>
                <tr>
                    <td>
                        TANGGAL AKHIR
                    </td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($max_date)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                </tr>


                <tr>
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
                        Pengirim
                    </td>
                    <td>:</td>
                    <td>{{ $load->pengirim }}</td>
                </tr>

                <tr>
                    <td>
                        Penerima
                    </td>
                    <td>:</td>
                    <td>{{ $load->penerima }}</td>
                </tr>
            </table>



            <table class="table" width="100%" align="center">
                <thead class="biru">
                    <tr>
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
                        <th>BL FEE</th>
                        <th>DO FEE</th>
                        <th>BIAYA-LAIN-LAIN</th>
                        <th>BIAYA RELOKASI</th>
                        <th>BIAYA STRIPPING DALAM</th>
                        <th>JAMINAN KONTAINER</th>
                        <th>BIAYA DEMURRAGE</th>
                    </tr>
                </thead>


                <tbody border="1">
                    @foreach ($containers as $container)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $container->nomor_kontainer }}</td>
                            <td>{{ $container->cargo }}/{{ $container->type }}</td>
                            <td>{{ $container->seal }}</td>
                            <td class="harga">@rupiah($container->ongkos_supir)</td>
                            <td class="harga">@rupiah($container->biaya_trucking)</td>
                            <td class="harga">@rupiah($container->biaya_thc)</td>
                            <td class="harga">@rupiah($container->biaya_stuffing)</td>
                            <td class="harga">@rupiah($container->biaya_stuffing)</td>
                            <td class="harga">@rupiah($container->biaya_stuffing)</td>
                            <td class="harga">@rupiah($container->biaya_stuffing)</td>
                            <td class="harga">@rupiah($container->biaya_stuffing)</td>
                            <td class="harga">@rupiah($container->biaya_stuffing)</td>
                            <td class="harga">@rupiah($container->biaya_stuffing)</td>
                            <td class="harga">@rupiah($container->biaya_stuffing)</td>
                            <td class="harga">@rupiah($container->biaya_stuffing)</td>
                            <td class="harga">@rupiah($container->biaya_stuffing)</td>

                        </tr>
                    @endforeach


                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4" align="right">SUB TOTAL :</td>
                        <td>@rupiah($container->sum('ongkos_supir'))</td>
                        <td>@rupiah($container->biaya_trucking)</td>
                        <td>@rupiah($container->biaya_thc)</td>
                        <td>@rupiah($container->biaya_stuffing)</td>
                        <td>@rupiah($container->biaya_stuffing)</td>
                        <td>@rupiah($container->biaya_stuffing)</td>
                        <td>@rupiah($container->biaya_stuffing)</td>
                        <td>@rupiah($container->biaya_stuffing)</td>
                        <td>@rupiah($container->biaya_stuffing)</td>
                        <td>@rupiah($container->biaya_stuffing)</td>
                        <td>@rupiah($container->biaya_stuffing)</td>
                        <td>@rupiah($container->biaya_stuffing)</td>
                        <td>@rupiah($container->biaya_stuffing)</td>

                    </tr>
                    <tr>
                        <td colspan="4" align="right">JUMLAH TOTAL :</td>
                        <td colspan="13" align="left">@rupiah($container->sum('ongkos_supir', 'biaya_trucking', 'biaya_thc', 'biaya_stuffing'))</td>
                    </tr>

                </tfoot>


            </table>
        @endforeach


    </main>




</body>

</html>
