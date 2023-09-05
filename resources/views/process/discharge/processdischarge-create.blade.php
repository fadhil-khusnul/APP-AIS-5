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
                            <a href="/processdischarge" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-primary">Activity</span>
                            </a>
                            <a href="/processdischarge" class="breadcrumb-item">
                                <span class="breadcrumb-text text-primary">Discharge</span>
                            </a>

                            <a href="/processdischarge" class="breadcrumb-item">
                                <span class="breadcrumb-text text-success">Process</span>
                            </a>


                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>



        <form action="#" class="row row-cols-lg-12 g-3" id="valid_processload" name="valid_processload">
            <input type="hidden" name="old_slug" id="old_slug" value="{{ $plandischarge->slug }}">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <div class="col-md-12 col-xl-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <div class="col-md-12 text-center mb-3">
                            <h1 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center"> DETAIL KAPAL :
                            </h1>
                            <h3 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center"> {{ $plandischarge->vessel }} ( {{ $plandischarge->select_company }}
                                )</h3>
                        </div>
                        <div class="col-md-12 mb-3">
                            <table border="0" style="margin-left: auto; margin-right:auto;">
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
                                    <td>
                                        @rupiah($plandischarge->biaya_do)
                                    </td>
                                </tr>
                            </table>
                            <div class="col-12 text-center mt-3">
                                <button value="{{ $plandischarge->id }}" type="button" onclick="edit_planloaad_job(this)"
                                    class="btn btn-label-primary">Detail Kapal <i
                                        class="fa fa-pencil"></i></button>
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
                        <hr>

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>INPUT KONTAINER :</b></label>
                        </div>

                        <div class="row row-cols-lg-auto py-3 g-3">
                            <label for="" class="col-auto col-form-label">Filter Tabel :</label>


                            <div class="col-12">
                                <select multiple aria-placeholder="Pilih Size" id="pilih_size_in"  name="pilih_size_in" class="form-select" onchange="fun_pilih_size_in(this)">
                                    <label for="">Pilih Size</label>
                                    @foreach ($sizes as $size)
                                    <option value="{{$size->size_container}}">{{$size->size_container}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_type_in" name="pilih_type_in" class="form-select" onchange="fun_pilih_type_in(this)">
                                    @foreach ($types as $type)
                                    <option value="{{$type->type_container}}">{{$type->type_container}}</option>
                                    @endforeach

                                </select>

                            </div>



                        </div>
                        <div class="table-responsive">



                            <table id="table_biaya1" class="table table-bordered table-hover autosize" style="width: 100% !important">
                                <thead id="" class="table-success">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Size Kontainer</th>
                                        <th class="text-center">Type Kontainer</th>
                                        <th class="text-center">Nomor Kontainer</th>
                                        <th class="text-center">Tanggal Dooring</th>
                                        <th class="text-center">Lokasi Pickup</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_detail" class="text-center">
                                    @foreach ($containers as $container)
                                        <tr>
                                            <td>
                                                <button id="button_kontainer[{{ $loop->iteration }}]"
                                                    name="button_kontainer[{{ $loop->iteration }}]"
                                                    class="btn btn-label-danger btn-icon btn-circle btn-sm" type="button"
                                                    value="{{ $container->id }}" onclick="delete_kontainerDB(this)"
                                                    @readonly(true)><i class="fa fa-trash"></i></button>
                                            
                                                @if ($container->tanggal_kembali != null)
                                                    <button type="button" id="btn_detail" name="btn_detail"
                                                        class="btn btn-label-primary btn-sm text-nowrap"
                                                        value="{{ $container->id }}" onclick="detail_edit(this)">Edit <i class="fa fa-eye"></i></button>
                                                @else
                                                    <button type="button" id="btn_detail" name="btn_detail"
                                                        class="btn btn-label-success btn-sm text-nowrap"
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
                                            
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>


                        <div class="mb-5 mt-5 text-center">
                            <button id="detail_kontainer" type="button" onclick="detail_tambah()"
                                class="btn btn-label-success">Tambah Kontainer <i class="fa fa-plus"></i></button>
                                @if ($plandischarge->status == 'Process' || $plandischarge->status == 'Realisasi')
                                <button style="margin-left: 10px" value="{{ $plandischarge->slug }}" type="button" onclick="realisasi_page(this)"
                                class="btn btn-success">to Realisasi <i class="fa fa-arrow-right"></i></button>
                                @endif
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
                                <select id="pilih_status_if1" name="pilih_status_if1" class="form-select pilih" onchange="pilih_status_if1_fun(this)">
                                    <option selected value="">Pilih Status Container</option>
                                    <option value="BIASA">BIASA</option>
                                    <option value="ALIH-KAPAL">ALIH-KAPAL</option>


                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_pod_if1" name="pilih_pod_if1" class="form-select" onchange="pilih_pod_if1_fun(this)">
                                    @foreach ($pelabuhans as $pelabuhan)
                                    <option value="{{$pelabuhan->nama_pelabuhan}}">{{$pelabuhan->nama_pelabuhan}}/{{$pelabuhan->area_code}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_pot_if1" name="pilih_pot_if1" class="form-select" onchange="pilih_pot_if1_fun(this)">
                                    @foreach ($pelabuhans as $pelabuhan)
                                    <option value="{{$pelabuhan->nama_pelabuhan}}">{{$pelabuhan->nama_pelabuhan}}/{{$pelabuhan->area_code}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_size_if1" name="pilih_size_if1" class="form-select pilih" onchange="pilih_size_if1_fun(this)">
                                    @foreach ($sizes as $size)
                                    <option value="{{$size->size_container}}">{{$size->size_container}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_type_if1" name="pilih_type_if1" class="form-select pilih" onchange="pilih_type_if1_fun(this)">
                                    @foreach ($types as $type)
                                    <option value="{{$type->type_container}}">{{$type->type_container}}</option>
                                    @endforeach

                                </select>

                            </div>



                        </div>
                        <div class="table-responsive">

                            <table id="table_informasi1" class="table table-bordered table-striped table-hover autosize" style="width: 100% !important">
                                <thead class="table">
                                    <tr>
                                        <th>No</th>
                                        <th>Status</th>
                                        <th>Tgl. Kegiatan</th>
                                        <th>Pengirim</th>
                                        <th>Penerima</th>
                                        <th>POD</th>
                                        <th>POT</th>
                                        <th>VESEEL POT</th>
                                        <th>Size Container</th>
                                        <th>Type Container</th>
                                        <th>Nomor Container</th>
                                        <th>Cargo</th>
                                        <th>Seal</th>
                                        <th>Lokasi Pickup</th>
                                        <th>Nama Supir/Nomor Polisi</th>
                                        <th>Vendor Truck</th>
                                        <th>Jenis Mobil</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($containers_info as $container)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="align-middle text-nowrap">
                                            @if ($container->status == "Alih-Kapal" || $container->status == "Realisasi-Alih" )
                                            <i class="marker marker-dot text-primary"></i>ALIH-KAPAL
                                            @elseif ($container->status == "Batal-Muat")
                                            <i class="marker marker-dot text-danger"></i>BATAL-MUAT
                                            @else
                                            <i class="marker marker-dot text-success"></i> BIASA
                                            @endif


                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}
                                        </td>
                                        <td>{{$container->pengirim}}</td>
                                        <td>{{$container->penerima}}</td>
                                        <td>{{$container->pod_container}}</td>
                                        <td>{{$container->pot_container}}</td>
                                        <td>{{$container->vessel_pot}}</td>
                                        <td>{{$container->size}}</td>
                                        <td>{{$container->type}}</td>
                                        <td>{{$container->nomor_kontainer}}</td>
                                        <td>{{$container->cargo}}</td>
                                        <td>
                                            @if ($sealsc->count() == 1)
                                                @foreach ($sealsc as $seal)
                                                @if ($seal->kontainer_id == $container->id)
                                                        {{ $seal->seal_kontainer }}

                                                @endif
                                                @endforeach
                                            @else
                                            <ol type="1.">

                                                @foreach ($sealsc as $seal)
                                                    @if ($seal->kontainer_id == $container->id)
                                                        <li id="seal[{{ $container->id }}]">
                                                            {{ $seal->seal_kontainer }}
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ol>
                                            @endif
                                        </td>
                                        <td>{{$container->lokasi_depo}}</td>

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
                                        <td>{{$container->jenis_mobil}}
                                        </td>
                                    </tr>


                                    @endforeach
                                </tbody>

                            </table>


                            </div>
                            <div class="row row-cols-lg-auto py-5 g-3">
                                <label for="" class="col-form-label">Filter Tabel :</label>


                                <div class="col-6">
                                    <select multiple id="pilih_size_if2" name="pilih_size_if2" class="form-select" onchange="pilih_size_if2_fun(this)">
                                        @foreach ($sizes as $size)
                                        <option value="{{$size->size_container}}">{{$size->size_container}}</option>
                                        @endforeach

                                    </select>

                                </div>
                                <div class="col-6">
                                    <select multiple id="pilih_type_if2" name="pilih_type_if2" class="form-select" onchange="pilih_type_if2_fun(this)">
                                        @foreach ($types as $type)
                                        <option value="{{$type->type_container}}">{{$type->type_container}}</option>
                                        @endforeach

                                    </select>

                                </div>



                            </div>

                            <div class="table-responsive mt-5">


                                <table id="table_informasi2" class="table table-bordered table-striped table-hover autosize" style="width: 100% !important">
                                    <thead class="table">
                                        <tr>
                                            <th>No</th>
                                            <th>Container</th>
                                            <th>Size</th>
                                            <th>Type</th>
                                            <th>SPK</th>
                                            <th>Biaya Stuffing</th>
                                            <th>Biaya Trucking</th>
                                            <th>Ongkos Supir</th>
                                            <th>Biaya Seal</th>
                                            <th>Biaya THC POL</th>
                                            <th>Biaya Freight</th>
                                            <th>Biaya LSS</th>
                                            <th>Biaya Lain-Lain</th>
                                            <th>Biaya Alih Kapal</th>
                                            <th>Biaya Batal Muat</th>
                                            <th>Jenis Mobil</th>
                                            <th>Deposit Trucking</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($containers_info as $container)
                                    <tr>

                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>{{$container->nomor_kontainer}}</td>
                                        <td>{{$container->size}}</td>
                                        <td>{{$container->type}}</td>
                                        <td>{{$container->spk}}</td>
                                        <td>@rupiah($container->biaya_stuffing)</td>
                                        <td>@rupiah($container->biaya_trucking)</td>
                                        <td>@rupiah($container->ongkos_supir)</td>
                                        <td>@rupiah($container->biaya_seal)</td>
                                        <td>@rupiah($container->biaya_thc)</td>
                                        <td>@rupiah($container->freight)</td>
                                        <td>@rupiah($container->lss)</td>
                                        <td>@rupiah($container->total_biaya_lain)</td>

                    
                                        <td>
                                            @if ($container->harga_alih != null)

                                            @rupiah($container->alihs->harga_alih_kapal)
                                            @endif

                                        </td>

                                        <td>@rupiah($container->harga_batal)</td>
                                        <td>{{$container->jenis_mobil}}</td>
                                        <td>@if ($container->dana != null)
                                            {{$container->danas->pj}}
                                            @endif
                                        </td>



                                    </tr>






                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>DETAIL BARANG/KONTAINER</b></label>
                        </div>

                        <div class="table-responsive">
                            <table id="table_biaya2" class="table mb-0" style="width: 100% !important">
                                <thead id="" class="table-success">
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Pengirim</th>
                                        <th>Size/Type</th>
                                        <th>Nomor Kontainer</th>
                                        <th>Tanggal Dooring</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody  class="">
                                    @foreach ($containers_barang as $container)
                                        <tr>
                                            <td class="text-center">
                                                <button id="delete_detail" name="delete_detail"
                                                    class="btn btn-label-danger btn-icon btn-circle btn-sm" type="button"
                                                    value="{{ $container['id'] }}" onclick="delete_detailbarangDB(this)"
                                                    @readonly(true)><i class="fa fa-trash"></i></button>
                                                <button id="edit_detail" name="edit_detail"
                                                    class="btn btn-label-primary btn-icon btn-circle btn-sm" type="button"
                                                    value="{{ $container['id'] }}" onclick="detail_barang_edit(this)"
                                                    @readonly(true)><i class="fa fa-pencil"></i></button>
                                            </td>
                                            <td align="center">{{$loop->iteration}}.</td>
                                            <td>{{$container['pengirim']}}</td>
                                            <td>{{$container['size']}}/{{$container['type']}}</td>
                                            <td>{{$container['nomor_kontainer']}}</td>
                                            <td>{{$container['tanggal_kembali']}}</td>
                                            <td class="text-nowrap">
                                                <ol type="1.">
                                                @foreach ($details as $detail)
                                                    @if ($detail->kontainer_id_discharge == $container['id'])
                                                    <li>
                                                        {{ $detail->detail_barang }}
                                                    </li>
                                                    @endif
                                                @endforeach
                                                </ol>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="mb-5 mt-5">
                            <button id="add_biaya" type="button" onclick="detail_barang()"
                                class="btn btn-label-success btn-icon"> <i class="fa fa-plus"></i></button>
                            <button style="float: right" id="add_biaya" type="button" onclick="cetak_packing()"
                                    class="btn btn-label-primary">Cetak List <i class="fa fa-print"></i></button>
                        </div>

                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
            <div class="col-md-6">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>BIAYA LAIN KONTAINER (JIKA ADA)</b></label>
                        </div>

                        <div class="table-responsive">


                        <table id="table_biaya3" class="table mb-0" style="width: 100% !important">
                            <thead id="" class="table-success">
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Pengirim</th>
                                    <th>Size/Type</th>
                                    <th>Nomor Kontainer</th>
                                    <th>Penerima</th>
                                    <th>Total Biaya Lainnya</th>
                                    <th>Keterangan Biaya</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_biaya" class="">
                                @foreach ($new_container_biaya as $biaya)
                                    <tr>
                                        <td class="text-center">
                                            <button id="delete_biaya" name="delete_biaya"
                                                class="btn btn-label-danger btn-icon btn-circle btn-sm" type="button"
                                                value="{{ $biaya['id'] }}" onclick="delete_laiannyaDB(this)"
                                                @readonly(true)><i class="fa fa-trash"></i></button>
                                            <button id="edit_biaya" name="edit_biaya"
                                                class="btn btn-label-primary btn-icon btn-circle btn-sm" type="button"
                                                value="{{ $biaya['id'] }}" onclick="detail_biaya_lain_edit(this)"
                                                @readonly(true)><i class="fa fa-pencil"></i></button>
                                        </td>
                                        <td align="center">

                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $biaya['pengirim'] }}
                                        </td>
                                        <td>{{$biaya['size']}}/{{$biaya['type']}}</td>
                                        <td>{{$biaya['nomor_kontainer']}}</td>
                                        <td>{{$biaya['penerima']}}</td>

                                        <td>
                                            @rupiah($biaya['total_biaya_lain'])
                                        </td>
                                        <td class="text-nowrap">
                                            <ol type="1.">
                                            @foreach ($biayas as $b)
                                                @if ($b->kontainer_id_discharge == $biaya['id'])
                                                <li>
                                                    {{ $b->keterangan }}
                                                </li>
                                                @endif
                                            @endforeach
                                            </ol>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        </div>

                        <div class="mb-5 mt-5">
                            <button id="add_biaya" type="button" onclick="detail_biaya_lain()"
                                class="btn btn-label-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>

                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
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
                        <h5 class="modal-title">INPUT KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                    
                        <div class="row">
                            <label for="email" class="col-sm-4 col-form-label">Size :<span class="text-danger">*</span></label>

                            <div class="col-sm-8 validation-container">

                                <select required data-bs-toggle="tooltip" id="size" name="size" class="form-select"
                                    @readonly(true) required>
                                    <option disabled>Pilih Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}"
                                            @if ($size->size_container) selected @endif>
                                            {{ $size->size_container }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Type :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select required  data-bs-toggle="tooltip" id="type" name="type" class="form-select"
                                    @readonly(true) required>
                                    <option disabled>Pilih Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}"
                                            @if ($type->type_container) selected @endif>
                                            {{ $type->type_container }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <input required data-bs-toggle="tooltip" type="text"
                                    class="form-control nomor_kontainer" id="nomor_kontainer" minlength="11"
                                    maxlength="11" name="nomor_kontainer" onblur="blur_no_container(this)" required
                                    placeholder="XXXX0000000"
                                    >
                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Barang (Cargo) :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input required data-bs-toggle="tooltip" type="text" class="form-control" id="cargo"
                                    name="cargo" value="{{ old('cargo') }}" required>
                            </div>


                        </div>

                        <div class="row">
                            <input type="hidden" name="seal_old" id="seal_old">
                            <label for="" class="col-sm-4 col-form-label">Seal-Container :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <select data-bs-toggle="tooltip" id="seal" multiple="multiple" name="seal"
                                class="form-select" placeholder="Silahkan Pilih Seal" required>
                                @foreach ($seals as $seal)
                                    <option value="{{ $seal->kode_seal }}">
                                        {{ $seal->kode_seal }}</option>
                                @endforeach

                            </select>

                            </div>
                        </div>


                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Dooring :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="tanggal_kembali" name="tanggal_kembali" placeholder="Tanggal Dooring..."
                                    value="" required>

                            </div>
                        </div>

                        <div class="row ">


                            <label for="" class="col-sm-4 col-form-label">Lokasi Pickup :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required data-bs-toggle="tooltip" id="lokasi_kembali" name="lokasi_kembali" class="form-select" required>
                                <option selected disabled value="0">Pilih Lokasi Pickup</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Penerima Barang :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="penerima" name="penerima" class="form-select">
                                <option selected disabled>Pilih Penerima</option>
                                @foreach ($penerimas as $penerima)
                                    <option value="{{ $penerima->nama_penerima }}"
                                        @if ($penerima->nama_penerima == $plandischarge->penerima) selected @endif>{{ $penerima->nama_penerima }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Alamat Pengantaran :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <textarea data-bs-toggle="tooltip" class="form-control" id="alamat_pengantaran" name="alamat_pengantaran" required>{{ old('remark') }}</textarea>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih Supir :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="driver" name="driver" class="form-select">
                                <option selected disabled>(Nama/Nomor Polisi)</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"
                                        >{{ $vendor->nama_supir }}/{{$vendor->nomor_polisi}}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vendor Truck :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select disabled id="nomor_polisi" name="nomor_polisi" class="form-select">
                                {{-- <option selected disabled>Pilih Supir/Nomor polisi</option> --}}

                            </select>

                            </div>
                        </div>


                    
              

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Seal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah "
                                        id="biaya_seal" name="biaya_seal" placeholder="Biaya Seal..."
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Cleaning :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah "
                                        id="biaya_cleaning" name="biaya_cleaning" placeholder="Biaya Cleaning..."
                                        required>

                                </div>
                            </div>
                        </div>
                       

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Retribusi :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip"
                                    type="text" class="form-control currency-rupiah"
                                    id="biaya_retribusi" name="biaya_retribusi" placeholder="Biaya Retribusi..."
                                    required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">THC Lolo :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_thc" name="biaya_thc" placeholder="Biaya THC Lolo..."
                                        required onblur="validate_biaya_trucking(this)">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Trucking :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_trucking" name="biaya_trucking" placeholder="Trucking..."
                                        required onblur="validate_ongkos_supir(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Ongkos Supir :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="ongkos_supir" name="ongkos_supir" placeholder="Ongkos Supir..."
                                        required onblur="validate_ongkos_supir(this)">
                                </div>
                            </div>
                        </div>

                        <div class="row ">


                            <label for="" class="col-sm-4 col-form-label">Empty Return to:<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required data-bs-toggle="tooltip" id="return_to" name="return_to" class="form-select" required>
                                <option selected disabled value="0">Pilih Lokasi Empty Return</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>


                      
                      
                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Remark :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <textarea data-bs-toggle="tooltip" class="form-control" id="remark" name="remark" required>{{ old('remark') }}</textarea>

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

    <div class="modal fade" id="modal-job-edit" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_job_edit" id="valid_job_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="new_id" id="new_id_edit">
                <input type="hidden" name="job_id" id="job_id" value="{{ $plandischarge->id }}">


                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDIT KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                    
                        <div class="row">
                            <label for="email" class="col-sm-4 col-form-label">Size :<span class="text-danger">*</span></label>

                            <div class="col-sm-8 validation-container">

                                <select required data-bs-toggle="tooltip" id="size_edit" name="size_edit" class="form-select"
                                    @readonly(true) required>
                                    <option disabled>Pilih Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}"
                                            @if ($size->size_container) selected @endif>
                                            {{ $size->size_container }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Type :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select required  data-bs-toggle="tooltip" id="type_edit" name="type_edit" class="form-select"
                                    @readonly(true) required>
                                    <option disabled>Pilih Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}"
                                            @if ($type->type_container) selected @endif>
                                            {{ $type->type_container }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <input required data-bs-toggle="tooltip" type="text"
                                    class="form-control nomor_kontainer" id="nomor_kontainer_edit" minlength="11"
                                    maxlength="11" name="nomor_kontainer_edit" onblur="blur_no_container(this)" required
                                    placeholder="XXXX0000000"
                                    >
                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Barang (Cargo) :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input required data-bs-toggle="tooltip" type="text" class="form-control" id="cargo_edit"
                                    name="cargo_edit" value="{{ old('cargo') }}" required>
                            </div>


                        </div>

                        <div class="row">
                            <input type="hidden" name="seal_old" id="seal_old">
                            <label for="" class="col-sm-4 col-form-label">Seal-Container :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <select data-bs-toggle="tooltip" id="seal_edit" multiple="multiple" name="seal_edit"
                                class="form-select" placeholder="Silahkan Pilih Seal" required>
                                @foreach ($seals as $seal)
                                    <option value="{{ $seal->kode_seal }}">
                                        {{ $seal->kode_seal }}</option>
                                @endforeach

                            </select>

                            </div>
                        </div>


                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Dooring :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="tanggal_kembali_edit" name="tanggal_kembali_edit" placeholder="Tanggal Dooring..."
                                    value="" required>

                            </div>
                        </div>

                        <div class="row ">


                            <label for="" class="col-sm-4 col-form-label">Lokasi Pickup :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required data-bs-toggle="tooltip" id="lokasi_kembali_edit" name="lokasi_kembali_edit" class="form-select" required>
                                <option selected disabled value="0">Pilih Lokasi Pickup</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Penerima Barang :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="penerima_edit" name="penerima_edit" class="form-select">
                                <option selected disabled>Pilih Penerima</option>
                                @foreach ($penerimas as $penerima)
                                    <option value="{{ $penerima->nama_penerima }}"
                                        @if ($penerima->nama_penerima == $plandischarge->penerima) selected @endif>{{ $penerima->nama_penerima }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Alamat Pengantaran :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <textarea data-bs-toggle="tooltip" class="form-control" id="alamat_pengantaran_edit" name="alamat_pengantaran_edit" required>{{ old('remark') }}</textarea>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih Supir :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="driver_edit" name="driver_edit" class="form-select">
                                <option selected disabled>(Nama/Nomor Polisi)</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"
                                        >{{ $vendor->nama_supir }}/{{$vendor->nomor_polisi}}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vendor Truck :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select disabled id="nomor_polisi_edit" name="nomor_polisi_edit" class="form-select">
                                @foreach ($vendors2 as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}
                                </option>
                                @endforeach
                            </select>

                            </div>
                        </div>


                    
              

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Seal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah "
                                        id="biaya_seal_edit" name="biaya_seal_edit" placeholder="Biaya Seal..."
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Cleaning :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah "
                                        id="biaya_cleaning_edit" name="biaya_cleaning_edit" placeholder="Biaya Cleaning..."
                                        required>

                                </div>
                            </div>
                        </div>
                       

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Retribusi :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip"
                                    type="text" class="form-control currency-rupiah"
                                    id="biaya_retribusi_edit" name="biaya_retribusi_edit" placeholder="Biaya Retribusi..."
                                    required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">THC Lolo :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_thc_edit" name="biaya_thc_edit" placeholder="Biaya THC Lolo..."
                                        required onblur="validate_biaya_trucking(this)">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Trucking :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_trucking_edit" name="biaya_trucking_edit" placeholder="Trucking..."
                                        required onblur="validate_ongkos_supir(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Ongkos Supir :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="ongkos_supir_edit" name="ongkos_supir_edit" placeholder="Ongkos Supir..."
                                        required onblur="validate_ongkos_supir(this)">
                                </div>
                            </div>
                        </div>

                        <div class="row ">


                            <label for="" class="col-sm-4 col-form-label">Empty Return to:<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required data-bs-toggle="tooltip" id="return_to_edit" name="return_to_edit" class="form-select" required>
                                <option selected disabled value="0">Pilih Lokasi Empty Return</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>


                      
                      
                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Remark :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <textarea data-bs-toggle="tooltip" class="form-control" id="remark_edit" name="remark_edit" required></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="modal fade" id="modal-job-tambah" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_job_tambah" id="valid_job_tambah">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="job_id" id="job_id" value="{{ $plandischarge->id }}">


                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">TAMBAH KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                    
                        <div class="row">
                            <label for="email" class="col-sm-4 col-form-label">Size :<span class="text-danger">*</span></label>

                            <div class="col-sm-8 validation-container">

                                <select required data-bs-toggle="tooltip" id="size_tambah" name="size_tambah" class="form-select"
                                    @readonly(true) required>
                                    <option disabled selected>Pilih Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}">
                                            {{ $size->size_container }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Type :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select required  data-bs-toggle="tooltip" id="type_tambah" name="type_tambah" class="form-select"
                                    @readonly(true) required>
                                    <option disabled selected>Pilih Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}">
                                            {{ $type->type_container }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <input required data-bs-toggle="tooltip" type="text"
                                    class="form-control nomor_kontainer" id="nomor_kontainer_tambah" minlength="11"
                                    maxlength="11" name="nomor_kontainer_tambah" onblur="blur_no_container(this)" required
                                    placeholder="XXXX0000000"
                                    >
                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Barang (Cargo) :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input required data-bs-toggle="tooltip" type="text" class="form-control" id="cargo_tambah"
                                    name="cargo_tambah" value="{{ old('cargo') }}" required>
                            </div>


                        </div>

                        <div class="row">
                            <input type="hidden" name="seal_old" id="seal_old">
                            <label for="" class="col-sm-4 col-form-label">Seal-Container :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <select data-bs-toggle="tooltip" id="seal_tambah" multiple="multiple" name="seal_tambah"
                                class="form-select" placeholder="Silahkan Pilih Seal" required>
                                @foreach ($seals as $seal)
                                    <option value="{{ $seal->kode_seal }}">
                                        {{ $seal->kode_seal }}</option>
                                @endforeach

                            </select>

                            </div>
                        </div>


                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Dooring :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="tanggal_kembali_tambah" name="tanggal_kembali_tambah" placeholder="Tanggal Dooring..."
                                    value="" required>

                            </div>
                        </div>

                        <div class="row ">


                            <label for="" class="col-sm-4 col-form-label">Lokasi Pickup :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required data-bs-toggle="tooltip" id="lokasi_kembali_tambah" name="lokasi_kembali_tambah" class="form-select" required>
                                <option selected disabled value="0">Pilih Lokasi Pickup</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Penerima Barang :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="penerima_tambah" name="penerima_tambah" class="form-select">
                                <option selected disabled>Pilih Penerima</option>
                                @foreach ($penerimas as $penerima)
                                    <option value="{{ $penerima->nama_penerima }}"
                                        @if ($penerima->nama_penerima == $plandischarge->penerima) selected @endif>{{ $penerima->nama_penerima }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Alamat Pengantaran :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <textarea data-bs-toggle="tooltip" class="form-control" id="alamat_pengantaran_tambah" name="alamat_pengantaran_tambah" required>{{ old('remark') }}</textarea>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih Supir :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="driver_tambah" name="driver_tambah" class="form-select">
                                <option selected disabled>(Nama/Nomor Polisi)</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"
                                        >{{ $vendor->nama_supir }}/{{$vendor->nomor_polisi}}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vendor Truck :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select disabled id="nomor_polisi_tambah" name="nomor_polisi_tambah" class="form-select">
                                @foreach ($vendors2 as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}
                                </option>
                                @endforeach
                            </select>

                            </div>
                        </div>


                    
              

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Seal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah "
                                        id="biaya_seal_tambah" name="biaya_seal_tambah" placeholder="Biaya Seal..."
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Cleaning :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah "
                                        id="biaya_cleaning_tambah" name="biaya_cleaning_tambah" placeholder="Biaya Cleaning..."
                                        required>

                                </div>
                            </div>
                        </div>
                       

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Retribusi :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip"
                                    type="text" class="form-control currency-rupiah"
                                    id="biaya_retribusi_tambah" name="biaya_retribusi_tambah" placeholder="Biaya Retribusi..."
                                    required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">THC Lolo :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_thc_tambah" name="biaya_thc_tambah" placeholder="Biaya THC Lolo..."
                                        required onblur="validate_biaya_trucking(this)">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Trucking :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_trucking_tambah" name="biaya_trucking_tambah" placeholder="Trucking..."
                                        required onblur="validate_ongkos_supir(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Ongkos Supir :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="ongkos_supir_tambah" name="ongkos_supir_tambah" placeholder="Ongkos Supir..."
                                        required onblur="validate_ongkos_supir(this)">
                                </div>
                            </div>
                        </div>

                        <div class="row ">


                            <label for="" class="col-sm-4 col-form-label">Empty Return to:<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required data-bs-toggle="tooltip" id="return_to_tambah" name="return_to_tambah" class="form-select" required>
                                <option selected disabled value="0">Pilih Lokasi Empty Return</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>


                      
                      
                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Remark :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <textarea data-bs-toggle="tooltip" class="form-control" id="remark_tambah" name="remark_tambah" required></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="modal fade" id="modal_edit_jobplanload" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_job_edit_load"
                id="valid_job_edit_load">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">DETAIL KAPAL :</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Nomor DO :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <input required name="nomor_do" id="nomor_do" class="form-control" value="{{old('nomor_do', $plandischarge->nomor_do)}}">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Tanggal Tiba :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input required name="tanggal_tiba" id="tanggal_tiba" class="form-control" value="{{old('tanggal_tiba', $plandischarge->tanggal_tiba)}}">


                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vessel/Voyage :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <input required name="vessel" id="vessel" class="form-control" value="{{ old('vessel', $plandischarge->vessel) }}" >
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vessel Code :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input required name="vessel_code" id="vessel_code" class="form-control" value="{{ old('vessel_code', $plandischarge->vessel_code) }}" >


                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Shipping Company (Pelayaran) :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="select_company" name="select_company" class="form-select">
                                <option selected disabled>Pilih Company</option>
                                @foreach ($shippingcompany as $shippingcompany)
                                    <option value="{{ $shippingcompany->nama_company }}"
                                        @if ($shippingcompany->nama_company == $plandischarge->select_company) selected @endif>
                                        {{ $shippingcompany->nama_company }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pengirim :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select required id="Pengirim_1" name="Pengirim_1" class="form-select">
                                    <option selected disabled>Pilih Pengirim</option>
                                    @foreach ($pengirim as $pengirim)
                                        <option value="{{ $pengirim->nama_costumer }}" @if ($pengirim->nama_costumer == $plandischarge->pengirim) selected @endif>{{ $pengirim->nama_costumer }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Penerima :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select required id="Penerima_1" name="Penerima_1" class="form-select">
                                    <option selected disabled>Pilih Penerima</option>
                                    @foreach ($penerimas as $penerima)
                                        <option value="{{ $penerima->nama_penerima }}" @if ($penerima->nama_penerima == $plandischarge->penerima) selected @endif>{{ $penerima->nama_penerima }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Jenis Kegiatan(Activity) :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="activity" name="activity" class="form-select">
                                <option selected disabled>Pilih Activity</option>
                                @foreach ($activity as $activity)
                                    <option value="{{ $activity->kegiatan }}"
                                        @if ($activity->kegiatan == $plandischarge->activity) selected @endif>{{ $activity->kegiatan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">POL :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="POL_1" name="POL_1" class="form-select">
                                <option selected disabled>Pilih POL</option>
                                @foreach ($pols as $pol)
                                    <option value="{{ $pol->nama_pelabuhan }}"
                                        @if ($pol->nama_pelabuhan == $plandischarge->pol) selected @endif>{{ $pol->area_code }} -
                                        {{ $pol->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">PDO :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select required id="POD_1" name="POD_1" class="form-select">
                                    <option selected disabled>Pilih POD</option>
                                    @foreach ($pod as $pod)
                                        <option value="{{ $pod->nama_pelabuhan }}" @if ($pod->nama_pelabuhan == $plandischarge->pod) selected @endif>{{ $pod->area_code }} -
                                            {{ $pod->nama_pelabuhan }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya DO :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah " value="{{ $plandischarge->biaya_do }}"
                                        id="biaya_do" name="biaya_do" placeholder="Biaya DO..."
                                        required>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit Detail Kapal
                            {{ $plandischarge->vessel }}</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            let tanggal_tiba = $("#tanggal_tiba").val();
            tanggal_tiba = moment(tanggal_tiba, "YYYY-MM-DD").format("dddd, DD-MMMM-YYYY")
            $("#tanggal_tiba").val(tanggal_tiba);
            


        });


    </script>
    <script type="text/javascript" src="{{ asset('/') }}./js/discharge-process.js"></script>

@endsection
