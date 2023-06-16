@extends('layouts.main')

@section('content')
    <div class="row">
        {{-- <div class="col-md-4">
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

        </div> --}}


        <div class="col-md-12 col-xl-12">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title text-center">Tabel {{ $title }}</h3>
                </div>
                <div class="portlet-body">
                    <hr>



                    <div class="row row-cols-lg-auto py-5 g-3">
                        <label for="" class="col-form-label">Filter Tabel :</label>
                        {{-- <div class="col-sm-5 col-lg-4">
                            <input class="form-control" type="text" id="daterangepicker_vendor">
                        </div> --}}

                        <div class="col-sm-5 col-lg-4">
                            <div class="mb-2">
                                <!-- BEGIN Input Group -->
                                <div class="input-group input-daterange">
                                    <input type="text" id="min" class="form-control" placeholder="From">
                                    <span class="input-group-text">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <input type="text" id="max" class="form-control" placeholder="To">
                                </div>
                                <!-- END Input Group -->
                            </div>
                        </div>
                        <div class="col-6">
                            <select multiple id="pilih_vendor" name="pilih_vendor" class="form-select" onchange="filter_vendor(this)">
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->nama_vendor }}">{{ $vendor->nama_vendor }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-6">
                            <select id="pilih_status" name="pilih_status" class="form-select" onchange="filter_status(this)">
                                <option selected disabled>Pilih Status Bayar</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                                <option value="Sudah Lunas">Sudah Lunas</option>

                            </select>

                        </div>


                        <div style="" class="">
                            <button id="add_biaya" type="button" onclick="bayar()"
                            class="btn btn-success">Bayar <i class="fa fa-arrow-right"></i></button>
                        </div>


                    </div>






                    <!-- BEGIN Datatable -->
                    <table id="vendor_bayar_Load" class="table table-bordered table-striped table-hover autosize" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th></th>
                                <th>Status Pelunasan</th>
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

                                        @if ($container->biaya_trucking - $container->ongkos_supir - (float)$container->dibayar == 0)
                                            <input readonly disabled checked type="checkbox"
                                                class="form-check-input"
                                                id="kontainer_check[{{ $loop->iteration }}]">
                                        @elseif ($container->biaya_trucking - $container->ongkos_supir - (float)$container->dibayar > 0)
                                        <div class="validation-container">
                                            <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                class="form-check-input check-container1"
                                                id="kontainer_check[{{ $loop->iteration }}]" name="letter"
                                                value="{{ $container->id }}" required autofocus>

                                        </div>

                                        @endif
                                    </td>

                                    <td>

                                        @if (($container->biaya_trucking - $container->ongkos_supir - (float)$container->dibayar) == 0)
                                            <i class="marker marker-dot text-success"></i> Sudah Lunas
                                        @elseif (($container->biaya_trucking - $container->ongkos_supir - (float)$container->dibayar) > 0)
                                            <i class="marker marker-dot text-danger"></i>Belum Lunas
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
                                            @else
                                                -
                                        @endif
                                    </td>
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


    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>


    <script>

            var minEl = $('#min');
            var maxEl = $('#max');

            // Custom range filtering function
            $.fn.DataTable.ext.search.push(function (settings, data, dataIndex) {
                var min = parseInt(minEl.val(), 10);
                console.log(settings);
                var max = parseInt(maxEl.val(), 10);
                var age = parseFloat(data[3]) || 0; // use data for the age column

                if (
                    (isNaN(min) && isNaN(max)) ||
                    (isNaN(min) && age <= max) ||
                    (min <= age && isNaN(max)) ||
                    (min <= age && age <= max)
                ) {
                    return true;
                }

                return false;
            });

            // console.log($.fn.dataTable.ext.search);
        $(document).ready(function() {


            var check = $(".check-container1");

            $("#add_biaya").attr("disabled", "disabled");
            check.click(function() {
                if ($(this).is(":checked")) {
                    $("#add_biaya").removeAttr("disabled");
                } else {
                    $("#add_biaya").attr("disabled", "disabled");
                }
            });
            var tabelvendor = $("#vendor_bayar_Load").DataTable({
                responsive:true,
                paging:true,
                fixedHeader:
                {
                    header:true,

                },
                pageLength : 5,
                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]],

                // scroller: true,

            });


            minEl.on('input', function () {
                tabelvendor.draw();
            });
            maxEl.on('input', function () {
                tabelvendor.draw();
            });
        });








        $('.modal>.modal-dialog').draggable({
                cursor: 'move',
                handle: '.modal-header, .modal-footer'
        });
        $('.modal>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');
        $('.modal>.modal-dialog>.modal-content>.modal-footer').css('cursor', 'move');

    </script>
    <script type="text/javascript" src="{{ asset('/') }}./js/vendor_truck.js"></script>

@endsection
