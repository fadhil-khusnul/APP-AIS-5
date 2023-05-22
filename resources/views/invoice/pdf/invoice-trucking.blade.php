<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INVOICE TRUCKING</title>

    <link href="{{ public_path('/') }}./assetS/css-surat/pdf-invoice.css" rel="stylesheet" />

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

        <img class="header-invoice2" src="{{ public_path('/') }}./assets/images/invoice.png" alt="">
        <img class="header-invoice3" src="{{ public_path('/') }}./assets/images/icon.png" alt="">

    </header>

    <main>
        <h3>NO INV: AISLOG/0001/IX/2022/M</h3>

        @foreach ($loads as $load)

        <table width ="100%" class="header2">
            <tr>
                <td width="25%">Kegiatan</td>
                <td width="3%">:</td>
                <td>{{$report}}</td>
            </tr>
            <tr>
                <td>Kepada YTH</td>
                <td>:</td>
                <td>{{$load->penerima}}</td>
            </tr>
            <tr>
                <td>KM</td>
                <td>:</td>
                <td>{{$load->pengirim}}</td>
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
            <tr>
                <td>POD</td>
                <td>:</td>
                <td>{{$load->pod}}</td>
            </tr>
        </table>



        <img src="" alt="">

        <table class="striped" width="100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>PENGIRIM</th>
                    <th>KONTAINER</th>
                    <th>SIZE</th>
                    <th>KONDISI</th>
                    <th>KETERANGAN</th>
                    <th>UNIT PRIZE</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($containers as $container)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$load->pengirim}}</td>
                    <td>{{$container->nomor_kontainer}}</td>
                    <td>{{$container->size}}</td>
                    <td>{{$container->type}}</td>
                    <td>{{$container->cargo}}</td>
                    <td>@rupiah($container->ongkos_supir)</td>
                </tr>
                @endforeach




            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">TOTAL :</td>
                    <td>@rupiah($total)</td>
                </tr>
                <tr>
                    <td colspan="7">
                    Terbilang : {{Terbilang::make($total, ' rupiah')}}
                    </td>
                </tr>
            </tfoot>


        </table>

        @endforeach




        <table class="bank" width="100%">
            <thead>
                <tr>
                    <th colspan="4" style="background-color: #808080; color:white">DATA REKENING :</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>NAMA BANK</th>
                    <th>NO. REKENING</th>
                    <th>A/N ATAS NAMA</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($rekenings as $rekening)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$rekening->nama_bank}}</td>
                    <td>{{$rekening->no_rekening}}</td>
                    <td>{{$rekening->atas_nama}}</td>
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
