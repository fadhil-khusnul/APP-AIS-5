@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- BEGIN Portlet -->
            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="header-title">LOAD</h3>
                    <i class="header-divider"></i>
                    <div class="header-wrap header-wrap-block justify-content-start">
                        <!-- BEGIN Breadcrumb -->

                        <div class="breadcrumb breadcrumb-transparent mb-0">
                            <a href="/realisasi-load" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-primary">Load</span>
                            </a>
                            <a href="/processload-create/{{$planload->slug}}" class="breadcrumb-item">
                                <span class="breadcrumb-text text-success">Process</span>
                            </a>

                            <a href="/realisasi-load" class="breadcrumb-item">
                                @if ($active == 'Plan')
                                    <span class="breadcrumb-text text-warning">{{ $active }}</span>
                                @endif
                                @if ($active == 'Process')
                                    <span class="breadcrumb-text text-success">{{ $active }}</span>
                                @endif
                                @if ($active == 'Realisasi')
                                    <span class="breadcrumb-text text-danger">{{ $active }}</span>
                                @endif
                            </a>


                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>



        <form action="#" class="row row-cols-lg-12 g-3" id="valid_realisasi" name="valid_realisasi">
            <input type="hidden" name="old_slug" id="old_slug" value="{{ $planload->slug }}">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <div class="col-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <div class="col-md-12 text-center mb-3">
                            <h3 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center"> {{ $planload->vessel }} ( {{ $planload->select_company }}
                                )</h3>
                        </div>
                        <div class="col-md-12 mb-3">
                            <table border="0">
                                <tr>
                                    <td width="45%">Vessel/Voyage</td>
                                    <td width="5%">:</td>
                                    <td width="50%">{{ $planload->vessel }}</td>
                                </tr>
                                <tr>
                                    <td>Vessel Code</td>
                                    <td>:</td>
                                    <td>{{ $planload->vessel_code }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Company</td>
                                    <td>:</td>
                                    <td>{{ $planload->select_company }}</td>
                                </tr>
                                <tr>
                                    <td>Pemilik Barang</td>
                                    <td>:</td>
                                    <td>{{ $planload->pengirim }}</td>
                                </tr>
                                <tr>
                                    <td>Activity</td>
                                    <td>:</td>
                                    <td>{{ $planload->activity }}</td>
                                </tr>
                                <tr>
                                    <td>POL (Port of Loading)</td>
                                    <td>:</td>
                                    <td>{{ $planload->pol }}</td>
                                </tr>
                                <tr>
                                    <td>POT (Port of Transit)</td>
                                    <td>:</td>
                                    <td>{{ $planload->pot }}</td>
                                </tr>

                                <tr>
                                    <td>POD (Port of Discharge)</td>
                                    <td>:</td>
                                    <td>{{ $planload->pod }}</td>
                                </tr>
                            </table>

                        </div>
                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Jumlah Kontainer :</b></label>
                        </div>
                        <div class="table-responsive">

                            <table id="realisasiload_create" name="realisasiload_create" class="table table-bordered mb-0">
                                <thead class="table-danger text-nowrap">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center"> </th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Nomor Kontainer</th>
                                        <th class="text-center">Cargo (Nama Barang)</th>
                                        <th class="text-center">Detail Barang</th>
                                        <th class="text-center">Seal-Container</th>
                                        <th class="text-center">Date Activity</th>
                                        <th class="text-center">Lokasi Pickup</th>
                                        <th class="text-center">Nama Driver</th>
                                        <th class="text-center">Nomor Polisi</th>
                                        <th class="text-center">Remark</th>
                                        <th class="text-center">Biaya Stuffing</th>
                                        <th class="text-center">Biaya Trucking</th>
                                        <th class="text-center">Ongkos Supir</th>
                                        <th class="text-center">Biaya THC</th>
                                        <th class="text-center">Jenis Mobil</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="tbody_container">
                                    @foreach ($containers as $container)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($container->status != 'Realisasi')
                                                    <div class="validation-container">
                                                        <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                            class="form-check-input check-container"
                                                            id="kontainer_check[{{ $loop->iteration }}]" name="letter"
                                                            value="{{ $container->id }}" required autofocus>

                                                    </div>
                                                @else
                                                    <input readonly disabled checked type="checkbox"
                                                        class="form-check-input"
                                                        id="kontainer_check[{{ $loop->iteration }}]">
                                                @endif
                                            </td>

                                            <td>
                                                <label disabled @readonly(true)
                                                    id="size[{{ $container->id }}]">{{ old('size', $container->size) }}</label>

                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="type[{{ $container->id }}]">{{ old('type', $container->type) }}</label>
                                            </td>
                                            <td>
                                                {{-- <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control nomor_kontainer"
                                                        id="nomor_kontainer[{{ $container->id }}]"
                                                        name="nomor_kontainer[{{ $container->id }}]" onblur="blur_no_container(this)" required>
                                                </div> --}}
                                                <label disabled @readonly(true)
                                                    id="nomor_kontainer[{{ $container->id }}]">{{ old('nomor_kontainer', $container->nomor_kontainer) }}</label>
                                            </td>
                                            <td>

                                                <label disabled @readonly(true)
                                                    id="cargo[{{ $container->id }}]">{{ old('cargo', $container->cargo) }}</label>

                                            </td>
                                            <td>

                                                <label disabled @readonly(true)
                                                    id="detail_barang[{{ $container->id }}]">{{ old('detail_barang', $container->detail_barang) }}</label>

                                            </td>

                                            <td>
                                                <ol type="1.">

                                                @foreach ($sealsc as $seal)
                                                    @if ($seal->kontainer_id == $container->id)
                                                        <li>
                                                            {{$seal->seal_kontainer}}

                                                        </li>

                                                    @endif

                                                @endforeach
                                                </ol>


                                                {{-- <div class="validation-container">
                                                    <select data-bs-toggle="tooltip" id="seal[{{ $container->id }}]"
                                                        name="seal[{{ $container->id }}]" class="form-select seals"
                                                        onchange="change_container(this)" required>
                                                        <option selected disabled>Pilih seal</option>
                                                        @foreach ($seals as $seal)
                                                            <option value="{{ $seal->kode_seal }}">
                                                                {{ $seal->kode_seal }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="date_activity[{{ $container->id }}]">{{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}</label>
                                                {{-- <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control date_activity"
                                                        id="date_activity[{{ $container->id }}]"
                                                        name="date_activity[{{ $container->id }}]" placeholder="Date..."
                                                        required>
                                                </div> --}}
                                            </td>


                                            <td>
                                                <label disabled @readonly(true)
                                                    id="lokasi[{{ $container->id }}]">{{ old('lokasi', $container->lokasi_depo) }}</label>
                                                {{-- <div class="validation-container">
                                                    <select data-bs-toggle="tooltip" id="lokasi[{{ $container->id }}]"
                                                        name="lokasi[{{ $container->id }}]"
                                                        class="form-select lokasi-pickup" required>
                                                        <option selected disabled>Pilih Lokasi</option>
                                                        @foreach ($lokasis as $lokasi)
                                                            <option value="{{ $lokasi->id }}">
                                                                {{ $lokasi->nama_depo }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                            </td>


                                            <td>
                                                <label disabled @readonly(true)
                                                    id="driver[{{ $container->id }}]">{{ old('driver', $container->driver) }}</label>
                                                {{-- <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="driver[{{ $container->id }}]"
                                                        name="driver[{{ $container->id }}]" placeholder="Driver..."
                                                        required>

                                                </div> --}}
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="nomor_polisi[{{ $container->id }}]">{{ old('nomor_polisi', $container->nomor_polisi) }}</label>
                                                {{-- <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="nomor_polisi[{{ $container->id }}]"
                                                        name="nomor_polisi[{{ $container->id }}]"
                                                        placeholder="No Polisi..." required>

                                                </div> --}}
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="remark[{{ $container->id }}]">{{ old('remark', $container->remark) }}</label>
                                                {{-- <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="remark[{{ $container->id }}]"
                                                        name="remark[{{ $container->id }}]" placeholder="Remark..."
                                                        required>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="biaya_stuffing[{{ $container->id }}]">{{ old('biaya_stuffing', $container->biaya_stuffing) }}</label>
                                                {{-- <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="biaya_stuffing[{{ $container->id }}]"
                                                        name="biaya_stuffing[{{ $container->id }}]"
                                                        placeholder="Biaya Stuffing..." required>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="biaya_trucking[{{ $container->id }}]">{{ old('biaya_trucking', $container->biaya_trucking) }}</label>
                                                {{-- <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="biaya_trucking[{{ $container->id }}]"
                                                        name="biaya_trucking[{{ $container->id }}]"
                                                        placeholder="Biaya Trucking..." required>

                                                </div> --}}
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="ongkos_supir[{{ $container->id }}]">{{ old('ongkos_supir', $container->ongkos_supir) }}</label>
                                                {{-- <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="ongkos_supir[{{ $container->id }}]"
                                                        name="ongkos_supir[{{ $container->id }}]"
                                                        placeholder="Ongkos Supir..." required>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="biaya_thc[{{ $container->id }}]">{{ old('biaya_thc', $container->biaya_thc) }}</label>
                                                {{-- <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="biaya_thc[{{ $container->id }}]"
                                                        name="biaya_thc[{{ $container->id }}]"
                                                        placeholder="Biaya THC..." required>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="jenis_mobil[{{ $container->id }}]">{{ old('jenis_mobil', $container->jenis_mobil) }}</label>

                                            </td>
                                        </tr>


                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <!-- END Form -->
                        <div class="row row-cols-lg-auto px-3 mt-5 mb-5">



                            <div class="col-auto">
                                <button id="submit-id" type="submit" onclick="pdf_si()" class="btn btn-primary ">Cetak SI <i
                                class="fa fa-print"></i></button>
                            </div>

                            @if ($planload->status == 'Realisasi')

                            <div class="col-auto">
                                <a type="button" href="/preview-si/{{$planload->slug}}" class="btn btn-success ">VieW .pdf SI <i
                                        class="fa fa-eye"></i></a>
                            </div>
                            @endif





                        </div>

                    </div>
                    <!-- BEGIN Portlet -->

                    <!-- END Portlet -->
                </div>




                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
                @if (count($biayas) > 0)
                    <div class="col-12">
                        <div class="portlet">

                            <div class="portlet-body">

                                <!-- BEGIN Form -->


                                <div class="col-md-12 text-center">
                                    <label for="inputState" class="form-label"><b>Biaya Lainnya</b></label>
                                </div>

                                <table id="table_biaya" class="table mb-0">
                                    <thead id="thead_biaya" class="table-danger">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nomor Kontainer</th>
                                            <th class="text-center">Biaya</th>
                                            <th class="text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_biaya" class="text-center">

                                        @foreach ($biayas as $biaya)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <label id="kontainer_biaya[{{ $loop->iteration }}]">
                                                        {{ $biaya->container_planloads->nomor_kontainer }}</label>
                                                </td>
                                                <td>
                                                    <label id="harga_biaya[{{ $loop->iteration }}]">
                                                        @rupiah($biaya->harga_biaya)</label>

                                                </td>
                                                <td>
                                                    <label id="keterangan[{{ $loop->iteration }}]">
                                                        {{ $biaya->keterangan }}</label>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- <div class="mb-5 mt-5">
                            <button id="add_biaya" type="button" onclick="tambah_biaya()"
                                class="btn btn-label-danger btn-icon"> <i class="fa fa-plus"></i></button>
                        </div> --}}

                                <!-- END Form -->
                            </div>
                        </div>
                        <!-- BEGIN Portlet -->

                        <!-- END Portlet -->
                    </div>
                @endif

                @if (count($alihs) > 0)
                    <div class="col-12">
                        <div class="portlet">

                            <div class="portlet-body">

                                <!-- BEGIN Form -->

                                <div class="col-md-12 text-center">
                                    <label for="inputState" class="form-label"><b>ALIH KAPAL</b></label>
                                </div>

                                <table id="table_alih_kapal_realisasi" class="table mb-0">
                                    <thead id="thead_alih" class="table-danger">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center"></th>
                                            <th class="text-center">Nomor Kontainer</th>
                                            <th class="text-center">Pelayaran (Shipping Company)</th>
                                            <th class="text-center">POT</th>
                                            <th class="text-center">POD</th>
                                            <th class="text-center">Vessel/Voyage</th>
                                            <th class="text-center">Code Vessel/Voyage</th>
                                            <th class="text-center">Biaya Alih Kapal</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_alih" class="text-center">
                                        @foreach ($alihs as $alih)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    @if ($alih->container_planloads->status != 'Realisasi')
                                                        <div class="validation-container">
                                                            <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                                class="form-check-input check-container1"
                                                                id="kontainer_check[{{ $loop->iteration }}]" name="letter"
                                                                value="{{ $alih->kontainer_id }}" required autofocus>

                                                        </div>
                                                    @else
                                                        <input readonly disabled checked type="checkbox"
                                                            class="form-check-input"
                                                            id="kontainer_check[{{ $loop->iteration }}]">
                                                    @endif
                                                </td>

                                                <td>
                                                    <label id="kontainer_alih[{{ $loop->iteration }}]">
                                                        {{ $alih->container_planloads->nomor_kontainer }}</label>
                                                </td>
                                                <td>
                                                    <label id="pelayaran_alih[{{ $loop->iteration }}]">
                                                        {{ $alih->pelayaran_alih }}</label>
                                                </td>
                                                <td>
                                                    <label id="pot_alih[{{ $loop->iteration }}]">
                                                        {{ $alih->pot_alih }}</label>
                                                </td>
                                                <td>
                                                    <label id="pod_alih[{{ $loop->iteration }}]">
                                                        {{ $alih->pod_alih }}</label>
                                                </td>
                                                <td>
                                                    <label id="vesseL_alih[{{ $loop->iteration }}]">
                                                        {{ $alih->vesseL_alih }}</label>
                                                </td>
                                                <td>
                                                    <label id="code_vesseL_alih[{{ $loop->iteration }}]">
                                                        {{ $alih->code_vesseL_alih }}</label>
                                                </td>
                                                <td>
                                                    <label id="harga_alih_kapal[{{ $loop->iteration }}]">
                                                        @rupiah($alih->harga_alih_kapal)</label>

                                                </td>
                                                <td>
                                                    <label id="keterangan_alih_kapal[{{ $loop->iteration }}]">
                                                        {{ $alih->keterangan_alih_kapal }}</label>

                                                </td>
                                                <td>
                                                    <button type="button" id="btn_detail" name="btn_detail" class="btn btn-label-info" value="{{$alih->kontainer_alih}}" onclick="detail(this)">Detail Kontainer <i class="fa fa-eye"></i></button>

                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div class="row row-cols-lg-auto px-3 mt-5 mb-5">
                                    <div class="col-auto">
                                        <button id="submit-id1" type="submit" onclick="pdf_si()" class="btn btn-info ">Cetak SI ALIH KAPAL <i
                                        class="fa fa-print"></i></button>
                                    </div>

                                    @if ($planload->status == 'Realisasi')

                                    <div class="col-auto">
                                        <a type="button" href="/preview-si/{{$planload->slug}}" class="btn btn-success ">VieW .pdf SI <i
                                                class="fa fa-eye"></i></a>
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <!-- BEGIN Portlet -->

                        <!-- END Portlet -->
                    </div>
                @endif



        </form>
    </div>


    <div class="modal fade" id="modal-si">
        <div class="modal-dialog">
            <form action="#" id="valid_si" name="valid_si">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan SHIPPER dan CONSIGNE Terlebih Dahulu</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="validation-container">
                            <label class="form-label" for="text">SHIPPER</label>
                            <input class="form-control" id="shipper" name="shipper" type="text"
                                placeholder="Masukkan shipper">
                        </div>
                        <div class="validation-container">
                            <label class="form-label" for="text">CONSIGNE</label>
                            <input class="form-control" id="consigne" name="consigne" type="text"
                                placeholder="Masukkan consigne">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnFinish"  class="btn btn-primary">Buatkan SI</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal-job">
        <div class="modal-dialog modal-dialog-scrollable">
            <form @disabled(true) class="modal-dialog-scrollable" action="#" name="valid_job" id="valid_job">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="new_id" id="new_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DETAIL KONTAINER</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body d-grid gap-3">
                    <div class="validation-container">
                        <div class="form-floating">

                        <select disabled @readonly(true) data-bs-toggle="tooltip" id="size"
                            name="size" class="form-select" @readonly(true) required>
                            <option disabled>Pilih Size</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->size_container }}" @if ($size->size_container) selected @endif>
                                    {{ $size->size_container }}</option>
                            @endforeach
                        </select>
                        <label for="email">Size :<span class="text-danger">*</span></label>

                        </div>
                    </div>

                    <div class="validation-container">
                        <div class="form-floating">

                        <select disabled @readonly(true) data-bs-toggle="tooltip" id="type"
                            name="type" class="form-select" @readonly(true) required>
                            <option disabled>Pilih Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->type_container }}" @if ($type->type_container) selected @endif>
                                    {{ $type->type_container }}</option>
                            @endforeach
                        </select>
                        <label for="">Type :<span class="text-danger">*</span></label>


                        </div>
                    </div>
                    <div class="validation-container">
                        <div class="form-floating">
                        <input disabled @readonly(true) required data-bs-toggle="tooltip" type="text"
                            class="form-control nomor_kontainer"
                            id="nomor_kontainer" minlength="11"
                            name="nomor_kontainer"
                            onblur="blur_no_container(this)" required placeholder="XXXX0000000" onkeypress="char(this, event)" onkeydown="no_paste(event)" onkeyup="uppercase(this)" value="{{ old('nomor_kontainer') }}">
                            <label for="">Nomor Kontainer :<span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="validation-container ">
                        <div class="form-floating">
                        <input disabled @readonly(true) data-bs-toggle="tooltip" type="text" class="form-control"
                            id="cargo"
                            name="cargo"
                            value="{{ old('cargo') }}" required>
                        <label for="">Barang (Cargo) :<span class="text-danger">*</span></label>
                        </div>


                    </div>
                    <div class="validation-container">
                        <div class="form-floating">

                            <textarea disabled @readonly(true) data-bs-toggle="tooltip" class="form-control" id="detail_barang"
                                name="detail_barang" required>{{ old('detail_barang') }}</textarea>
                                <label for="">Detail Barang :<span class="text-danger">*</span></label>
                        </div>

                    </div>

                    <div class="validation-container">
                        <label for="">Seal-Container :<span class="text-danger">*</span></label>

                        <select disabled @readonly(true) data-bs-toggle="tooltip" id="seal" multiple="multiple"
                            name="seal" class="form-select" placeholde="Silahkan Pilih Seal" required
                            onchange="change_container(this)">
                            @foreach ($seals as $seal)
                                <option value="{{ $seal->kode_seal }}">
                                    {{ $seal->kode_seal }}</option>
                            @endforeach

                        </select>

                        {{-- <input onblur="seal(this)" type="text" class="form-control typeahead seal_typehead" id="seals[{{$loop->iteration}}]" name="seals[{{$loop->iteration}}]" placeholder="Seal..." required> --}}
                    </div>

                    <div class="validation-container ">
                        <div class="form-floating">


                        <input disabled @readonly(true) data-bs-toggle="tooltip" type="text"
                            class="form-control date_activity"
                            id="date_activity"
                            name="date_activity"
                            placeholder="Tanggal Kegiatan..." value="" required>
                            <label for="">Tanggal Kegiatan :<span class="text-danger">*</span></label>

                        </div>
                    </div>

                    <div class="validation-container ">


                        <label for="">Lokasi Pickup :<span class="text-danger">*</span></label>
                        <select disabled @readonly(true) data-bs-toggle="tooltip"
                            id="lokasi"
                            name="lokasi"
                            class="form-select" required>
                            <option selected disabled value="0">Pilih Lokasi Pickup</option>
                            @foreach ($lokasis as $lokasi)
                                <option value="{{ $lokasi->nama_depo }}">
                                    {{ $lokasi->nama_depo }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="validation-container ">
                        <div class="form-floating">

                        <input disabled @readonly(true) data-bs-toggle="tooltip" type="text"
                            class="form-control" id="driver"
                            name="driver" placeholder="Nama Driver..."
                            value="{{ old('driver') }}" required>
                            <label for="">Nama Driver :<span class="text-danger">*</span></label>

                        </div>
                    </div>

                    <div class="validation-container">
                        <div class="form-floating">

                        <input disabled @readonly(true) data-bs-toggle="tooltip" type="text"
                            class="form-control"
                            id="nomor_polisi"
                            name="nomor_polisi"
                            placeholder="No. Polisi..." value="{{ old('nomor_polisi') }}"  required>
                            <label for="">Nomor Polisi :<span class="text-danger">*</span></label>

                        </div>
                    </div>
                    <div class="validation-container">
                        <div class="form-floating">
                            <textarea disabled @readonly(true) data-bs-toggle="tooltip" class="form-control" id="remark"
                            name="remark" required>{{ old('remark') }}</textarea>
                            <label for="">Remark :<span class="text-danger">*</span></label>

                        </div>
                    </div>

                    <div class="validation-container">
                        <label class="label-text" for="">Biaya Stuffing :<span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" for="">Rp.</span>
                            <input disabled @readonly(true) data-bs-toggle="tooltip"
                            onkeydown="return numbersonly(this, event);"
                            onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                            class="form-control"
                            id="biaya_stuffing"
                            name="biaya_stuffing"
                            placeholder="Biaya Stuffing..." value="@rupiah2(old('biaya_stuffing'))" required>

                        </div>
                    </div>
                    <div class="validation-container">
                        <label class="label-text" for="">Biaya Trucking :<span class="text-danger">*</span></label>

                        <div class="input-group input-group-sm">
                            <span class="input-group-text" for="">Rp.</span>

                            <input disabled @readonly(true) data-bs-toggle="tooltip"
                                onkeydown="return numbersonly(this, event);"
                                onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                class="form-control"
                                id="biaya_trucking"
                                name="biaya_trucking"
                                placeholder="Biaya Trucking..." value="@rupiah2(old('biaya_trucking'))" required>

                        </div>
                    </div>
                    <div class="validation-container">
                        <label class="label-text" for="">Ongkos Supir :<span class="text-danger">*</span></label>

                        <div class="input-group input-group-sm">
                            <span class="input-group-text" for="">Rp.</span>

                            <input disabled @readonly(true) data-bs-toggle="tooltip"
                                onkeydown="return numbersonly(this, event);"
                                onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                class="form-control"
                                id="ongkos_supir"
                                name="ongkos_supir"
                                placeholder="Ongkos Supir..." value="@rupiah2(old('ongkos_supir'))" required>

                        </div>
                    </div>

                    <div class="validation-container">
                        <label class="label-text" for="">Biaya THC :<span class="text-danger">*</span></label>

                        <div class="input-group input-group-sm">
                            <span class="input-group-text" for="">Rp.</span>

                            <input  disabled @readonly(true)data-bs-toggle="tooltip"
                                oninput="setFormat('biaya_thc');"
                                onkeydown="numbersonly1(this)"
                                pattern="[0-9]" data-type="number"
                                onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                class="form-control"
                                id="biaya_thc"
                                name="biaya_thc"
                                placeholder="Biaya THC..." value="@rupiah2(old('biaya_thc'))" required>

                        </div>
                    </div>

                    <div class="validation-container">
                        <div class="form-floating">

                            <select disabled @readonly(true) data-bs-toggle="tooltip"
                            id="jenis_mobil"
                            name="jenis_mobil"
                            class="form-select" required>
                            <option value="Mobil Sewa" @if ("Mobil Sewa") selected @endif>Mobil Sewa</option>
                            <option value="Mobil Sendiri" @if ("Mobil Sendiri") selected @endif>Mobil Sendiri</option>
                            </select>
                            <label for="">Pilih Jenis Mobil :<span class="text-danger">*</span></label>

                        </div>
                    </div>
                    <div class="validation-container">
                        <label for="">Pilih Deposit Trucking :<span class="text-danger">*</span></label>

                        <select disabled @readonly(true) data-bs-toggle="tooltip" required @readonly(true)
                            id="dana"
                            name="dana"
                            class="form-select danas">
                            @foreach ($danas as $dana)
                            <option value="{{ $dana->id }}" @if ($dana->id) selected @endif>
                            {{ $dana->pj }} - @rupiah($dana->nominal)</option>

                            @endforeach
                        </select>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

            </form>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script wsrc="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('/') }}./js/processload.js"></script> --}}
    <script type="text/javascript" src="{{ asset('/') }}./js/create_si.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>

    <script>

        $(document).ready(function() {
            var check = $(".check-container");

            $("#submit-id").attr("disabled", "disabled");
            check.click(function() {
                if ($(this).is(":checked")) {
                    $("#submit-id").removeAttr("disabled");
                } else {
                    $("#submit-id").attr("disabled", "disabled");
                }
            });

            var check = $(".check-container1");

            $("#submit-id1").attr("disabled", "disabled");
            check.click(function() {
                if ($(this).is(":checked")) {
                    $("#submit-id1").removeAttr("disabled");
                } else {
                    $("#submit-id1").attr("disabled", "disabled");
                }
            });
        });
    </script>
@endsection
