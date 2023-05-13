<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INVOICE</title>

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
        <table width ="100%" class="header2">
            <tr>
                <td width="25%">Kegiatan</td>
                <td width="3%">:</td>
                <td>MUATAN</td>
            </tr>
            <tr>
                <td>Kepada YTH</td>
                <td>:</td>
                <td>MERRY</td>
            </tr>
            <tr>
                <td>KM</td>
                <td>:</td>
                <td>BALI GIANYAR (30/22)</td>
            </tr>
            <tr>
                <td>Pelayaran</td>
                <td>:</td>
                <td>MERATUS</td>
            </tr>
            <tr>
                <td>POL</td>
                <td>:</td>
                <td>POL</td>
            </tr>
            <tr>
                <td>POD</td>
                <td>:</td>
                <td>POD</td>
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
                <tr>
                    <td>1</td>
                    <td>PENGIRIM</td>
                    <td>KONTAINER</td>
                    <td>SIZE</td>
                    <td>KONDISI</td>
                    <td>KETERANGAN</td>
                    <td>UNIT PRIZE</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>PENGIRIM</td>
                    <td>KONTAINER</td>
                    <td>SIZE</td>
                    <td>KONDISI</td>
                    <td>KETERANGAN</td>
                    <td>UNIT PRIZE</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>PENGIRIM</td>
                    <td>KONTAINER</td>
                    <td>SIZE</td>
                    <td>KONDISI</td>
                    <td>KETERANGAN</td>
                    <td>UNIT PRIZE</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">TOTAL :</td>
                    <td>Rp. 77.000.000</td>
                </tr>
                <tr>
                    <td colspan="7">
                    Terbilang : Tujuh Puluh Tujuh Juta Rupiah
                    </td>
                </tr>
            </tfoot>
        </table>

        <table class="bank" width="100%">
            <tr>
                <td>BANK : NO REKENING</td>
                <td width="3%"></td>
                <td>A/N ATAS NAMA</td>
                <td width="3%"></td>
                <td>BANK : NO REKENING</td>
            </tr>
        </table>
    </main>

    <footer>
        <img class="footer-invoice" src="{{ public_path('/') }}./assets/images/footer.png" alt="">

    </footer>

</body>
</html>
