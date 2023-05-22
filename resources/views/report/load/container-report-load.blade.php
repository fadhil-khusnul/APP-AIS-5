@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-12">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">{{ $title }}</h3>
                </div>
                <div class="portlet-body">


                    <!-- BEGIN Datatable -->
                    <div class="table-responsive">

                        <table id="containerloadreport" class="align-top table mb-0 table-bordered table-striped table-hover  autosize">
                            <thead class="text-nowrap">
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Kontainer</th>
                                    <th>Tanggal kegiatan</th>
                                    <th>Vessel/Voy (Nama Kapal)</th>
                                    <th>Kode Kapal</th>
                                    <th>POL</th>
                                    <th>POT</th>
                                    <th>POD</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Nama Barang</th>
                                    <th>Detail Barang</th>
                                    <th>Seal Number</th>
                                    <th>BL Number</th>
                                    <th>DO Number</th>
                                    <th>TOTAL COST</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($containers as $container)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{$container->nomor_kontainer}}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}</td>


                                        @foreach ($loads as $planload)
                                        @if ($container->job_id === $planload->id)

                                        <td>
                                            {{$planload->vessel}}
                                        </td>
                                        <td>
                                            {{$planload->vessel_code}}
                                        </td>
                                        <td>
                                            {{$planload->pol}}
                                        </td>
                                        <td>
                                            {{$planload->pot}}
                                        </td>
                                        <td>
                                            {{$planload->pod}}
                                        </td>
                                        <td>
                                            {{$planload->pengirim}}
                                        </td>
                                        <td>
                                            {{$planload->penerima}}
                                        </td>
                                        @endif

                                        @endforeach

                                        <td>
                                            {{$container->cargo}}
                                        </td>
                                        <td>
                                            {{$container->detail_barang}}
                                        </td>
                                        <td>
                                            {{$container->seal}}
                                        </td>
                                        <td>
                                            {{$container->seal}}
                                        </td>
                                        <td>
                                            {{$container->seal}}
                                        </td>
                                        <td>
                                            @rupiah($container->biaya_trucking)
                                        </td>
                                        <td>
                                            {{$report}}
                                        </td>


                                        <td class="text-center text-nowrap">
                                            <a href="/downloadcoload/{{ $container->id }}"
                                                class="btn btn-success rounded-pill">Download CONTAINER <i
                                                    class="bi bi-download"></i>

                                            </a>


                                        </td>



                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <!-- END Datatable -->
                </div>
            </div>

            <!-- END Portlet -->
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>

    </div>
@endsection
