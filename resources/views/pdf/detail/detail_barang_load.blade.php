<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Barang</title>

    <link href="{{ public_path('/') }}./assetS/css-surat/detail_barang.css" rel="stylesheet" />

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


        <img class="header-invoice2" src="{{ public_path('/') }}./assets/images/packing.png" alt="">
        <img class="header-invoice3" src="{{ public_path('/') }}./assets/images/icon.png" alt="">

    </header>

    <main>

        @foreach ($loads as $load)

        <table width ="100%" class="header2">
            <tr>
                <td width="25%">Kegiatan</td>
                <td width="3%">:</td>
                <td>{{$report}}</td>
            </tr>
            <tr>
                <td>TANGGAL</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($load->updated_at)->isoFormat('dddd, DD MMMM YYYY') }}
                </td>
            </tr>
            <tr>
                <td>VESSEL/VOYAGE</td>
                <td>:</td>
                <td>{{$load->vessel}}/{{$load->vessel_code}}</td>
            </tr>
            <tr>
                <td>Pelayaran</td>
                <td>:</td>
                <td>{{$load->select_company}}</td>
            </tr>
            <tr>
                <td>POL</td>
                <td>:</td>
                <td>{{$load->pol}}</td>
            </tr>

        </table>



        <img src="" alt="">

        <table class="bank" width="100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>PENGIRIM</th>
                    <th>SIZE/TYPE</th>
                    <th>KONTAINER</th>
                    <th>POD</th>
                    <th>Deskripsi</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($containers as $container)
                <tr>
                    <td align="center">{{$loop->iteration}}.</td>
                    <td>{{$container['pengirim']}}</td>
                    <td>{{$container['size']}}/{{$container['type']}}</td>
                    <td>{{$container['nomor_kontainer']}}</td>
                    <td>{{$container['pod_container']}}</td>
                    <td>
                        <ol type="1.">
                        @foreach ($details as $detail)
                            @if ($detail->kontainer_id == $container['id'])
                            <li>
                                {{ $detail->detail_barang }}
                            </li>
                            @endif
                        @endforeach
                        </ol>
                    </td>

                </tr>
                @endforeach
            </tbody>



        </table>

        @endforeach

        <table class="bank" width="100%" style="margin-top: 50px !important">
            <thead>
                <tr>
                    <th colspan="5"
                    >COMMENT :</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($containers as $rekening)
                <tr>
                    <td align="center" width="5%">{{$loop->iteration}}</td>
                    <td colspan="4"></td>
                </tr>
                @endforeach


            </tbody>
        </table>
    </main>

    <footer>
        <img class="footer-invoice" src="{{ public_path('/') }}./assets/images/footer.png" alt="">

    </footer>

</body>
</html>
