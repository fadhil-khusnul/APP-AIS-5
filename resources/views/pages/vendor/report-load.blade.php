@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <!-- BEGIN Portlet -->
            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="header-title">

                        <a type="button" href="#" onclick="GoBackWithRefresh();return false;">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </h3>
                    <i class="header-divider"></i>
                    <div class="header-wrap header-wrap-block justify-content-start">
                        <!-- BEGIN Breadcrumb -->

                        <div class="breadcrumb breadcrumb-transparent mb-0">
                            <a href="/report-vendor-load" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-secondary">Report</span>
                            </a>


                            <a href="/report-vendor-load" class="breadcrumb-item">
                                <span class="breadcrumb-text text-secondary">Load</span>
                            </a>


                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-12">
            <div class="portlet">

                <div class="portlet-body">

                    <div class="col-md-12 text-center mb-3">
                        <h1 style="margin-left: auto !important; margin-right:auto !important"
                            class="portlet-title text-center">KAPAL :
                        </h1>
                        <h3 style="margin-left: auto !important; margin-right:auto !important"
                            class="portlet-title text-center"><u>
                                {{ $planload->vessel }} ( {{ $planload->select_company }})</u></h3>
                    </div>
                    <div class="col-md-12 mb-3 table-responsive">
                        <table border="0" style="margin-left: auto; margin-right:auto;">
                            <tr>
                                <td width="45%">Vessel/Voyage</td>
                                <td width="5%">:</td>
                                <td width="">
                                    <label for="" id="nama_kapal">{{ $planload->vessel }}</label>

                                </td>
                            </tr>
                            <tr>
                                <td>Vessel Code</td>
                                <td>:</td>
                                <td><label for="" id="kode_kapal">{{ $planload->vessel_code }}</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Shipping Company</td>
                                <td>:</td>
                                <td> <label for="" id="">{{ $planload->select_company }}</label>

                                </td>
                            </tr>
                            <tr>
                                <td>Activity</td>
                                <td>:</td>
                                <td>{{ $planload->activity }}

                                </td>
                            </tr>
                            <tr>
                                <td>POL (Port of Loading)</td>
                                <td>:</td>
                                <td>{{ $planload->pol }}

                                </td>
                            </tr>

                        </table>

                        <div class="col-12 text-center mt-3">
                            <a href="/processload-create/{{ $planload->slug }}" type="button" class="btn btn-success">ke
                                Process <i class="fa fa-arrow-right"></i></a>
                        </div>


                    </div>


                    <!-- END Form -->
                </div>
            </div>
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>
        <div class="col-md-12 col-xl-12">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title text-center"><u><b>KONTAINER</b></u></h3>
                </div>
                <div class="portlet-body">
                    <hr>
                    <label for="" class="col-form-label">Filter Tabel :</label>
                    <div class="row row-cols-lg-auto py-3 px-4">
                        {{-- <div class="col-sm-5 col-lg-4">
                            <input class="form-control" type="text" id="daterangepicker_vendor">
                        </div> --}}

                        <div class="col-sm-5 col-lg-4">
                            <div class="mb-2">
                                <!-- BEGIN Input Group -->
                                <div class="input-group input-daterange">
                                    <input type="text" id="min" class="form-control" placeholder="From"
                                        onchange="filter_date()">
                                    <span class="input-group-text">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <input type="text" id="max" class="form-control" placeholder="To"
                                        onchange="filter_date()">
                                </div>

                            </div>
                        </div>
                        <div class="col-4">
                            <select multiple id="pilih_vendor" name="pilih_vendor" class="form-select"
                                onchange="filter_vendor(this)">
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->nama_vendor }}">{{ $vendor->nama_vendor }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-6">
                            <select id="pilih_status" name="pilih_status" class="form-select"
                                onchange="filter_status(this)">
                                <option value="" selected>Pilih Status</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                                <option value="Sudah Lunas">Sudah Lunas</option>

                            </select>

                        </div>





                    </div>

                    

                    <!-- BEGIN Datatable -->
                    <table id="vendor_bayar_Load" class="table table-bordered table-striped table-hover autosize mt-5"
                        style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th></th>
                                <th>Status Pelunasan</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Nomor Kontainer</th>
                                <th>Vendor</th>
                                <th>Supir/Nomor Polisi</th>
                                <th>Biaya Trucking</th>
                                <th>Ongkos Supir</th>
                                <th>Terbayar</th>
                                <th>Tagihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($containers as $container)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>

                                        @if ($container->biaya_trucking - $container->ongkos_supir - (float) $container->dibayar == 0)
                                            <input readonly disabled checked type="checkbox" class="form-check-input"
                                                id="kontainer_check[{{ $loop->iteration }}]">
                                        @elseif ($container->biaya_trucking - $container->ongkos_supir - (float) $container->dibayar > 0)
                                            <div class="validation-container">
                                                <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                    class="form-check-input check-container1"
                                                    id="kontainer_check[{{ $loop->iteration }}]" onchange="countCheck()" name="letter"
                                                    value="{{ $container->id }}" required autofocus>

                                            </div>
                                        @endif
                                    </td>

                                    <td>

                                        @if ($container->biaya_trucking - $container->ongkos_supir - (float) $container->dibayar == 0)
                                            <i class="marker marker-dot text-success"></i> Sudah Lunas
                                        @elseif ($container->biaya_trucking - $container->ongkos_supir - (float) $container->dibayar > 0)
                                            <i class="marker marker-dot text-danger"></i>Belum Lunas
                                        @endif
                                    </td>

                                    <td>
                                        @if ($container->date_activity != null)
                                            <input type="hidden" id="date[{{ $loop->iteration }}]" name="date"
                                                value="{{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}">
                                            {{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}
                                        @endif
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
                                            @rupiah((float) $container->dibayar)
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($container->biaya_trucking != null)
                                            @rupiah($container->biaya_trucking - $container->ongkos_supir - (float) $container->dibayar)
                                            {{-- @rupiah($container->selisih) --}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <label for="" class="" style="margin-left: 10px"><b id="nomor_check">0</b> dari <b id="jumlah">{{count($containers)}}</b> Kontainer dipilih.</label>


                    <!-- END Datatable -->
                    <div style="" class="text-center">
                        <button id="add_biaya" type="button" onclick="bayar()" class="btn btn-success">Bayar <i
                                class="fa fa-arrow-right"></i></button>
                    </div>
                </div>




            </div>

            <!-- END Portlet -->
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>

        @if (count($reports) > 0)
            <div class="col-md-12 col-xl-12">

                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title text-center"><u><b>TABEL PEMBAYARAN</b></u></h3>
                    </div>
                    <div class="portlet-body">
                        <hr>
                        {{-- <label for="" class="col-form-label">Filter Tabel :</label>
                    <div class="row row-cols-lg-auto py-3 px-4">
                        

                        <div class="col-sm-5 col-lg-4">
                            <div class="mb-2">
                                <!-- BEGIN Input Group -->
                                <div class="input-group input-daterange">
                                    <input type="text" id="min_bayar" class="form-control" placeholder="From" onchange="filter_date_bayar()">
                                    <span class="input-group-text">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                    <input type="text" id="max_bayar" class="form-control" placeholder="To" onchange="filter_date_bayar()">
                                </div>
                                
                            </div>
                        </div>
                       
                        <div class="col-4">
                            <select multiple id="pilih_vendor_bayar" name="pilih_vendor_bayar" class="form-select" onchange="filter_vendor_bayar(this)">
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->nama_vendor }}">{{ $vendor->nama_vendor }}</option>
                                @endforeach
                            </select>

                        </div>
                        
                        <div class="col-6">
                            <select id="pilih_status_bayar" name="pilih_status_bayar" class="form-select" onchange="filter_status_bayar(this)">
                                <option value="Belum Lunas">Belum Lunas</option>
                                <option value="Sudah Lunas">Sudah Lunas</option>

                            </select>

                        </div>


                       


                    </div> --}}



                        <!-- BEGIN Datatable -->
                        <table id="tabel_history" class="table table-bordered table-striped table-hover autosize mt-5"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th></th>
                                    <th>Nomor Kontainer</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Dibayarkan ke</th>
                                    <th>Cara Bayar</th>
                                    <th>Keterangan Bayar</th>
                                    <th>Total Dibayar</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    {{-- @foreach ($report as $item) --}}

                                    {{-- @endforeach --}}
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{-- @foreach ($report as $item) --}}

                                            <a type="button" href="/preview-vendor-load/{{ $report[0]->path }}"
                                                class="btn btn-primary btn-sm ">Preview Report <i
                                                    class="fa fa-eye"></i></a>
                                            <button type="button" value="{{ $report[0]->path }}"
                                                onclick="delete_report(this)" class="btn btn-danger btn-sm "><i
                                                    class="fa fa-refresh"></i></button>


                                            {{-- @endforeach --}}
                                        </td>
                                        <td>
                                            @foreach ($report as $item)
                                                <li>{{ $item->container_planloads->nomor_kontainer }}</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($report[0]->tanggal_bayar != null)
                                                <input type="hidden" id="date[{{ $loop->iteration }}]" name="date"
                                                    value="{{ \Carbon\Carbon::parse($report[0]->tanggal_bayar)->isoFormat('dddd, DD MMMM YYYY') }}">
                                                {{ \Carbon\Carbon::parse($report[0]->tanggal_bayar)->isoFormat('dddd, DD MMMM YYYY') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($report[0]->dibayarkan_ke != null)
                                                {{ $report[0]->dibayarkan_ke }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            {{ $report[0]->cara_bayar }}
                                        </td>
                                        <td>
                                            {{ $report[0]->keterangan_transfer }}
                                        </td>
                                        <td>
                                            @rupiah($report[0]->dibayar)
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
        @endif


    </div>

    <div class="modal fade" id="modal_biaya_do">
        <div class="modal-dialog modal-dialog-centered">

            <form class="modal-content" id="valid_pod" name="valid_pod">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="id_container" id="id_container">
                <input type="hidden" name="old_terbayar" id="old_terbayar">
                <input type="hidden" name="old_selisih" id="old_selisih">
                <input type="hidden" name="old_slug" id="old_slug" value="{{ $planload->slug }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan Nominal Yang Ingin Dibayar</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3">
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Bayar :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="tanggal_bayar"
                                    name="tanggal_bayar" placeholder="Tanggal Bayar..." required>

                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Dibayarkan ke :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="dibayarkan_ke" name="dibayarkan_ke" required></textarea>

                            </div>
                        </div>

                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Pilih Cara Bayar :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="cara_bayar" name="cara_bayar" class="form-select"
                                    required>
                                    <option disabled selected>Pilih Cara Bayar</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Masukkan Keterangan (Jika Memilih
                                Transfer)</label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_transfer" name="keterangan_transfer"
                                    placeholder="(ex. Tranfer Bank ke Bank BNI a.n. Pemilik Rekening)"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Nominal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah"
                                        id="dibayar" name="dibayar" placeholder="Nominal..." required
                                        onblur="blur_terbayar(this)">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Selisih : <label id="selisih"
                                    class="currency-rupiah"> </label></label>
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



    <script type="text/javascript">
        $('.modal>.modal-dialog').draggable({
            cursor: 'move',
            handle: '.modal-header, .modal-footer'
        });
        $('.modal>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');
        $('.modal>.modal-dialog>.modal-content>.modal-footer').css('cursor', 'move');
    </script>


    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/vendor_truck.js"></script>

@endsection
