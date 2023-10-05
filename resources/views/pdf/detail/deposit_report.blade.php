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
        <img class="header-online" src="{{ public_path('/') }}./assets/images/online.png" alt="">

        
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
                    <th align="right">JUMLAH (Rp.)</th>
                    {{-- <th>KETERANGAN</th> --}}

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
                        <td align="left">{{$loop->iteration}}.</td>
                        <td align="left">{{$container->nomor_kontainer}}</td>
                        <td align="left">{{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}
                        <td align="left">
                            @if ($container->nomor_polisi != null)
                                {{ $container->mobils->nama_supir }}/{{ $container->mobils->nomor_polisi }}

                            @endif
                        </td>
                        <td align="left">
                            @if ($container->nomor_polisi != null)
                                {{ $container->mobils->nomor_polisi }}

                            @endif
                        </td>

                        <td align="left">
                            @if ($container->nomor_polisi != null)
                                {{ $container->mobils->vendors->nama_vendor }}

                            @endif
                        </td>

                        <td align="left">{{$container->planload->vessel}}/{{$container->planload->vessel_code}}</td>
                        <td align="left">{{$container->planload->activity}}</td>
                        <td align="left">{{$container->pengirim}}</td>
                        <td align="left">{{$container->penerima}}</td>
                        <td align="left">{{$container->pod_container}}</td>
                        <td align="right">@rupiah($container->ongkos_supir)</td>
                        {{-- <td align="center"></td> --}}


                    </tr>
                    @endforeach

                @endif

            </tbody>

            <tfoot>
                <tr>
                    <td colspan="10" align="right">Total Terpakai :</td>
                    <td colspan="2" align="right">@rupiah($total_container)</td>
                </tr>
                <tr>
                    <td colspan="10" align="right">Dana Tersisa :</td>
                    <td colspan="2" align="right">@rupiah($sisa)</td>
                </tr>

            </tfoot>



        </table>

    </main>
{{-- 
    <footer>
        <img class="footer-invoice" src="{{ public_path('/') }}./assets/images/footer.png" alt="">

    </footer> --}}

</body>
</html>
