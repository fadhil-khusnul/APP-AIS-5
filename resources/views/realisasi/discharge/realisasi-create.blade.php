@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- BEGIN Portlet -->
            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="header-title">Activity</h3>
                    <i class="header-divider"></i>
                    <div class="header-wrap header-wrap-block justify-content-start">
                        <!-- BEGIN Breadcrumb -->

                        <div class="breadcrumb breadcrumb-transparent mb-0">
                            <a href="/realisasi-discharge" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-primary">Activity</span>
                            </a>
                            <a href="/realisasi-discharge" class="breadcrumb-item">
                                <span class="breadcrumb-text text-primary">Discharge</span>
                            </a>

                            <a href="/realisasi-discharge" class="breadcrumb-item">
                                @if ($active == "Plan")

                                <span class="breadcrumb-text text-warning">{{$active}}</span>
                                @endif
                                @if ($active == "Process")
                                <span class="breadcrumb-text text-success">{{$active}}</span>
                                @endif
                                @if ($active == "Realisasi")
                                <span class="breadcrumb-text text-danger">{{$active}}</span>
                                @endif
                            </a>


                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>



        <form action="#" class="row row-cols-lg-12 g-3" id="valid_realisasi" name="valid_realisasi">
            <input type="hidden" name="old_slug" id="old_slug" value="{{ $plandischarge->slug }}">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <div class="col-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <div class="col-md-12 text-center mb-3">
                            <h3 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center"> {{ $plandischarge->vessel }} ( {{ $plandischarge->select_company }}
                                )</h3>
                        </div>
                        <div class="col-md-12 mb-3">
                            <table border="0" style="margin-left: auto; margin-right:auto">
                                <tr>
                                    <td width="45%">Nomor DO</td>
                                    <td width="5%">:</td>
                                    <td width="50%">{{ $plandischarge->nomor_do }}</td>
                                </tr>
                                <tr>
                                    <td width="45%">Tanggal Tiba</td>
                                    <td width="5%">:</td>
                                    <td width="50%">{{ \Carbon\Carbon::parse($plandischarge->tanggal_tiba)->isoFormat('dddd, DD MMMM YYYY') }}</td>                                </td>
                                </tr>
                                <tr>
                                    <td width="45%">Vessel/Voyage</td>
                                    <td width="5%">:</td>
                                    <td width="50%">{{ $plandischarge->vessel }}</td>
                                </tr>
                                <tr>
                                    <td>Vessel Code</td>
                                    <td>:</td>
                                    <td>{{ $plandischarge->vessel_code }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Company</td>
                                    <td>:</td>
                                    <td>{{ $plandischarge->select_company }}</td>
                                </tr>
                                <tr>
                                    <td>Pengirim</td>
                                    <td>:</td>
                                    <td>{{ $plandischarge->pengirim }}</td>
                                </tr>
                                <tr>
                                    <td>Penerima</td>
                                    <td>:</td>
                                    <td>{{ $plandischarge->penerima }}</td>
                                </tr>
                                <tr>
                                    <td>Activity</td>
                                    <td>:</td>
                                    <td>{{ $plandischarge->activity }}</td>
                                </tr>
                                <tr>
                                    <td>POL (Port of Loading)</td>
                                    <td>:</td>
                                    <td>{{ $plandischarge->pol }}</td>
                                </tr>
                                
                                <tr>
                                    <td>POD (Port of Discharge)</td>
                                    <td>:</td>
                                    <td>{{ $plandischarge->pod }}</td>
                                </tr>
                                <tr>
                                    <td>Biaya DO (Rp.)</td>
                                    <td>:</td>
                                    <td>@rupiah($plandischarge->biaya_do)</td>
                                </tr>
                            </table>

                            <div class="text-center mt-3">
                                <a href="/processdischarge-create/{{ $plandischarge->slug }}"
                                    class="btn btn-success "><i
                                    class="fa fa-arrow-left"></i> ke Process
                                </a>
                            </div>

                        </div>
                      

                    </div>

                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>

            <div class="col-md-12 col-xl-12">
                <div class="portlet">

                    <div class="portlet-body">
                        <hr>

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>INPUT KONTAINER :</b></label>
                        </div>

                        <div class="row row-cols-lg-auto py-3 g-3">
                            <label for="" class="col-auto col-form-label">Filter Tabel :</label>


                            <div class="col-md-6">
                                <select multiple aria-placeholder="Pilih Size" id="pilih_size_in" name="pilih_size_in"
                                    class="form-select" onchange="fun_pilih_size_in(this)">
                                    <label for="">Pilih Size</label>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}">{{ $size->size_container }}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-md-6">
                                <select multiple id="pilih_type_in" name="pilih_type_in" class="form-select"
                                    onchange="fun_pilih_type_in(this)">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}">{{ $type->type_container }}</option>
                                    @endforeach

                                </select>

                            </div>



                        </div>
                        <div class="table-responsive">
                            <table id="table_biaya1" class="table table-bordered table-hover autosize"
                                style="width: 100% !important">
                                <thead id="" class="table-danger">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Size Kontainer</th>
                                        <th class="text-center">Type Kontainer</th>
                                        <th class="text-center">Nomor Kontainer</th>
                                        <th class="text-center">Tanggal Dooring</th>
                                        <th class="text-center">Lokasi Pickup</th>
                                        <th class="text-center">Tanggal MTY</th>
                                        <th class="text-center">Lokasi MTY</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_detail" class="text-center">
                                    @foreach ($containers_realisasi as $container)
                                        <tr>
                                            <td>
                                                @if ($container->tanggal_mty != null)
                                                    <button type="button" id="btn_detail" name="btn_detail"
                                                        class="btn btn-primary btn-sm text-nowrap"
                                                        value="{{ $container->id }}" onclick="detail(this)">Edit <i
                                                            class="fa fa-eye"></i></button>
                                                @else
                                                    <button type="button" id="btn_detail" name="btn_detail"
                                                        class="btn btn-success btn-sm text-nowrap"
                                                        value="{{ $container->id }}" onclick="detail(this)">Input
                                                        <i class="fa fa-pencil"></i></button>
                                                @endif


                                            </td>
                                            <td>

                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $container->size }}
                                            </td>
                                            <td>
                                                {{ $container->type }}
                                            </td>
                                            <td>
                                                @if ($container->nomor_kontainer != null)
                                                    {{ $container->nomor_kontainer }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($container->tanggal_kembali != null)
                                                    {{ \Carbon\Carbon::parse($container->tanggal_kembali)->isoFormat('dddd, DD MMMM YYYY') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($container->lokasi_kembali != null)
                                                    {{ $container->lokasi_kembali }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($container->tanggal_mty != null)
                                                    {{ \Carbon\Carbon::parse($container->tanggal_mty)->isoFormat('dddd, DD MMMM YYYY') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($container->lokasi_mty != null)
                                                    {{ $container->lokasi_mty }}
                                                @else
                                                    -
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                            <div class="text-center mt-3">

                                <a href="/invoice-discharge-create/{{ $plandischarge->slug }}" class="btn btn-success ">
                                    Invoice <i class="fa fa-arrow-right"></i>
                                </a>
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
                    <div class="portlet-body">

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>INFORMASI KONTAINER :</b></label>
                        </div>

                        <div class="row row-cols-lg-auto py-5 g-3">
                            <label for="" class="col-form-label">Filter Tabel :</label>

                            <div class="col-6">
                                <select id="pilih_status_if1" name="pilih_status_if1" class="form-select pilih"
                                    onchange="pilih_status_if1_fun(this)">
                                    <option selected value="">Pilih Status Container</option>
                                    <option value="BIASA">BIASA</option>
                                    <option value="ALIH-KAPAL">ALIH-KAPAL</option>


                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_pod_if1" name="pilih_pod_if1" class="form-select"
                                    onchange="pilih_pod_if1_fun(this)">
                                    @foreach ($pelabuhans as $pelabuhan)
                                        <option value="{{ $pelabuhan->nama_pelabuhan }}">
                                            {{ $pelabuhan->nama_pelabuhan }}/{{ $pelabuhan->area_code }}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_pot_if1" name="pilih_pot_if1" class="form-select"
                                    onchange="pilih_pot_if1_fun(this)">
                                    @foreach ($pelabuhans as $pelabuhan)
                                        <option value="{{ $pelabuhan->nama_pelabuhan }}">
                                            {{ $pelabuhan->nama_pelabuhan }}/{{ $pelabuhan->area_code }}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_size_if1" name="pilih_size_if1" class="form-select pilih"
                                    onchange="pilih_size_if1_fun(this)">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}">{{ $size->size_container }}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_type_if1" name="pilih_type_if1" class="form-select pilih"
                                    onchange="pilih_type_if1_fun(this)">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}">{{ $type->type_container }}</option>
                                    @endforeach

                                </select>

                            </div>



                        </div>
                        <div class="table-responsive">

                            <table id="table_informasi1" class="table table-bordered table-striped table-hover autosize"
                                style="width: 100% !important">
                                <thead class="table">
                                    <tr>
                                        <th>No</th>
                                        <th>Size</th>
                                        <th>Type</th>
                                        <th>Nomor Kontainer</th>
                                        <th>Cargo</th>
                                        <th>Seal Kontainer</th>
                                        <th>Tanggal Dooring</th>
                                        <th>Lokasi Pickup</th>
                                        <th>Penerima Barang</th>
                                        <th>Alamat Pengantaran</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($containers_realisasi as $container)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $container->size }}</td>
                                            <td>{{ $container->type }}</td>
                                            <td>{{ $container->nomor_kontainer }}</td>
                                            <td>{{ $container->cargo }}</td>
                                            <td>
                                                @if ($sealsc->count() == 1)
                                                    @foreach ($sealsc as $seal)
                                                        @if ($seal->kontainer_id_discharge == $container->id)
                                                            {{ $seal->seal_kontainer }}
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <ol type="1.">

                                                        @foreach ($sealsc as $seal)
                                                            @if ($seal->kontainer_id_discharge == $container->id)
                                                                <li id="seal[{{ $container->id }}]">
                                                                    {{ $seal->seal_kontainer }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            </td>

                                            <td>
                                                {{ \Carbon\Carbon::parse($container->tanggal_kembali)->isoFormat('dddd, DD MMMM YYYY') }}
                                            </td>
                                            <td>{{ $container->lokasi_kembali }}</td>
                                            <td>{{ $container->penerima }}</td>
                                            <td>{{ $container->alamat_pengantaran }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>


                        </div>
                        <div class="row row-cols-lg-auto py-5 g-3">
                            <label for="" class="col-form-label">Filter Tabel :</label>


                            <div class="col-6">
                                <select multiple id="pilih_size_if2" name="pilih_size_if2" class="form-select"
                                    onchange="pilih_size_if2_fun(this)">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}">{{ $size->size_container }}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_type_if2" name="pilih_type_if2" class="form-select"
                                    onchange="pilih_type_if2_fun(this)">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}">{{ $type->type_container }}</option>
                                    @endforeach

                                </select>

                            </div>



                        </div>

                        <div class="table-responsive mt-5">


                            <table id="table_informasi2" class="table table-bordered table-striped table-hover autosize"
                                style="width: 100% !important">
                                <thead class="table">
                                    <tr>
                                        <th>No</th>
                                        <th>Size</th>
                                        <th>Type</th>
                                        <th>Container</th>
                                        <th>Jaminan Kontainer (Rp.)</th>
                                        <th>Cleaning Up (Rp.)</th>
                                        <th>Retribusi (Rp.)</th>
                                        <th>THC Lolo (Rp.)</th>
                                        <th>Driver/No. Polisi</th>
                                        <th>Vendor Trucking</th>
                                        <th>Biaya Trucking</th>
                                        <th>Biaya Supir</th>
                                        <th>Empty Return To</th>
                                        <th>Total Biaya Lain</th>   
                                        <th>Remark</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($containers_info as $container)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $container->size }}</td>
                                            <td>{{ $container->type }}</td>
                                            <td>{{ $container->nomor_kontainer }}</td>
                                            <td>@rupiah($container->jaminan_kontainer)</td>
                                            <td>@rupiah($container->biaya_cleaning)</td>
                                            <td>@rupiah($container->biaya_retribusi)</td>
                                            <td>@rupiah($container->biaya_thc)</td>
                                            <td>
                                                @if ($container->nomor_polisi != null)
                                                    {{ $container->mobils->nama_supir }}/{{ $container->mobils->nomor_polisi }}
    
                                                @endif
                                            </td>
                                            <td>
                                                @if ($container->nomor_polisi != null)
                                                    {{ $container->mobils->vendors->nama_vendor }}
    
                                                @endif
                                            </td>
                                           
                                            <td>@rupiah($container->biaya_trucking)</td>
                                            <td>@rupiah($container->ongkos_supir)</td>
                                            <td>{{ $container->return_to }}</td>
                                            <td>@rupiah($container->total_biaya_lain)</td>
                                            <td>{{ $container->remark }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modal-job" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_job" id="valid_job">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="new_id" id="new_id">
                <input type="hidden" name="job_id" id="job_id" value="{{ $plandischarge->id }}">


                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INPUT KONTAINER</h5> <h5 class="modal-title" id="nomor_kontainer"></h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <table>
                           
                            <tr>
                                <td width="35%">Size/Type</td>
                                <td width="5%">:</td>
                                <td width="60%" id="size_type"></td>
                            </tr>
                            <tr>
                                <td width="35%">Barang (Cargo)</td>
                                <td width="5%">:</td>
                                <td width="60%" id="cargo"></td>
                            </tr>
                        </table>

                    
                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Tanggal MTY :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="tanggal_mty" name="tanggal_mty" placeholder="Tanggal Dooring..."
                                    value="" required>

                            </div>
                        </div>

                        <div class="row ">


                            <label for="" class="col-sm-4 col-form-label">Lokasi MTY :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select required data-bs-toggle="tooltip" id="lokasi_mty" name="lokasi_mty"
                                    class="form-select" required>
                                    <option selected disabled value="0">Pilih Lokasi MTY</option>
                                    @foreach ($lokasis as $lokasi)
                                        <option value="{{ $lokasi->nama_depo }}">
                                            {{ $lokasi->nama_depo }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/discharge-realisasi.js"></script>

    <script>
        $(document).ready(function() {
            $('input, select, .date_activity').blur(function() {
                var $txt = $(this).val();
                $(this).attr('data-bs-original-title', $txt);
            })

            let tanggal_tiba = $("#tanggal_tiba").val();
            tanggal_tiba = moment(tanggal_tiba, "YYYY-MM-DD").format("dddd, DD-MMMM-YYYY")
            $("#tanggal_tiba").val(tanggal_tiba);
        })

        $('.modal>.modal-dialog').draggable({
            cursor: 'move',
            handle: '.modal-header, .modal-footer'
        });
        $('.modal>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');
        $('.modal>.modal-dialog>.modal-content>.modal-footer').css('cursor', 'move');
    
    </script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/datatable/extension/export_filter_kontainer.js"></script>

@endsection
