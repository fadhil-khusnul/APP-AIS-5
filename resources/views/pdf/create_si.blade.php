<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$vessel}}</title>
</head>
<body>
    <header class="mt-1">
        <img class="mt-1" src="{{ public_path('/') }}./asset/images/header.png" alt="">
    </header>

    {{-- <footer>
        <div class="footer-2">
            Paraf________________
        </div>
        <div class="footer-1">
            Jl. Jend. Hertasning No.99 Tamalate, Kec.Rappocini, Kota Makassar Telp 0411 886245 - 882707W
            <link style="color: blue"><u style="color: blue">www.pln.co.id</u>
            <link>
        </div>
    </footer> --}}

    <main>
        @foreach ($loads as $load)
        <div>
            <table border="0">
                <tr>
                    <td colspan="3">
                        SHIPPING INSTRUCTION
                    </td>
                </tr>
                <tr>
                    <td>SHIPPER</td>
                    <td>:</td>
                    <td>{{$load->select_company}}</td>
                </tr>
                <tr>
                    <td>CONSIGNE</td>
                    <td>:</td>
                    <td>{{$load->select_company}}</td>
                </tr>
                <tr>
                    <td>FEEDER</td>
                    <td>:</td>
                    <td>{{$load->select_company}}</td>
                </tr>
                <tr>
                    <td>VESSEL</td>
                    <td>:</td>
                    <td>{{$load->vessel}}</td>
                </tr>
                <tr>
                    <td>VESSEL CODE</td>
                    <td>:</td>
                    <td>{{$load->vessel_code}}</td>
                </tr>

            </table>
        </div>
            @foreach ($container as $container)
            <div>
                <table border="0">
                    <tr>
                        <td>QTY (SIZE TYPE X JUMLAH)</td>
                        <td>:</td>
                        <td>{{$container->size}} {{$container->type}} X {{$container->jumlah_container}}</td>
                    </tr>
                    <tr>
                        <td>NOMOR KONTAINER</td>
                        <td>SEAL</td>
                        <td>COMMIDITY</td>
                    </tr>
                    <tr>
                        <td>{{$container->nomor_kontainer}}</td>
                        <td>{{$container->seal}}</td>
                        <td>{{$container->lokasi_depo}}</td>
                    </tr>
                </table>
            </div>
            @endforeach

            <div>
                <table>
                    <tr>
                        <td>PORT OF LANDING</td>
                        <td>:</td>
                        <td>
                            {{$load->pol}}
                        </td>
                    </tr>
                    <tr>
                        <td>PORT OF DISCHARGE</td>
                        <td>:</td>
                        <td>
                            {{$load->pod}}
                        </td>
                    </tr>
                </table>
            </div>


        @endforeach

        <div>
            <img src="{{ asset('/') }}./assets/images/ttd.png" width="50" alt="">
        </div>

    </main>


</body>
</html>
