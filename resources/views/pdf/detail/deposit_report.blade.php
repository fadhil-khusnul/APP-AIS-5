<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Barang</title>

    <link href="{{ public_path('/') }}./assetS/css-surat/deposit_report.css" rel="stylesheet" />

</head>
<body>
    <header>
        <img class="header-invoice" src="{{ public_path('/') }}./assets/images/surat-jalan.png" alt="">

        <table border="0" class="left" width="100%">

            <tr class="title1">
                <td>PT.AIS LOGISTIK MAKASSAR</td>
            </tr>
            <tr class="title2">
                <td>Jl.PERUMAHAN GREEN RIVER VIEW VINCA RESIDENCE</td>
            </tr>
            <tr class="title2">
                <td>BAROMBONG,TAMALATE-KOTA MAKASSAR SULAWESI SELATAN</td>
            </tr>
            <tr class="title3"><td>
                0813 5570 7777 EMAIL <a href="">aislogisticmakassar@gmail.com</a>
                </td>
            </tr>

        </table>


        <img class="header-invoice3" src="{{ public_path('/') }}./assets/images/icon.png" alt="">

    </header>

    <main>

        <h3>Uraian Alokasi Dana Ongkos Sopir</h3>


        <table width ="100%" class="header2">
            <tr>
                <td width="25%">PENANGGUNG JAWAB </td>
                <td width="3%">:</td>
                <td>{{$danas->pj}}</td>
            </tr>
            <tr>
                <td>TANGGAL DEPOSIT</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($danas->tanggal_deposit)->isoFormat('dddd, DD MMMM YYYY') }}
                </td>
            </tr>
            <tr>
                <td>NOMINAL AWAL</td>
                <td>:</td>
                <td>@rupiah($danas->nominal_awal)</td>
            </tr>


        </table>



        <img src="" alt="">

        <table class="bank" width="100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KONTAINER</th>
                    <th>TANGGAL</th>
                    <th>NAMA SUPIR</th>
                    <th>NOMOR POLISI</th>
                    <th>VENDOR</th>
                    <th>NAMA KAPAL/VOY</th>
                    <th>KEGIATAN ACTIVITY</th>
                    <th>PENGIRIM</th>
                    <th>PENERIMA</th>
                    <th>TUJUAN</th>
                    <th>JUMLAH Rp.</th>
                    <th>KETERANGAN</th>

                </tr>
            </thead>

            <tbody>
                @if ($containers == null)
                <tr>
                    <td colspan="13">Belum Ada Data Container</td>
                </tr>
                @else

                    @foreach ($containers as $container)
                    <tr>
                        <td align="center">{{$loop->iteration}}.</td>
                        <td align="center">{{$container->nomor_kontainer}}</td>
                        <td align="center">{{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}
                        <td align="center">
                            @if ($container->nomor_polisi != null)
                                {{ $container->mobils->nama_supir }}/{{ $container->mobils->nomor_polisi }}

                            @endif
                        </td>
                        <td align="center">
                            @if ($container->nomor_polisi != null)
                                {{ $container->mobils->nomor_polisi }}

                            @endif
                        </td>

                        <td align="center">
                            @if ($container->nomor_polisi != null)
                                {{ $container->mobils->vendors->nama_vendor }}

                            @endif
                        </td>

                        <td align="center">{{$container->planload->vessel}}/{{$container->planload->vessel_code}}</td>
                        <td align="center">{{$container->planload->activity}}</td>
                        <td align="center">{{$container->pengirim}}</td>
                        <td align="center">{{$container->penerima}}</td>
                        <td align="center">{{$container->pod_container}}</td>
                        <td>@rupiah($container->ongkos_supir)</td>
                        <td align="center"></td>


                    </tr>
                    @endforeach

                @endif

            </tbody>

            <tfoot>
                <tr>
                    <td colspan="11" align="right">Total Terpakai :</td>
                    <td colspan="2" align="right">@rupiah($total_container)</td>
                </tr>
                <tr>
                    <td colspan="11" align="right">Dana Tersisa :</td>
                    <td colspan="2" align="right">@rupiah($sisa)</td>
                </tr>

            </tfoot>



        </table>

    </main>

    <footer>
        <img class="footer-invoice" src="{{ public_path('/') }}./assets/images/footer.png" alt="">

    </footer>

</body>
</html>
