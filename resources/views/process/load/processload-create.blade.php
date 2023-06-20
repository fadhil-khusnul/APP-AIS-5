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
                            <a href="/processload" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-primary">Load</span>
                            </a>


                            <a href="/processload" class="breadcrumb-item">
                                <span class="breadcrumb-text text-success">Process</span>
                            </a>


                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>



        <form action="#" class="row row-cols-lg-12 g-3" id="valid_processload" name="valid_processload">
            <input type="hidden" name="old_slug" id="old_slug" value="{{ $planload->slug }}">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <div class="col-md-12 col-xl-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <div class="col-md-12 text-center mb-3">
                            <h1 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center"> DETAIL KAPAL :
                            </h1>
                            <h3 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center">
                                {{ $planload->vessel }} ( {{ $planload->select_company }})</h3>
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
                                <tr>
                                    <td>POT (Port of Transit)</td>
                                    <td>:</td>
                                    <td>
                                        @if ($planload->pot != null)
                                            {{ $planload->pot }}
                                        @else
                                            -
                                        @endif

                                    </td>
                                </tr>

                                {{-- <tr>
                                    <td>POD (Port of Discharge)</td>
                                    <td>:</td>
                                    <td>{{ $planload->pod }}

                                    </td>
                                </tr> --}}
                            </table>

                            <div class="col-12 text-center mt-3">
                                <button value="{{ $planload->id }}" type="button" onclick="edit_planloaad_job(this)"
                                    class="btn btn-outline-primary">Edit Detail Kapal Load <i
                                        class="fa fa-pencil"></i></button>
                            </div>


                        </div>


                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>




            <!-- BEGIN Portlet -->

            <!-- END Portlet -->

            <div class="col-md-12 col-xl-12">
                <div class="portlet">

                    <div class="portlet-body">
                        <hr>

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>INPUT KONTAINER :</b></label>
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
                                        <th class="text-center"></th>
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
                                                @if ($container->nomor_kontainer != null)
                                                    <button type="button" id="btn_detail" name="btn_detail"
                                                        class="btn btn-label-primary btn-sm text-nowrap"
                                                        value="{{ $container->id }}" onclick="detail_update(this)">Detail
                                                        Kontainer <i class="fa fa-eye"></i></button>
                                                @else
                                                    <button type="button" id="btn_detail" name="btn_detail"
                                                        class="btn btn-label-success btn-sm text-nowrap"
                                                        value="{{ $container->id }}" onclick="detail(this)">Detail
                                                        Kontainer <i class="fa fa-pencil"></i></button>
                                                @endif


                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>


                        <div class="mb-5 mt-5 text-center">
                            <button id="detail_kontainer" type="button" onclick="detail_tambah()"
                                class="btn btn-outline-success">Tambah Kontainer <i class="fa fa-plus"></i></button>
                                @if ($planload->status == 'Process-Load' || $planload->status == 'Realisasi')
                                <button style="margin-left: 10px" value="{{ $planload->slug }}" type="button" onclick="realisasi_page(this)"
                                class="btn btn-success">Realisasi POL <i class="fa fa-arrow-right"></i></button>
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
                                        <th>Size/Type Container</th>
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
                                        <td>
                                            @if ($container->status == "Alih-Kapal" || $container->status == "Realisasi-Alih" )
                                            <span class=" badge badge-label-primary">Alih-Kapal</span>
                                            @elseif ($container->status == "Batal-Muat")
                                            <span class=" badge badge-label-danger">Batal-Muat</span>
                                            @else
                                            <span class=" badge badge-label-success">Normal</span>
                                            @endif
                                            {{ $container->iteration }}


                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}
                                        </td>
                                        <td>{{$container->pengirim}}</td>
                                        <td>{{$container->penerima}}</td>
                                        <td>{{$container->pod_container}}</td>
                                        <td>{{$container->pot_container}}</td>
                                        <td>{{$container->vessel_pot}}</td>
                                        <td>{{$container->size}}/{{$container->type}}</td>
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

                            <div class="table-responsive mt-5">


                                <table id="table_informasi2" class="table table-bordered table-striped table-hover autosize" style="width: 100% !important">
                                    <thead class="table">
                                        <tr>
                                            <th>No</th>
                                            <th>Container</th>
                                            <th>Size/Type</th>
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
                                        <td>{{$container->size}}/{{$container->type}}</td>
                                        <td>{{$container->spk}}</td>
                                        <td>@rupiah($container->biaya_stuffing)</td>
                                        <td>@rupiah($container->biaya_trucking)</td>
                                        <td>@rupiah($container->ongkos_supir)</td>
                                        <td>@rupiah($container->biaya_seal)</td>
                                        <td>@rupiah($container->biaya_thc)</td>
                                        <td>@rupiah($container->freight)</td>
                                        <td>@rupiah($container->lss)</td>
                                        <td>@if ($biayas->count() == 1)
                                            @foreach ($biayas as $biaya)
                                            @if ($biaya->kontainer_id == $container->id)
                                                    @rupiah($biaya->harga_biaya)

                                            @endif
                                            @endforeach
                                            @else
                                            <ol type="1.">

                                                @foreach ($biayas as $biaya)
                                                    @if ($biaya->kontainer_id == $container->id)
                                                        <li id="biaya[{{ $container->id }}]">
                                                            @rupiah($biaya->harga_biaya)
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ol>
                                            @endif
                                        </td>
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
                                        <th>POD</th>
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
                                            <td>{{$container['pod_container']}}</td>
                                            <td class="text-nowrap">
                                                <ol type="1.">
                                                @foreach ($details as $detail)
                                                    @if ($detail->kontainer_id == $container['id'])
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
                                    <th>Nomor Kontainer</th>
                                    <th>Biaya</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_biaya" class="">
                                @foreach ($biayas as $biaya)
                                    <tr>
                                        <td class="text-center">
                                            <button id="delete_biaya" name="delete_biaya"
                                                class="btn btn-label-danger btn-icon btn-circle btn-sm" type="button"
                                                value="{{ $biaya->id }}" onclick="delete_laiannyaDB(this)"
                                                @readonly(true)><i class="fa fa-trash"></i></button>
                                            <button id="edit_biaya" name="edit_biaya"
                                                class="btn btn-label-primary btn-icon btn-circle btn-sm" type="button"
                                                value="{{ $biaya->id }}" onclick="detail_biaya_lain_edit(this)"
                                                @readonly(true)><i class="fa fa-pencil"></i></button>
                                        </td>
                                        <td>

                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $biaya->container_planloads->nomor_kontainer }}
                                        </td>
                                        <td>
                                            @rupiah($biaya->harga_biaya)
                                        </td>
                                        <td>
                                            {{ $biaya->keterangan }}
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
            <div class="col-md-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>CONTAINER BATAL MUAT (JIKA ADA)</b></label>
                        </div>

                        <div class="table-responsive">


                            <table id="table_batal_muat" class="table mb-0" style="width: 100% !important">
                                <thead id="thead_batal_muat" class="table-success">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Pilih Nomor Container</th>
                                        <th class="text-center">Biaya Batal Muat</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_batal_muat" class="text-center">
                                    @foreach ($container_batal as $container)
                                        <tr>
                                            <td class="text-center">
                                                <button id="delete_batal" name="delete_batal"
                                                    class="btn btn-label-info btn-icon btn-circle btn-sm" type="button"
                                                    value="{{ $container->id }}" onclick="delete_batalDB(this)"
                                                    @readonly(true)><i class="fa fa-refresh"></i></button>
                                                <button id="edit_batal" name="edit_batal"
                                                    class="btn btn-label-primary btn-icon btn-circle btn-sm" type="button"
                                                    value="{{ $container->id }}" onclick="detail_batal_muat_edit(this)"
                                                    @readonly(true)><i class="fa fa-pencil"></i></button>
                                            </td>
                                            <td>

                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $container->nomor_kontainer }}
                                            </td>
                                            <td>
                                                @rupiah($container->harga_batal)
                                            </td>
                                            <td>
                                                {{ $container->keterangan_batal }}
                                            </td>

                                            <td>
                                                <button type="button" id="btn_detail" name="btn_detail"
                                                    class="btn btn-label-primary btn-sm text-nowrap"
                                                    value="{{ $container->id }}" onclick="detail_disabled(this)">Detail
                                                    Kontainer <i class="fa fa-eye"></i></button>

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>
                        <div class="mb-5 mt-5">
                            <button id="add_biaya" type="button" onclick="detail_batal_muat()"
                                class="btn btn-label-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>


                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
            <div class="col-md-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>KONTAINER ALIH KAPAL (JIKA ADA)</b></label>
                        </div>
                        <div class="table-responsive">

                            <table id="table_alih_kapal" class="table mb-0" style="width: 100% !important">
                                <thead id="thead_alih" class="table-success text-nowrap">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">Nomor Kontainer</th>
                                        <th class="text-center">Pelayaran</th>
                                        <th class="text-center">POT (Jika Ada)</th>
                                        <th class="text-center">POD</th>
                                        <th class="text-center">vessel/Voyage</th>
                                        <th class="text-center">Kode vessel</th>
                                        <th class="text-center">Biaya Alih Kapal</th>
                                        <th class="text-center">Keterangan Alih Kapal</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_alih" class="text-center">
                                    @foreach ($alihs as $alih)
                                        <tr>
                                            <td class="text-center text-nowrap">
                                                <button id="delete_alih" name="delete_alih"
                                                    class="btn btn-label-info btn-icon btn-circle btn-sm" type="button"
                                                    value="{{ $alih->kontainer_alih }}" onclick="delete_alihDB(this)"
                                                    @readonly(true)><i class="fa fa-refresh"></i></button>
                                                <button id="edit_batal" name="edit_batal"
                                                    class="btn btn-label-primary btn-icon btn-circle btn-sm"
                                                    type="button" value="{{ $alih->id }}"
                                                    onclick="detail_alih_kapal_edit(this)" @readonly(true)><i
                                                        class="fa fa-pencil"></i></button>
                                            </td>
                                            <td>

                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $alih->container_planloads->nomor_kontainer }}
                                            </td>
                                            <td>
                                                {{ $alih->pelayaran_alih }}
                                            </td>
                                            <td>
                                                {{ $alih->pot_alih }}
                                            </td>
                                            <td>
                                                {{ $alih->pod_alih }}
                                            </td>
                                            <td>
                                                {{ $alih->vesseL_alih }}
                                            </td>
                                            <td>
                                                {{ $alih->code_vesseL_alih }}
                                            </td>
                                            <td>
                                                @rupiah($alih->harga_alih_kapal)
                                            </td>
                                            <td>
                                                {{ $alih->keterangan_alih_kapal }}
                                            </td>
                                            <td>
                                                <button type="button" id="btn_detail" name="btn_detail"
                                                    class="btn btn-label-primary btn-sm text-nowrap"
                                                    value="{{ $alih->kontainer_alih }}" onclick="detail_disabled(this)">Detail
                                                    Kontainer <i class="fa fa-eye"></i></button>

                                            </td>


                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="mb-5 mt-5">
                            <button id="add_biaya" type="button" onclick="detail_alih_kapal()"
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

    <div class="modal fade" id="modal-job">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_job" id="valid_job">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="new_id" id="new_id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">DETAIL KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pengirim :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="pengirim" name="pengirim" class="form-select">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($pengirims as $pengirim)
                                    <option value="{{ $pengirim->nama_costumer }}"
                                        @if ($pengirim->nama_costumer == $planload->pengirim) selected @endif>{{ $pengirim->nama_costumer }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Penerima :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="penerima" name="penerima" class="form-select">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($penerimas as $penerima)
                                    <option value="{{ $penerima->nama_penerima }}"
                                        @if ($penerima->nama_penerima == $planload->penerima) selected @endif>{{ $penerima->nama_penerima }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">POD :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="pod_container" name="pod_container" class="form-select">
                                <option selected disabled>Pilih POD</option>
                                @foreach ($pods as $pod)
                                    <option value="{{ $pod->nama_pelabuhan }}"
                                        >{{ $pod->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">POT :</label>
                            <div class="col-sm-8 validation-container">

                            <select id="pot_container" name="pot_container" class="form-select">
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pods as $pod)
                                    <option value="{{ $pod->nama_pelabuhan }}"
                                        >{{ $pod->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">VESSEL POT : </span></label>
                            <div class="col-sm-8 validation-container">

                                <input placeholder="Vessel POT" data-bs-toggle="tooltip" type="text" class="form-control" id="vessel_pot"
                                    name="vessel_pot" value="{{ old('vessel_pot') }}">
                            </div>


                        </div>
                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">KODE VESSEL POT : </span></label>
                            <div class="col-sm-8 validation-container">

                                <input placeholder="Kode Vessel POT" data-bs-toggle="tooltip" type="text" class="form-control" id="kode_vessel_pot"
                                    name="kode_vessel_pot" value="{{ old('kode_vessel_pot') }}">
                            </div>


                        </div>


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
                        {{-- <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Detail Barang :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <textarea data-bs-toggle="tooltip" class="form-control" id="detail_barang" name="detail_barang" required>{{ old('detail_barang') }}</textarea>
                            </div>

                        </div> --}}


                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Kegiatan :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="date_activity" name="date_activity" placeholder="Tanggal Kegiatan..."
                                    value="" required>

                            </div>
                        </div>

                        <div class="row ">


                            <label for="" class="col-sm-4 col-form-label">Lokasi Pickup :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required data-bs-toggle="tooltip" id="lokasi" name="lokasi" class="form-select" required>
                                <option selected disabled value="0">Pilih Lokasi Pickup</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

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

                            <label for="" class="col-sm-4 col-form-label">Remark :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <textarea data-bs-toggle="tooltip" class="form-control" id="remark" name="remark" required>{{ old('remark') }}</textarea>

                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Jenis Mobil :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="jenis_mobil" name="jenis_mobil" class="form-select"
                                    required>
                                    <option value="Mobil Sewa" @if ('Mobil Sewa') selected @endif>Mobil Sewa
                                    </option>
                                    <option value="Mobil Sendiri" @if ('Mobil Sendiri') selected @endif>Mobil
                                        Sendiri</option>
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Deposit Trucking :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select data-bs-toggle="tooltip" required @readonly(true) id="dana" name="dana"
                                class="form-select danas">
                                @foreach ($danas as $dana)
                                    <option value="{{ $dana->id }}" @if ($dana->id) selected @endif>
                                        {{ $dana->pj }} - @rupiah($dana->nominal)</option>
                                @endforeach
                            </select>


                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="seal_old" id="seal_old">
                            <label for="" class="col-sm-4 col-form-label">Seal-Container :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                            <select data-bs-toggle="tooltip" id="seal" multiple="multiple" name="seal"
                                class="form-select" placeholde="Silahkan Pilih Seal" required>
                                @foreach ($seals as $seal)
                                    <option value="{{ $seal->kode_seal }}">
                                        {{ $seal->kode_seal }}</option>
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
                                        id="biaya_seal" name="biaya_seal" placeholder="Biaya Seal..."
                                        required>

                                </div>
                            </div>
                        </div>
                        @if (count($spks) > 0)
                        <div class="row">
                            <label class="col-sm-4 col-form-label">SPK-Container : </label>
                            <div class="col-sm-8 validation-container">
                            <select data-bs-toggle="tooltip" id="spk" name="spk"
                                class="form-select" placeholde="Silahkan Pilih SPK" placeholder = "Pilih SPK">
                                @foreach ($spks as $spk)
                                    <option value="{{ $spk->kode_spk }}">
                                        {{ $spk->kode_spk }}</option>
                                @endforeach

                            </select>

                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Stuffing :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip"
                                    type="text" class="form-control currency-rupiah"
                                    id="biaya_stuffing" name="biaya_stuffing" placeholder="Biaya Stuffing..."
                                    required>

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
                                        id="biaya_trucking" name="biaya_trucking" placeholder="Biaya Trucking..."
                                        required onblur="validate_biaya_trucking(this)">

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


                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya THC POL :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_thc" name="biaya_thc" placeholder="Biaya THC..."
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Freight:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="freight" name="freight" placeholder="Biaya Freight..."
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya LSS:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="lss" name="lss" placeholder="Biaya LSS..."
                                        required>

                                </div>
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

    <div class="modal fade" id="modal-job-update">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_job_update" id="valid_job_update">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="new_id_update" id="new_id_update">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDIT DETAIL KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pengirim :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="pengirim_update" name="pengirim_update" class="form-select">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($pengirims as $pengirim)
                                    <option value="{{ $pengirim->nama_costumer }}"
                                        @if ($pengirim->nama_costumer == $planload->pengirim) selected @endif>{{ $pengirim->nama_costumer }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Penerima :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="penerima_update" name="penerima_update" class="form-select">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($penerimas as $penerima)
                                    <option value="{{ $penerima->nama_penerima }}"
                                        @if ($penerima->nama_penerima == $planload->penerima) selected @endif>{{ $penerima->nama_penerima }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">POD :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="pod_container_update" name="pod_container_update" class="form-select">
                                <option selected disabled>Pilih POD</option>
                                @foreach ($pods as $pod)
                                    <option value="{{ $pod->nama_pelabuhan }}"
                                        >{{ $pod->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>


                        <div class="row">
                            <label class="col-sm-4 col-form-label">POT :</label>
                            <div class="col-sm-8 validation-container">

                            <select id="pot_container_update" name="pot_container_update" class="form-select">
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pods as $pod)
                                    <option value="{{ $pod->nama_pelabuhan }}"
                                        >{{ $pod->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">VESSEL POT : </span></label>
                            <div class="col-sm-8 validation-container">

                                <input placeholder="Vessel POT" data-bs-toggle="tooltip" type="text" class="form-control" id="vessel_pot_update"
                                    name="vessel_pot_update" value="{{ old('vessel_pot_update') }}">
                            </div>


                        </div>
                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">KODE VESSEL POT : </span></label>
                            <div class="col-sm-8 validation-container">

                                <input placeholder="Kode Vessel POT" data-bs-toggle="tooltip" type="text" class="form-control" id="kode_vessel_pot_update"
                                    name="kode_vessel_pot_update" value="{{ old('kode_vessel_pot_update') }}">
                            </div>


                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Size :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="size_update" name="size_update" class="form-select"
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

                                <select data-bs-toggle="tooltip" id="type_update" name="type_update" class="form-select"
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

                                <input type="hidden" id="no_container_edit" name="no_container_edit">
                                <input required data-bs-toggle="tooltip" type="text"
                                    class="form-control nomor_kontainer" id="nomor_kontainer_update" minlength="11"
                                    maxlength="11" name="nomor_kontainer_update" onblur="blur_no_container_edit(this)"
                                    required placeholder="XXXX0000000"                                     >
                            </div>
                        </div>

                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Barang (Cargo) :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="cargo_update"
                                    name="cargo_update" value="{{ old('cargo') }}" required>
                            </div>


                        </div>



                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Kegiatan :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="date_activity_update" name="date_activity_update"
                                    placeholder="Tanggal Kegiatan..." value="" required>

                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Lokasi Pickup :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select data-bs-toggle="tooltip" id="lokasi_update" name="lokasi_update" class="form-select"
                                required>
                                <option selected disabled value="0">Pilih Lokasi Pickup</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih Supir :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="driver_update" name="driver_update" class="form-select">
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

                            <select disabled required id="nomor_polisi_update" name="nomor_polisi_update" class="form-select">

                                @foreach ($vendors2 as $vendor)
                                <option value="{{ $vendor->id }}"
                                    >{{ $vendor->nama_vendor }}
                                </option>
                                @endforeach


                            </select>

                            </div>
                        </div>


                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Remark :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="remark_update" name="remark_update" required>{{ old('remark_update') }}</textarea>

                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Jenis Mobil :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="jenis_mobil_update" name="jenis_mobil_update"
                                    class="form-select" required>
                                    <option value="Mobil Sewa" @if ('Mobil Sewa') selected @endif>Mobil
                                        Sewa</option>
                                    <option value="Mobil Sendiri" @if ('Mobil Sendiri') selected @endif>Mobil
                                        Sendiri</option>
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" id="old_dana" name="old_dana">
                            <input type="hidden" id="old_ongkos_supir" name="old_ongkos_supir">
                            <label for="" class="col-sm-4 col-form-label">Pilih Deposit Trucking :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select data-bs-toggle="tooltip" required @readonly(true) id="dana_update"
                                name="dana_update" class="form-select danas">

                                @foreach ($danas as $dana)
                                    <option value="{{ $dana->id }}"
                                        @if ($dana->id) selected @endif>
                                        {{ $dana->pj }} - @rupiah($dana->nominal)</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Seal-Container :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="seal_update" multiple="multiple" name="seal_update"
                                    class="form-select" placeholde="Silahkan Pilih Seal" required>
                                    @foreach ($seals_edit as $seal)
                                        <option value="{{ $seal->kode_seal }}">
                                            {{ $seal->kode_seal }}</option>
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
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_seal_update" name="biaya_seal_update" placeholder="Biaya Seal..."
                                        required>

                                </div>
                            </div>
                        </div>
                        @if (count($spks) > 0)
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">SPK-Container : </label>
                            <div class="col-sm-8 validation-container">

                            <select data-bs-toggle="tooltip" id="spk_update" name="spk_update"
                                class="form-select" placeholde="Silahkan Pilih SPK">
                                @foreach ($spks_edit as $spk)
                                    <option value="{{ $spk->kode_spk }}">
                                        {{ $spk->kode_spk }}</option>
                                @endforeach

                            </select>

                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Stuffing :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_stuffing_update" name="biaya_stuffing_update"
                                        placeholder="Biaya Stuffing..." value="@rupiah2(old('biaya_stuffing'))" required>

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
                                    id="biaya_trucking_update" name="biaya_trucking_update"
                                    placeholder="Biaya Trucking..." value="@rupiah2(old('biaya_trucking'))" required onblur="validate_biaya_trucking_update(this)">

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
                                        id="ongkos_supir_update" name="ongkos_supir_update" placeholder="Ongkos Supir..."
                                        value="@rupiah2(old('ongkos_supir'))" required onblur="validate_ongkos_supir_update(this)">

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya THC POL:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_thc_update" name="biaya_thc_update" placeholder="Biaya THC POL..."
                                        required>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Freight:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="freight_update" name="freight_update" placeholder="Biaya Freight..."
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya LSS:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="lss_update" name="lss_update" placeholder="Biaya LSS..."
                                        required>

                                </div>
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
    <div class="modal fade" id="modal-job-disabled">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_job_disabled" id="valid_job_disabled">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">DETAIL KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pengirim :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select disabled id="pengirim_disabled" name="pengirim_disabled" class="form-select">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($pengirims as $pengirim)
                                    <option value="{{ $pengirim->nama_costumer }}"
                                        @if ($pengirim->nama_costumer == $planload->pengirim) selected @endif>{{ $pengirim->nama_costumer }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Penerima :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select disabled id="penerima_disabled" name="penerima_disabled" class="form-select">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($penerimas as $penerima)
                                    <option value="{{ $penerima->nama_penerima }}"
                                        @if ($penerima->nama_penerima == $planload->penerima) selected @endif>{{ $penerima->nama_penerima }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Size :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled data-bs-toggle="tooltip" id="size_disabled" name="size_disabled" class="form-select"
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

                                <select disabled data-bs-toggle="tooltip" id="type_disabled" name="type_disabled" class="form-select"
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

                                {{-- <input type="hidden" id="no_container_edit" name="no_container_edit"> --}}
                                <input disabled required data-bs-toggle="tooltip" type="text"
                                    class="form-control nomor_kontainer" id="nomor_kontainer_disabled" minlength="11"
                                    maxlength="11" name="nomor_kontainer_disabled" onblur="blur_no_container_edit(this)"
                                    required placeholder="XXXX0000000"                                     >
                            </div>
                        </div>

                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Barang (Cargo) :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input disabled data-bs-toggle="tooltip" type="text" class="form-control" id="cargo_disabled"
                                    name="cargo_disabled" value="{{ old('cargo') }}" required>
                            </div>


                        </div>
                        {{-- <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Detail Barang :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="detail_barang_disabled" name="detail_barang_disabled"
                                    required>{{ old('detail_barang_disabled') }}</textarea>
                            </div>

                        </div> --}}

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Seal-Container :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled data-bs-toggle="tooltip" id="seal_disabled" multiple="multiple" name="seal_disabled"
                                    class="form-select" placeholde="Silahkan Pilih Seal" required>
                                    @foreach ($seals as $seal)
                                        <option value="{{ $seal->kode_seal }}">
                                            {{ $seal->kode_seal }}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Kegiatan :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input disabled data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="date_activity_disabled" name="date_activity_disabled"
                                    placeholder="Tanggal Kegiatan..." value="" required>

                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Lokasi Pickup :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select disabled data-bs-toggle="tooltip" id="lokasi_disabled" name="lokasi_disabled" class="form-select"
                                required>
                                <option selected disabled value="0">Pilih Lokasi Pickup</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih Supir :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select disabled required id="driver_disabled" name="driver_disabled" class="form-select">
                                <option selected disabled>(Nama Supir/Nomor Polisi)</option>
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

                            <select disabled required id="nomor_polisi_disabled" name="nomor_polisi_disabled" class="form-select">
                                @foreach ($vendors2 as $vendor)
                                <option value="{{ $vendor->id }}"
                                    >{{ $vendor->nama_vendor }}
                                </option>
                                @endforeach

                            </select>

                            </div>
                        </div>


                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Remark :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea disabled data-bs-toggle="tooltip" class="form-control" id="remark_disabled" name="remark_disabled" required>{{ old('remark_disabled') }}</textarea>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Stuffing :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input disabled data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_stuffing_disabled" name="biaya_stuffing_disabled"
                                        placeholder="Biaya Stuffing..." value="@rupiah2(old('biaya_stuffing'))" required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Trucking :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>

                                <input disabled data-bs-toggle="tooltip"
                                    type="text" class="form-control currency-rupiah"
                                    id="biaya_trucking_disabled" name="biaya_trucking_disabled"
                                    placeholder="Biaya Trucking..." value="@rupiah2(old('biaya_trucking'))" required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Ongkos Supir :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input disabled data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="ongkos_supir_disabled" name="ongkos_supir_disabled" placeholder="Ongkos Supir..."
                                        value="@rupiah2(old('ongkos_supir'))" required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Seal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input disabled data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_seal_disabled" name="biaya_seal_disabled" placeholder="Biaya Seal..."
                                        required>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya THC POL:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input disabled data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_thc_disabled" name="biaya_thc_disabled" placeholder="Biaya THC POL..."
                                        required>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Freight:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input disabled data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="freight_disabled" name="freight_disabled" placeholder="Biaya Freight..."
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya LSS:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input disabled data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="lss_disabled" name="lss_disabled" placeholder="Biaya LSS..."
                                        required>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Jenis Mobil :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled data-bs-toggle="tooltip" id="jenis_mobil_disabled" name="jenis_mobil_disabled"
                                    class="form-select" required>
                                    <option value="Mobil Sewa" @if ('Mobil Sewa') selected @endif>Mobil
                                        Sewa</option>
                                    <option value="Mobil Sendiri" @if ('Mobil Sendiri') selected @endif>Mobil
                                        Sendiri</option>
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Deposit Trucking :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select disabled data-bs-toggle="tooltip" required @readonly(true) id="dana_disabled"
                                name="dana_disabled" class="form-select danas">
                                @foreach ($danas as $dana)
                                    <option value="{{ $dana->id }}"
                                        @if ($dana->id) selected @endif>
                                        {{ $dana->pj }} - @rupiah($dana->nominal)</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        @if (count($spks) > 0)
                            <div class="row">
                                <label for="" class="col-sm-4 col-form-label">SPK-Container : </label>
                                <div class="col-sm-8 validation-container">

                                <select disabled data-bs-toggle="tooltip" id="spk_disabled" multiple="multiple" name="spk_disabled"
                                    class="form-select" placeholde="Silahkan Pilih SPK">
                                    @foreach ($spks as $spk)
                                        <option value="{{ $spk->kode_spk }}">
                                            {{ $spk->kode_spk }}</option>
                                    @endforeach

                                </select>

                                </div>
                            </div>
                        @endif


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>



    <div class="modal fade" id="modal-job-tambah">
        <div class="modal-dialog modal-dialog-scrollable">
            <form action="#" class="modal-dialog-scrollable" name="valid_job_tambah" id="valid_job_tambah">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="job_id" id="job_id" value="{{ $planload->id }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">TAMBAH KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pengirim :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="pengirim_tambah" name="pengirim_tambah" class="form-select">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($pengirims as $pengirim)
                                    <option value="{{ $pengirim->nama_costumer }}"
                                        @if ($pengirim->nama_costumer == $planload->pengirim) selected @endif>{{ $pengirim->nama_costumer }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Penerima :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="penerima_tambah" name="penerima_tambah" class="form-select">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($penerimas as $penerima)
                                    <option value="{{ $penerima->nama_penerima }}"
                                        @if ($penerima->nama_penerima == $planload->penerima) selected @endif>{{ $penerima->nama_penerima }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">POD :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="pod_container_tambah" name="pod_container_tambah" class="form-select">
                                <option selected disabled>Pilih POD</option>
                                @foreach ($pods as $pod)
                                    <option value="{{ $pod->nama_pelabuhan }}"
                                        >{{ $pod->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">POT :</label>
                            <div class="col-sm-8 validation-container">

                            <select id="pot_container_tambah" name="pot_container_tambah" class="form-select">
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pods as $pod)
                                    <option value="{{ $pod->nama_pelabuhan }}"
                                        >{{ $pod->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">VESSEL POT : </span></label>
                            <div class="col-sm-8 validation-container">

                                <input placeholder="Vessel POT" data-bs-toggle="tooltip" type="text" class="form-control" id="vessel_pot_tambah"
                                    name="vessel_pot_tambah" value="{{ old('vessel_pot_tambah') }}">
                            </div>


                        </div>
                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">KODE VESSEL POT : </span></label>
                            <div class="col-sm-8 validation-container">

                                <input placeholder="Kode Vessel POT" data-bs-toggle="tooltip" type="text" class="form-control" id="kode_vessel_pot_tambah"
                                    name="kode_vessel_pot_tambah" value="{{ old('kode_vessel_pot_tambah') }}">
                            </div>


                        </div>

                        <div class="row">

                            <label class="col-sm-4 col-form-label">Size :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="size_tambah" name="size_tambah" class="form-select"
                                    @readonly(true)>
                                    <option selected disabled>Pilih Size</option>
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

                                <select data-bs-toggle="tooltip" id="type_tambah" name="type_tambah" class="form-select"
                                    @readonly(true) required>
                                    <option selected disabled>Pilih Type</option>
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

                                <input data-bs-toggle="tooltip" type="text" class="form-control nomor_kontainer"
                                    id="nomor_kontainer_tambah" minlength="11" name="nomor_kontainer_tambah"
                                    onblur="blur_no_container(this)" required placeholder="XXXX0000000"
                                 >
                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Barang (Cargo) :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="cargo_tambah"
                                    name="cargo_tambah" required>
                            </div>


                        </div>
                        {{-- <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Detail Barang :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">


                                <textarea data-bs-toggle="tooltip" class="form-control" id="detail_barang_tambah" name="detail_barang_tambah"
                                    required>{{ old('detail_barang') }}</textarea>
                            </div>

                        </div> --}}



                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Kegiatan :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="date_activity_tambah" name="date_activity_tambah"
                                    placeholder="Tanggal Kegiatan..." required>

                            </div>
                        </div>

                        <div class="row">


                            <label for="" class="col-sm-4 col-form-label">Lokasi Pickup :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select data-bs-toggle="tooltip" id="lokasi_tambah" name="lokasi_tambah"
                                class="form-select lokasi-pickup" required>
                                <option selected disabled>Pilih Lokasi Pickup</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih Supir :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select required id="driver_tambah" name="driver_tambah" class="form-select">
                                <option selected disabled>Pilih Supir (Nama/Nomor Polisi)</option>
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

                            <select disabled required id="nomor_polisi_tambah" name="nomor_polisi_tambah" class="form-select">

                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Remark :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="remark_tambah" name="remark_tambah" required></textarea>

                            </div>
                        </div>
                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Pilih Jenis Mobil :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="jenis_mobil_tambah" name="jenis_mobil_tambah"
                                    class="form-select" required>
                                    <option disabled selected>Pilih Jenis Mobil</option>
                                    <option value="Mobil Sewa">Mobil Sewa</option>
                                    <option value="Mobil Sendiri">Mobil Sendiri</option>
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Deposit Trucking :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select data-bs-toggle="tooltip" @readonly(true) id="dana_tambah" name="dana_tambah"
                                class="form-select danas" required>
                                <option disabled selected>Pilih Deposit Trucking</option>
                                @foreach ($danas as $dana)
                                    <option value="{{ $dana->id }}">
                                        {{ $dana->pj }} - @rupiah($dana->nominal)</option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Seal-Container :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="seal_tambah" multiple="multiple" name="seal_tambah"
                                    class="form-select seals" placeholde="Silahkan Pilih Seal" required>
                                    @foreach ($seals as $seal)
                                        <option value="{{ $seal->kode_seal }}">
                                            {{ $seal->kode_seal }}</option>
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
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_seal_tambah" name="biaya_seal_tambah" placeholder="Biaya Seal..."
                                        required>

                                </div>
                            </div>
                        </div>

                        @if (count($spks) > 0)
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">SPK-Container : </label>
                            <div class="col-sm-8 validation-container">

                            <select data-bs-toggle="tooltip" id="spk_tambah" name="spk_tambah"
                                class="form-select" placeholde="Silahkan Pilih SPK">
                                @foreach ($spks as $spk)
                                    <option value="{{ $spk->kode_spk }}">
                                        {{ $spk->kode_spk }}</option>
                                @endforeach

                            </select>
                            </div>
                        </div>
                        @endif


                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Stuffing :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_stuffing_tambah" name="biaya_stuffing_tambah"
                                        placeholder="Biaya Stuffing..." required>

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
                                        id="biaya_trucking_tambah" name="biaya_trucking_tambah"
                                        placeholder="Biaya Trucking..." required onblur="validate_biaya_trucking_tambah(this)">

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
                                        required onblur="validate_ongkos_supir_tambah(this)">

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya THC POL :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip" oninput="setFormat('biaya_thc');"
                                        onkeydown="numbersonly1(this)" pattern="[0-9]" data-type="number"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_thc_tambah" name="biaya_thc_tambah" placeholder="Biaya THC..." required>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Freight:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="freight_tambah" name="freight_tambah" placeholder="Biaya Freight..."
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya LSS:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="lss_tambah" name="lss_tambah" placeholder="Biaya LSS..."
                                        required>

                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah Kontainer</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="modal fade" id="modal_biaya_lainnya">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_biaya_lainnya" id="valid_biaya_lainnya">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="new_id_biaya" id="new_id_biaya">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">TAMBAH BIAYA LAIN :</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">


                                <select data-bs-toggle="tooltip" id="kontainer_biaya" name="kontainer_biaya"
                                    class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($select_batal_edit as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="harga_biaya" name="harga_biaya" placeholder="Biaya..."
                                        value="@rupiah2(old('harga_biaya'))" required>

                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Keterangan Biaya :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan" name="keterangan" required>{{ old('keterangan') }}</textarea>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Masukkan Ke Biaya Lainnya</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
    <div class="modal fade" id="modal_biaya_lainnya_edit">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_biaya_lainnya_edit"
                id="valid_biaya_lainnya_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="id_lama_biaya" id="id_lama_biaya">
                <input type="hidden" name="old_id_container_biaya" id="old_id_container_biaya">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDIT BIAYA LAIN :</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-3">
                        <div class="row">

                            <label class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="kontainer_biaya_edit" name="kontainer_biaya_edit"
                                    class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($select_batal_edit as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="harga_biaya_edit" name="harga_biaya_edit" placeholder="Biaya..."
                                        value="@rupiah2(old('harga_biaya'))" required>

                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Keterangan Biaya :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_edit" name="keterangan_edit" required>{{ old('keterangan') }}</textarea>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit Biaya Lainnya</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="modal fade" id="modal_detail_barang">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_detail_barang" id="valid_detail_barang">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="new_id_detail" id="new_id_detail">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">TAMBAH DETAIL BARANG/KONTAINER :</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5" style="margin-left: 30px">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-6 validation-container">


                                <select data-bs-toggle="tooltip" id="kontainer_detail" name="kontainer_detail"
                                    class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($select_barang as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div id="div_detail" class="row">
                            <div id="body_detail[1]" class="row row-cols g-3">
                                <label id="label_detail" name="label_detail" class="col-sm-4 col-form-label">Detail Barang Ke-1 :<span class="text-danger">*</span></label>
                                <div id="div_textarea" name="div_textarea" class="col-sm-6 validation-container d-grid gap-3">
                                    <textarea style="margin-left: 10px" data-bs-toggle="tooltip" class="form-control" id="detail_barang[1]" name="detail_barang" required></textarea>
                                </div>
                                <div id="div_button" name="div_button" class="col-sm-2 py-4">
                                    <a style="margin-left: 10px" id="delete_detail[1]" name="delete_detail" class="btn btn-sm btn-label-danger btn-icon" onclick="delete_detail(this)"><i class="fa fa-trash"></i></a>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a id="tambah_barang" type="button" onclick="edit_tambah_barang()"
                        class="btn btn-success btn-icon " style="margin-left: 0px; margin-right:auto;"> <i class="fa fa-plus"></i></a>

                        <button type="submit" class="btn btn-success">Simpan Detail Barang/Kontainer</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
    <div class="modal fade" id="modal_detail_barang_edit">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_detail_barang_edit" id="valid_detail_barang_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="old_id_container_detail" id="old_id_container_detail">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDIT DETAIL BARANG/KONTAINER :</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <select disabled data-bs-toggle="tooltip" id="kontainer_detail_edit" name="kontainer_detail_edit"
                                    class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($select_batal_edit as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="edit_div_detail" class="row">
                            {{-- <div id="body_detail[1]" class="row row-cols g-3">
                                <label id="label_detail" name="label_detail" class="col-sm-4 col-form-label">Detail Barang Ke-1 :<span class="text-danger">*</span></label>
                                <div id="div_textarea" name="div_textarea" class="col-sm-6 validation-container d-grid gap-3">
                                    <textarea style="margin-left: 10px" data-bs-toggle="tooltip" class="form-control" id="detail_barang[1]" name="detail_barang" required></textarea>
                                </div>
                                <div id="div_button" name="div_button" class="col-sm-2 py-4">
                                    <a style="margin-left: 10px" id="delete_detail[1]" name="delete_detail" class="btn btn-sm btn-label-danger btn-icon" onclick="delete_detail(this)"><i class="fa fa-trash"></i></a>
                                </div>
                            </div> --}}

                        </div>
                        {{-- <div class="row">
                            <label for="" class="col-sm-4 col-form-label" id="label_detail">Detail Barang:<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <textarea data-bs-toggle="tooltip" class="form-control" id="detail_barang_edit" name="detail_barang_edit" required></textarea>
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <a id="tambah_barang" type="button" onclick="edit_tambah_barang()"
                        class="btn btn-success btn-icon " style="margin-left: 0px; margin-right:auto;"> <i class="fa fa-plus"></i></a>
                        <button type="submit" class="btn btn-success">Simpan Detail Barang/Kontainer</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="modal fade" id="modal_batal_muat">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_batal_muat" id="valid_batal_muat">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                {{-- <input type="hidden" name="id_lama_biaya" id="id_lama_biaya">
                <input type="hidden" name="old_id_container_biaya" id="old_id_container_biaya"> --}}

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">CONTAINER BATAL MUAT :</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-3">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="kontainer_batal" name="kontainer_batal"
                                    class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($containers as $container)
                                        @if ($container->status == 'Process-Load' || $container->status == 'Biaya-Lainnya')
                                            <option value="{{ $container->id }}">
                                                {{ $container->nomor_kontainer }}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Batal Muatan :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="harga_batal" name="harga_batal" placeholder="Biaya Batal Muatan..."
                                        value="@rupiah2(old('harga_batal'))" required>

                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Keterangan Batal Muat :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_batal" name="keterangan_batal" required>{{ old('keterangan_batal') }}</textarea>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Batal Muatkan Kontainer</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="modal fade" id="modal_batal_muat_edit">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_batal_muat_edit"
                id="valid_batal_muat_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="id_lama_batal" id="id_lama_batal">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDIT CONTAINER BATAL MUAT :</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-3">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="kontainer_batal_edit" name="kontainer_batal_edit"
                                    class="form-select" @disabled(true) @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($select_batal_edit as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Batal Muatan :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="harga_batal_edit" name="harga_batal_edit" placeholder="Biaya Batal Muatan..."
                                        value="@rupiah2(old('harga_batal'))" required>

                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Keterangan Batal Muat :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_batal_edit" name="keterangan_batal_edit"
                                    required>{{ old('keterangan_batal_edit') }}</textarea>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit Batal Muat Kontainer</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


    <div class="modal fade" id="modal_alih_kapal">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_alih_kapal" id="valid_alih_kapal">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                {{-- <input type="hidden" name="id_lama_biaya" id="id_lama_biaya">
                <input type="hidden" name="old_id_container_biaya" id="old_id_container_biaya"> --}}

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ALIH KAPAL KONTAINER :</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3  px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="kontainer_alih" name="kontainer_alih"
                                    class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($containers_alih as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">

                            <label class="col-sm-4 col-form-label">Pilih Pelayaran (Shipping Company) :<span
                                class="text-danger">*</span></label>

                            <div class="col-sm-8 validation-container">
                                <select id="select_company_alih" name="select_company_alih" class="form-select" required>
                                    <option selected disabled>Pilih Company</option>
                                    @foreach ($shipping_companys as $shippingcompany)
                                        <option value="{{ $shippingcompany->nama_company }}">
                                            {{ $shippingcompany->nama_company }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih POT (jika ada) :</label>

                            <div class="col-sm-8 validation-container">

                            <select id="pot_alih" name="pot_alih" class="form-select">
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pelabuhans as $pot)
                                    <option value="{{ $pot->nama_pelabuhan }}">{{ $pot->area_code }} -
                                        {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih POD : <span class="text-danger">*</span></label>

                            <div class="col-sm-8 validation-container">

                            <select id="pod_alih" name="pod_alih" class="form-select" required>
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pelabuhans as $pot)
                                    <option value="{{ $pot->nama_pelabuhan }}">{{ $pot->area_code }} -
                                        {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vessel/Voyage : <span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input required class="form-control" type="text" name="vessel_alih" id="vessel_alih">

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vessel Code : <span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <input required class="form-control" type="text" name="vessel_code_alih"
                                id="vessel_code_alih">

                            </div>
                        </div>

                        <div class="row">

                            <label class="col-sm-4 col-form-label" for="">Biaya Alih Kapal<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="harga_alih" name="harga_alih" placeholder="Biaya Alih Kapal..." required>

                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Keterangan Alih Kapal :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_alih" placeholder="Keterangan Alih Kapal"
                                    name="keterangan_alih" required>{{ old('keterangan_alih') }}</textarea>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Alih Kapalkan Kontainer</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="modal fade" id="modal_alih_kapal_edit">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_alih_kapal_edit"
                id="valid_alih_kapal_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="id_lama_alih" id="id_lama_alih">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDIT ALIH KAPAL KONTAINER :</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled data-bs-toggle="tooltip" id="kontainer_alih_edit"
                                    name="kontainer_alih_edit" class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($select_batal_edit as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih Pelayaran (Shipping Company) :<span
                                    class="text-danger">*</span></label>

                            <div class="col-sm-8 validation-container">

                            <select id="select_company_alih_edit" name="select_company_alih_edit" class="form-select"
                                required>
                                <option selected disabled>Pilih Company</option>
                                @foreach ($shipping_companys as $shippingcompany)
                                    <option value="{{ $shippingcompany->nama_company }}">
                                        {{ $shippingcompany->nama_company }}</option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih POT (jika ada) :</label>

                            <div class="col-sm-8 validation-container">

                            <select id="pot_alih_edit" name="pot_alih_edit" class="form-select">
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pelabuhans as $pot)
                                    <option value="{{ $pot->nama_pelabuhan }}">{{ $pot->area_code }} -
                                        {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pilih POD : <span class="text-danger">*</span></label>

                            <div class="col-sm-8 validation-container">

                            <select id="pod_alih_edit" name="pod_alih_edit" class="form-select" required>
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pelabuhans as $pot)
                                    <option value="{{ $pot->nama_pelabuhan }}">{{ $pot->area_code }} -
                                        {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vessel/Voyage : <span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input required class="form-control" type="text" name="vessel_alih_edit"
                                    id="vessel_alih_edit">

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vessel Code : <span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <input required class="form-control" type="text" name="vessel_code_alih_edit"
                                id="vessel_code_alih_edit">

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Alih Kapal<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="harga_alih_edit" name="harga_alih_edit" placeholder="Biaya Alih Kapal..."
                                        required>

                                </div>
                            </div>
                        </div>





                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Keterangan Alih Kapal :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_alih_edit"
                                    placeholder="Keterangan Alih Kapal" name="keterangan_alih_edit" required>{{ old('keterangan_alih_edit') }}</textarea>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit Alih Kapal Kontainer</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="modal fade" id="modal_edit_jobplanload">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_job_edit_load"
                id="valid_job_edit_load">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDIT DETAIL KAPAL :</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vessel/Voyage :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">


                                <input type="text" class="form-control" id="vessel" name="vessel"
                                    value="{{ $planload->vessel }}">

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vessel Code :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input type="text" class="form-control" id="vessel_code" name="vessel_code"
                                    value="{{ $planload->vessel_code }}">

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Shipping Company (Pelayaran) :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="select_company" name="select_company" class="form-select">
                                <option selected disabled>Pilih Company</option>
                                @foreach ($shipping_companys as $shippingcompany)
                                    <option value="{{ $shippingcompany->nama_company }}"
                                        @if ($shippingcompany->nama_company == $planload->select_company) selected @endif>
                                        {{ $shippingcompany->nama_company }}</option>
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
                                        @if ($activity->kegiatan == $planload->activity) selected @endif>{{ $activity->kegiatan }}
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
                                @foreach ($pelabuhans as $pol)
                                    <option value="{{ $pol->nama_pelabuhan }}"
                                        @if ($pol->nama_pelabuhan == $planload->pol) selected @endif>{{ $pol->area_code }} -
                                        {{ $pol->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">POT :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                            <select id="POT_1" name="POT_1" class="form-select">
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pelabuhans as $pot)
                                    <option value="{{ $pot->nama_pelabuhan }}"
                                        @if ($pot->nama_pelabuhan == $planload->pot) selected @endif>{{ $pot->area_code }} -
                                        {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit Detail Kapal
                            {{ $planload->vessel }}</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>



    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/datatable/extension/exportkontainer.js"></script>


    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script> --}}

    <script type="text/javascript" src="{{ asset('/') }}./js/detail_kontainer.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>

    <script type="text/javascript" >
        $(document).ready(function() {
            $('input, select, .date_activity').blur(function() {
                var $txt = $(this).val();
                $(this).attr('data-bs-original-title', $txt);
            })

            // $('.modal-content').resizable({
            //     minHeight: 300,
            //     minWidth: 300
            // });



        });

        $('.modal>.modal-dialog').draggable({
                cursor: 'move',
                handle: '.modal-header, .modal-footer'
        });
        $('.modal>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');
        $('.modal>.modal-dialog>.modal-content>.modal-footer').css('cursor', 'move');


    </script>
@endsection
