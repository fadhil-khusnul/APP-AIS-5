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

    </header>
    <main>
        <h3 class="judul">SUMMARY DETAIL REPORT</h3>

        @foreach ($loads as $load)


        <table>
            <tr>
                <td width="46%">
                    ACTIVITY
                </td>
                <td width="4%">:</td>
                <td width="50%">{{$report}}</td>
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
                    POL
                </td>
                <td>:</td>
                <td>{{$load->pol}}</td>
            </tr>
            @if ($load->pot != null)
            <tr>
                <td>
                    POT
                </td>
                <td>:</td>
                <td>{{$load->pot}}</td>
            </tr>
            @else
            <tr>
                <td>
                    POT
                </td>
                <td>:</td>
                <td>-</td>
            </tr>
            @endif
            <tr>
                <td>
                    POD
                </td>
                <td>:</td>
                <td>{{$load->pod}}</td>
            </tr>
            <tr>
                <td>
                    Shipping Company (Pelayaran)
                </td>
                <td>:</td>
                <td>{{$load->select_company}}</td>
            </tr>
            <tr>
                <td>
                    Vessel/Voyage
                </td>
                <td>:</td>
                <td>{{$load->vessel}}</td>
            </tr>
            <tr>
                <td>
                    Pengirim
                </td>
                <td>:</td>
                <td>{{$load->pengirim}}</td>
            </tr>
            <tr>
                <td>
                    Pemilik Barang
                </td>
                <td>:</td>
                <td>{{$load->pengirim}}</td>
            </tr>
            <tr>
                <td>
                    Pembeli
                </td>
                <td>:</td>
                <td>{{$load->pengirim}}</td>
            </tr>
            <tr>
                <td>
                    Penerima
                </td>
                <td>:</td>
                <td>{{$load->pengirim}}</td>
            </tr>
        </table>



        <table class="table" width="100%" align="center">
            <thead class="hijau">
                <tr>
                    <th>NO</th>
                    <th>Vessel/Voy</th>
                    <th>POL</th>
                    <th>POT</th>
                    <th>POD</th>
                    <th>CONTAINER</th>
                    <th>SIZE/TYPE</th>
                    <th>SEAL</th>
                    <th>PENGIRIM</th>
                    <th>PEMILIK BARANG</th>
                    <th>PEMBELI</th>
                    <th>PENERIMA</th>
                    <th>BL/DO NUMBER</th>
                    <th>NAMA BARANG</th>
                    <th>KETERANGAN</th>
                </tr>
            </thead>


            <tbody border="1">
                @foreach ($containers as $container)

                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$load->vessel}}</td>
                    <td>{{$load->pol}}</td>
                    <td>{{$load->pot}}</td>
                    <td>{{$load->pod}}</td>
                    <td>{{$container->nomor_kontainer}}</td>
                    <td>{{$container->size}}/{{$container->type}}</td>
                    <td>{{$container->seal}}</td>
                    <td>{{$load->pengirim}}</td>
                    <td>{{$load->pengirim}}</td>
                    <td>{{$load->pengirim}}</td>
                    <td>{{$load->pengirim}}</td>
                    <td>{{$container->seal}}</td>
                    <td>{{$container->cargo}}</td>
                    @if ($report === "LOAD")
                    <td rowspan="0">LOAD</td>
                    @endif

                    @if ($report === "DISCHARGE")
                    <td rowspan="0">DISCHARGE</td>
                    @endif

                    @if ($report === "TRUCKING")
                    <td rowspan="0">TRUCKING</td>
                    @endif

                </tr>

                @endforeach


            </tbody>

            <tfoot>

            </tfoot>


        </table>

        @endforeach


    </main>




</body>
</html>
