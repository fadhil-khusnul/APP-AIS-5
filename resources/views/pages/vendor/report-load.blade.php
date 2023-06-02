@extends('layouts.main')

@section('content')
    <div class="row">


        <div class="col-md-4">
            <div class="portlet">
                <div class="portlet-body">
                    <!-- BEGIN Widget -->
                    <div class="widget8">
                        <div class="widget8-content">
                            <!-- BEGIN Avatar -->
                            <div class="avatar avatar-label-info avatar-circle widget8-avatar">
                                <div class="avatar-display mt-1">
                                    <i class="fa fa-truck"></i>
                                </div>
                            </div>
                            <!-- END Avatar -->
                            <h4 class="widget8-highlight">5000</h4>
                            <h6 class="widget8-title">Total Container</h6>
                        </div>
                    </div>
                    <!-- END Widget -->
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="portlet">
                <div class="portlet-body">
                    <!-- BEGIN Widget -->
                    <div class="widget8">
                        <div class="widget8-content">
                            <!-- BEGIN Avatar -->
                            <div class="avatar avatar-label-primary avatar-circle widget8-avatar">
                                <div class="avatar-display mt-1">
                                    <i class="fa fa-truck"></i>
                                </div>
                            </div>
                            <!-- END Avatar -->
                            <h4 class="widget8-highlight">3000</h4>
                            <h6 class="widget8-title">Container Dipakai</h6>
                        </div>
                    </div>
                    <!-- END Widget -->
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="portlet">
                <div class="portlet-body">
                    <!-- BEGIN Widget -->
                    <div class="widget8">
                        <div class="widget8-content">
                            <!-- BEGIN Avatar -->
                            <div class="avatar avatar-label-secondary avatar-circle widget8-avatar">
                                <div class="avatar-display mt-1">
                                    <i class="fa fa-truck"></i>
                                </div>
                            </div>
                            <!-- END Avatar -->
                            <h4 class="widget8-highlight">2000</h4>
                            <h6 class="widget8-title">Container Tidak Dipakai</h6>
                        </div>
                    </div>
                    <!-- END Widget -->
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="portlet">
                <div class="portlet-body">
                    <!-- BEGIN Widget -->
                    <div class="widget8">
                        <div class="widget8-content">
                            <!-- BEGIN Avatar -->
                            <div class="avatar avatar-label-success avatar-circle widget8-avatar">
                                <div class="avatar-display">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                            </div>
                            <!-- END Avatar -->
                            <h4 class="widget8-highlight">Rp. 200.000.000</h4>
                            <h6 class="widget8-title">Total Biaya Trucking Lunas</h6>

                        </div>
                    </div>
                    <!-- END Widget -->
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="portlet">
                <div class="portlet-body">
                    <!-- BEGIN Widget -->
                    <div class="widget8">
                        <div class="widget8-content">
                            <!-- BEGIN Avatar -->
                            <div class="avatar avatar-label-danger avatar-circle widget8-avatar">
                                <div class="avatar-display">
                                    <i class="fa fa-exclamation-circle"></i>
                                </div>
                            </div>
                            <!-- END Avatar -->
                            <h4 class="widget8-highlight">Rp. 1.000.000.000</h4>
                            <h6 class="widget8-title">Total Biaya Trucking Belum Lunas</h6>

                        </div>
                    </div>
                    <!-- END Widget -->
                </div>
            </div>

        </div>


        <div class="col-md-6 col-xl-12">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">Tabel {{ $title }}</h3>
                </div>
                <div class="portlet-body">
                    <hr>
                    <!-- BEGIN Datatable -->
                    <table id="input-seal" class="table table-bordered table-striped table-hover autosize">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Veseel</th>
                                <th>Nomor Kontainer</th>
                                <th>Vendor</th>
                                <th>Supir/Nomor Polisi</th>
                                <th>Biaya Trucking</th>
                                <th>Ongkos Supir</th>
                                <th>Selisih</th>
                                <th>Status Pelunasan</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($containers as $container)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        @if ($container->date_activity != null)
                                        {{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}
                                        @endif
                                    </td>
                                    <td>
                                        {{$container->planload->vessel}}
                                    </td>

                                    <td>
                                        @if ($container->nomor_kontainer != null)
                                        {{$container->nomor_kontainer}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($container->nomor_polisi != null)
                                        {{$container->mobils->vendors->nama_vendor}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($container->nomor_polisi != null)

                                        {{$container->mobils->nama_supir}}/{{$container->mobils->nomor_polisi}}
                                        @else
                                        -
                                        @endif
                                    </td>

                                    <td>
                                        @if ($container->biaya_trucking != null)
                                        @rupiah($container->biaya_trucking)</td>
                                        @else
                                        -
                                        @endif
                                    <td>
                                        @if ($container->biaya_trucking != null)

                                        @rupiah($container->ongkos_supir)
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($container->biaya_trucking != null)

                                        @rupiah($container->selisih)</td>
                                        @else
                                        -
                                        @endif
                                    <td>

                                        @if ($container->status_pelunasan == 'lunas')
                                        <span class="badge badge-label-success">Lunas <i
                                                class="fa fa-check"></i></span>
                                        @else
                                            <span class="badge badge-label-danger">Belum Lunas <i
                                                    class="fa fa-exclamation"></i></span>
                                        @endif
                                    </td>
                                    <td>

                                        @if ($container->status_pelunasan != 'lunas')
                                            <button value="{{ $container->id }}" type="button"
                                                onclick="input_bl(this)"
                                                class="btn btn-label-success btn-sm text-nowrap ">Bayar <i
                                                    class="fa fa-arrow-right"></i></button>
                                        @else
                                        <button disabled  type="button"
                                            class="btn btn-label-secondary btn-sm text-nowrap ">Bayar <i
                                                class="fa fa-arrow-right"></i></button>
                                        @endif

                                    </td>






                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- END Datatable -->
                </div>
            </div>

            <!-- END Portlet -->
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/seal.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>
@endsection
