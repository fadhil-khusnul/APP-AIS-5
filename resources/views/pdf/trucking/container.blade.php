<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ public_path('/') }}./assetS/css-surat/report.css" rel="stylesheet" />

    <title>CONTAINER DETAIL REPORT</title>
</head>

<body>
    <header>

    </header>
    <main class="main">
        <h3 class="judul-container">CONTAINER DETAIL REPORT</h3>

        @foreach ($containers as $container)
            <table class="left-table" width="100%">
                <tr>
                    <td width="36%">
                        NOMOR KONTAINER
                    </td>
                    <td width="4%">:</td>
                    <td width="60%">{{ $container->nomor_kontainer }}</td>
                </tr>

                <tr>
                    <td>
                        TANGGAL KEGIATAN
                    </td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                </tr>

                @foreach ($loads as $load)

                @if ($load->id === $container->job_id)

                <tr>
                    <td>
                        VESSEL/VOY (NAMA KAPAL)
                    </td>
                    <td>:</td>
                    <td>{{ $load->vessel }}</td>
                </tr>

                <tr>
                    <td>
                        VESSEL/VOY CODE (KODE KAPAL)
                    </td>
                    <td>:</td>
                    <td>{{ $load->vessel_code }}</td>
                </tr>
               

                <tr>
                    <td>
                        PENGIRIM
                    </td>
                    <td>:</td>
                    <td>{{ $load->pengirim }}</td>
                </tr>
                <tr>
                    <td>
                        PENERIMA
                    </td>
                    <td>:</td>
                    <td>{{ $load->penerima }}</td>
                </tr>
                @endif
                @endforeach

                <tr>
                    <td>
                        NAMA BARANG (CARGO)
                    </td>
                    <td>:</td>
                    <td>{{ $container->cargo }}</td>
                </tr>
                <tr>
                    <td>
                        DETAIL BARANG
                    </td>
                    <td>:</td>
                    <td>{{ $container->detail_barang }}</td>
                </tr>
                <tr>
                    <td>
                        NOMOR SEAL (SEGEL)
                    </td>
                    <td>:</td>
                    <td>{{ $container->seal }}</td>
                </tr>
                <tr>
                    <td>
                        NOMOR BL
                    </td>
                    <td>:</td>
                    <td>{{ $container->seal }}</td>
                </tr>
                <tr>
                    <td>
                        NOMOR DO
                    </td>
                    <td>:</td>
                    <td>{{ $container->seal }}</td>
                </tr>

                <tr>
                    <td>
                        TOTAL COST
                    </td>
                    <td>:</td>
                    <td>{{ $container->seal }}</td>
                </tr>

                <tr>
                    <td>
                        KETERANGAN
                    </td>
                    <td>:</td>
                    <td>{{ $report }}</td>
                </tr>


            </table>

        @endforeach


    </main>




</body>

</html>
