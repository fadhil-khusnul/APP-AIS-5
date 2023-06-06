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
                            <h4 class="widget8-highlight">{{count($containers)}}</h4>
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
                            <h4 class="widget8-highlight">{{$containers->whereNotNull("nomor_kontainer")->count()}}</h4>
                            <h6 class="widget8-title">Container Beroperasi</h6>
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
                            <h4 class="widget8-highlight">{{$containers->whereNull("nomor_kontainer")->count()}}</h4>
                            <h6 class="widget8-title">Container Tidak Beroperasi</h6>
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
                            <h4 class="widget8-highlight">@rupiah($lunas_dibayar)</h4>
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
                            <h4 class="widget8-highlight">@rupiah($belum_lunas)</h4>
                            <h6 class="widget8-title">Total Biaya Trucking Belum Lunas</h6>

                        </div>
                    </div>
                    <!-- END Widget -->
                </div>
            </div>

        </div>


        <div class="col-md-12 col-xl-12">

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
                                <th>Status Pelunasan</th>
                                <th></th>
                                <th>Tanggal Kegiatan</th>
                                <th>Veseel</th>
                                <th>Nomor Kontainer</th>
                                <th>Vendor</th>
                                <th>Supir/Nomor Polisi</th>
                                <th>Biaya Trucking</th>
                                <th>Ongkos Supir</th>
                                <th>Terbayar</th>
                                <th>Selisih</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($containers as $container)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>

                                        @if ($container->biaya_trucking == null || $container->ongkos_supir == null)
                                            <span class="badge badge-label-primary">Belum Ada Biaya <i
                                                    class="fa fa-exclamation"></i></span>
                                        @elseif (($container->biaya_trucking - $container->ongkos_supir - (float)$container->dibayar) == 0)
                                            <span class="badge badge-label-success">Lunas <i class="fa fa-check"></i></span>
                                        @elseif (($container->biaya_trucking - $container->ongkos_supir - (float)$container->dibayar) > 0)
                                            <span class="badge badge-label-danger">Belum Lunas <i class="fa fa-exclamation"></i></span>
                                        @endif
                                    </td>
                                    <td>

                                        @if (($container->biaya_trucking - $container->ongkos_supir - (float)$container->dibayar) > 0)
                                            <button value="{{ $container->id }}" type="button" onclick="bayar(this)"
                                                class="btn btn-label-success btn-sm text-nowrap ">Bayar <i
                                                    class="fa fa-arrow-right"></i></button>
                                        @else
                                            <button disabled type="button"
                                                class="btn btn-label-secondary btn-sm text-nowrap ">Bayar <i
                                                    class="fa fa-arrow-right"></i></button>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($container->date_activity != null)
                                            {{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $container->planload->vessel }}
                                    </td>

                                    <td>
                                        @if ($container->nomor_kontainer != null)
                                            {{ $container->nomor_kontainer }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($container->nomor_polisi != null)
                                            {{ $container->mobils->vendors->nama_vendor }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($container->nomor_polisi != null)
                                            {{ $container->mobils->nama_supir }}/{{ $container->mobils->nomor_polisi }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        @if ($container->biaya_trucking != null)
                                            @rupiah($container->biaya_trucking)
                                    </td>
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
                                    @rupiah((float)$container->dibayar)
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($container->biaya_trucking != null)
                                    @rupiah(($container->biaya_trucking - $container->ongkos_supir - (float)$container->dibayar))
                                    {{-- @rupiah($container->selisih) --}}
                                @else
                                -
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

    <div class="modal fade" id="modal_biaya_do">
        <div class="modal-dialog modal-dialog-centered">

            <form class="modal-content" id="valid_pod" name="valid_pod">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="id_container" id="id_container">
                <input type="hidden" name="old_terbayar" id="old_terbayar">
                <input type="hidden" name="old_selisih" id="old_selisih">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan Nominal Yang Ingin Dibayar</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Nominal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="dibayar" name="dibayar" placeholder="Nominal..."
                                        required onblur="blur_terbayar(this)">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Selisih : <label id="selisih" class="currency-rupiah"> </label></label>



                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnFinish1" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/vendor_truck.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>
@endsection
