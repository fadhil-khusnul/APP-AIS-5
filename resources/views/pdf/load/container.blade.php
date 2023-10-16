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
        <img class="header-online1" src="{{ public_path('/') }}./assets/images/online.png" alt="">

    </header>
    <main class="main">
        <h3 class="judul-container">CONTAINER DETAIL REPORT</h3>

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



                <tr>
                    <td>
                        VESSEL/VOY (NAMA KAPAL)
                    </td>
                    <td>:</td>
                    <td>{{ $container->planload->vessel }}</td>
                </tr>

                <tr>
                    <td>
                        VESSEL/VOY CODE (KODE KAPAL)
                    </td>
                    <td>:</td>
                    <td>{{ $container->planload->vessel_code }}</td>
                </tr>
                <tr>
                    <td>
                        POL
                    </td>
                    <td>:</td>
                    <td>{{ $container->planload->pol }}</td>
                </tr>
               

                <tr>
                    <td>
                        PENGIRIM
                    </td>
                    <td>:</td>
                    <td>{{ $container->pengirim }}</td>
                </tr>
                <tr>
                    <td>
                        PENERIMA
                    </td>
                    <td>:</td>
                    <td>{{ $container->penerima }}</td>
                </tr>
                
            

                <tr>
                    <td>
                        NAMA BARANG (CARGO)
                    </td>
                    <td>:</td>
                    <td>{{ $container->cargo }}</td>
                </tr>
                <tr>
                    <td>
                        STATUS
                    </td>
                    <td>:</td>
                    <td>{{ $container->status }}</td>
                </tr>
                <tr>
                    <td>
                        SEAL 
                    </td>
                    <td>:</td>
                    <td>
                        @foreach ($seals as $seal)
                            @foreach ($seal as $seal_2)
                                @if ($container->id == $seal_2["kontainer_id"])
                                    @if ($seal[(count($seal) - 1)] != $seal[($loop->iteration - 1)])
                                        {{ $seal_2["seal_kontainer"] }}, &ensp;
                                    @else
                                        {{ $seal_2["seal_kontainer"] }}
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>
                        NOMOR BL
                    </td>
                    <td>:</td>
                    <td>{{ $container->si_pdf_containers->nomor_bl }}</td>
                </tr>
              

                <tr>
                    <td>
                        TOTAL COST
                    </td>
                    <td>:</td>

                    @if ($container->harga_alih != null)
                    <td>
                         @rupiah(($container->alihs->harga_alih_kapal + $container->ongkos_supir + $container->biaya_trucking + $container->biaya_thc + $container->biaya_stuffing + $container->harga_batal + $container->biaya_seal + $container->freight + $container->lss + $container->thc_pod + $container->lolo + $container->dooring + $container->demurrage + $container->total_biaya_lain + $container->total_biaya_lain_pod)) </>

                    </td>
                        
                    @else
                        
                    <td>
                         @rupiah(($container->ongkos_supir + $container->biaya_trucking + $container->biaya_thc + $container->biaya_stuffing + $container->harga_batal + $container->biaya_seal + $container->freight + $container->lss + $container->thc_pod + $container->lolo + $container->dooring + $container->demurrage + $container->total_biaya_lain + $container->total_biaya_lain_pod)) </>

                    </td>
                    @endif
                </tr>

                <tr>
                    <td>
                        KETERANGAN
                    </td>
                    <td>:</td>
                    <td>{{ $report }}</td>
                </tr>


            </table>


    </main>




</body>

</html>
