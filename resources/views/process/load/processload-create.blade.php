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
                            <a href="/processload" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-primary">Activity</span>
                            </a>
                            <a href="/processload" class="breadcrumb-item">
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
            <div class="col-md-6">
                <div class="portlet">

                    <div class="portlet-body">

                        <div class="col-md-12 text-center mb-3">
                            <h1 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center"> DETAIL KAPAL :
                            </h1>
                            <h3 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center"> {{ $planload->vessel }} ( {{ $planload->select_company }}
                                )</h3>
                        </div>
                        <div class="col-md-12 mb-3 table-responsive">
                            <table border="0" style="margin-left: auto; margin-right:auto;">
                                <tr>
                                    <td width="45%">Vessel/Voyage</td>
                                    <td width="5%">:</td>
                                    <td width="50%">
                                        {{ $planload->vessel }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vessel Code</td>
                                    <td>:</td>
                                    <td><label for="">{{ $planload->vessel_code }}</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipping Company</td>
                                    <td>:</td>
                                    <td> <label for="">{{ $planload->select_company }}</label>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Pengirim</td>
                                    <td>:</td>
                                    <td>{{ $planload->pengirim }}

                                    </td>

                                </tr>
                                <tr>
                                    <td>Penerima</td>
                                    <td>:</td>
                                    <td>{{ $planload->penerima }}

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

                                <tr>
                                    <td>POD (Port of Discharge)</td>
                                    <td>:</td>
                                    <td>{{ $planload->pod }}

                                    </td>
                                </tr>
                            </table>

                            <div class="col-12 text-center mt-3">
                                <button value="{{ $planload->id }}" type="button" onclick="edit_planloaad_job(this)"
                                    class="btn btn-label-primary">Edit Detail Kapal Load <i
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

            <div class="col-md-6">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>DETAIL KONTAINER :</b></label>
                        </div>
                        <div class="table-responsive">


                            <table id="table_biaya" class="table mb-0">
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
                                    <tr>

                                    </tr>

                                </tbody>
                            </table>

                        </div>

                        <div class="mb-5 mt-5">
                            <button id="detail_kontainer" type="button" onclick="detail_tambah()"
                                class="btn btn-label-success">Tambah Kontainer <i class="fa fa-plus"></i></button>
                        </div>

                        @if ($planload->status == 'Process-Load' || $planload->status == 'Realisasi')
                            <div class="col-12 text-end mr-3">
                                <button value="{{ $planload->slug }}" type="button" onclick="realisasi_page(this)"
                                    class="btn btn-primary">Realisasi Load <i class="fa fa-arrow-right"></i></button>
                            </div>
                        @endif


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

                        <table id="table_biaya" class="table mb-0">
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
            <div class="col-md-6">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>CONTAINER BATAL MUAT (JIKA ADA)</b></label>
                        </div>

                        <table id="table_batal_muat" class="table mb-0">
                            <thead id="thead_batal_muat" class="table-success">
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Pilih Nomor Container</th>
                                    <th class="text-center">Biaya Batal Muat</th>
                                    <th class="text-center">Keterangan</th>
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
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
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

                            <table id="table_alih_kapal" class="table table-responsive mb-0 tabel-fiks">
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
                                            <td class="text-center">
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
                                                    value="{{ $alih->kontainer_alih }}" onclick="detail(this)">Detail
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
                    <div class="modal-body d-grid gap-3">
                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="size" name="size" class="form-select"
                                    @readonly(true) required>
                                    <option disabled>Pilih Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}"
                                            @if ($size->size_container) selected @endif>
                                            {{ $size->size_container }}</option>
                                    @endforeach
                                </select>
                                <label for="email">Size :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="type" name="type" class="form-select"
                                    @readonly(true) required>
                                    <option disabled>Pilih Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}"
                                            @if ($type->type_container) selected @endif>
                                            {{ $type->type_container }}</option>
                                    @endforeach
                                </select>
                                <label for="">Type :<span class="text-danger">*</span></label>


                            </div>
                        </div>
                        <div class="validation-container">
                            <div class="form-floating">
                                <input required data-bs-toggle="tooltip" type="text"
                                    class="form-control nomor_kontainer" id="nomor_kontainer" minlength="11"
                                    maxlength="11" name="nomor_kontainer" onblur="blur_no_container(this)" required
                                    placeholder="XXXX0000000" onkeypress="char(this, event)" onkeyup="uppercase(this)"
                                    value="{{ old('nomor_kontainer') }}">
                                <label for="">Nomor Kontainer :<span class="text-danger">*</span></label>
                            </div>
                        </div>

                        <div class="validation-container ">
                            <div class="form-floating">
                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="cargo"
                                    name="cargo" value="{{ old('cargo') }}" required>
                                <label for="">Barang (Cargo) :<span class="text-danger">*</span></label>
                            </div>


                        </div>
                        <div class="validation-container">
                            <div class="form-floating">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="detail_barang" name="detail_barang" required>{{ old('detail_barang') }}</textarea>
                                <label for="">Detail Barang :<span class="text-danger">*</span></label>
                            </div>

                        </div>

                        <div class="validation-container">
                            <label for="">Seal-Container :<span class="text-danger">*</span></label>

                            <select data-bs-toggle="tooltip" id="seal" multiple="multiple" name="seal"
                                class="form-select" placeholde="Silahkan Pilih Seal" required>
                                @foreach ($seals as $seal)
                                    <option value="{{ $seal->kode_seal }}">
                                        {{ $seal->kode_seal }}</option>
                                @endforeach

                            </select>

                            {{-- <input onblur="seal(this)" type="text" class="form-control typeahead seal_typehead" id="seals[{{$loop->iteration}}]" name="seals[{{$loop->iteration}}]" placeholder="Seal..." required> --}}
                        </div>

                        <div class="validation-container ">
                            <div class="form-floating">


                                <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="date_activity" name="date_activity" placeholder="Tanggal Kegiatan..."
                                    value="" required>
                                <label for="">Tanggal Kegiatan :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container ">


                            <label for="">Lokasi Pickup :<span class="text-danger">*</span></label>
                            <select data-bs-toggle="tooltip" id="lokasi" name="lokasi" class="form-select" required>
                                <option selected disabled value="0">Pilih Lokasi Pickup</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="validation-container ">
                            <div class="form-floating">

                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="driver"
                                    name="driver" placeholder="Nama Driver..." value="{{ old('driver') }}" required>
                                <label for="">Nama Driver :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <div class="form-floating">

                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="nomor_polisi"
                                    name="nomor_polisi" placeholder="No. Polisi..." value="{{ old('nomor_polisi') }}"
                                    required>
                                <label for="">Nomor Polisi :<span class="text-danger">*</span></label>

                            </div>
                        </div>
                        <div class="validation-container">
                            <div class="form-floating">
                                <textarea data-bs-toggle="tooltip" class="form-control" id="remark" name="remark" required>{{ old('remark') }}</textarea>
                                <label for="">Remark :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya Stuffing :<span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="biaya_stuffing" name="biaya_stuffing" placeholder="Biaya Stuffing..."
                                    value="@rupiah2(old('biaya_stuffing'))" required>

                            </div>
                        </div>
                        <div class="validation-container">
                            <label class="label-text" for="">Biaya Trucking :<span
                                    class="text-danger">*</span></label>

                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>

                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="biaya_trucking" name="biaya_trucking" placeholder="Biaya Trucking..."
                                    value="@rupiah2(old('biaya_trucking'))" required>

                            </div>
                        </div>
                        <div class="validation-container">
                            <label class="label-text" for="">Ongkos Supir :<span
                                    class="text-danger">*</span></label>

                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>

                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="ongkos_supir" name="ongkos_supir" placeholder="Ongkos Supir..."
                                    value="@rupiah2(old('ongkos_supir'))" required>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya THC :<span
                                    class="text-danger">*</span></label>

                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>

                                <input data-bs-toggle="tooltip" oninput="setFormat('biaya_thc');"
                                    onkeydown="numbersonly1(this)" pattern="[0-9]" data-type="number"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="biaya_thc" name="biaya_thc" placeholder="Biaya THC..."
                                    value="@rupiah2(old('biaya_thc'))" required>

                            </div>
                        </div>

                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="jenis_mobil" name="jenis_mobil" class="form-select"
                                    required>
                                    <option value="Mobil Sewa" @if ('Mobil Sewa') selected @endif>Mobil Sewa
                                    </option>
                                    <option value="Mobil Sendiri" @if ('Mobil Sendiri') selected @endif>Mobil
                                        Sendiri</option>
                                </select>
                                <label for="">Pilih Jenis Mobil :<span class="text-danger">*</span></label>

                            </div>
                        </div>
                        <div class="validation-container">
                            <label for="">Pilih Deposit Trucking :<span class="text-danger">*</span></label>

                            <select data-bs-toggle="tooltip" required @readonly(true) id="dana" name="dana"
                                class="form-select danas">
                                @foreach ($danas as $dana)
                                    <option value="{{ $dana->id }}" @if ($dana->id) selected @endif>
                                        {{ $dana->pj }} - @rupiah($dana->nominal)</option>
                                @endforeach
                            </select>

                        </div>

                        @if (count($spks) > 0)
                            <div class="validation-container">
                                <label for="">SPK-Container : </label>

                                <select data-bs-toggle="tooltip" id="spk" multiple="multiple" name="spk"
                                    class="form-select" placeholde="Silahkan Pilih SPK" placeholder = "Pilih SPK">
                                    @foreach ($spks as $spk)
                                        <option value="{{ $spk->kode_spk }}">
                                            {{ $spk->kode_spk }}</option>
                                    @endforeach

                                </select>

                                {{-- <input onblur="seal(this)" type="text" class="form-control typeahead seal_typehead" id="seals[{{$loop->iteration}}]" name="seals[{{$loop->iteration}}]" placeholder="Seal..." required> --}}
                            </div>
                        @endif


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
                    <div class="modal-body d-grid gap-3">
                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="size_update" name="size_update" class="form-select"
                                    @readonly(true) required>
                                    <option disabled>Pilih Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}"
                                            @if ($size->size_container) selected @endif>
                                            {{ $size->size_container }}</option>
                                    @endforeach
                                </select>
                                <label for="email">Size :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="type_update" name="type_update" class="form-select"
                                    @readonly(true) required>
                                    <option disabled>Pilih Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}"
                                            @if ($type->type_container) selected @endif>
                                            {{ $type->type_container }}</option>
                                    @endforeach
                                </select>
                                <label for="">Type :<span class="text-danger">*</span></label>


                            </div>
                        </div>
                        <div class="validation-container">
                            <div class="form-floating">
                                <input type="hidden" id="no_container_edit" name="no_container_edit">
                                <input required data-bs-toggle="tooltip" type="text"
                                    class="form-control nomor_kontainer" id="nomor_kontainer_update" minlength="11"
                                    maxlength="11" name="nomor_kontainer_update" onblur="blur_no_container_edit(this)"
                                    required placeholder="XXXX0000000" onkeypress="char(this, event)"
                                    onkeyup="uppercase(this)" value="{{ old('nomor_kontainer') }}">
                                <label for="">Nomor Kontainer :<span class="text-danger">*</span></label>
                            </div>
                        </div>

                        <div class="validation-container ">
                            <div class="form-floating">
                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="cargo_update"
                                    name="cargo_update" value="{{ old('cargo') }}" required>
                                <label for="">Barang (Cargo) :<span class="text-danger">*</span></label>
                            </div>


                        </div>
                        <div class="validation-container">
                            <div class="form-floating">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="detail_barang_update" name="detail_barang_update"
                                    required>{{ old('detail_barang_update') }}</textarea>
                                <label for="">Detail Barang :<span class="text-danger">*</span></label>
                            </div>

                        </div>

                        <div class="validation-container">
                            <label for="">Seal-Container :<span class="text-danger">*</span></label>

                            <select data-bs-toggle="tooltip" id="seal_update" multiple="multiple" name="seal_update"
                                class="form-select" placeholde="Silahkan Pilih Seal" required>
                                @foreach ($seals as $seal)
                                    <option value="{{ $seal->kode_seal }}">
                                        {{ $seal->kode_seal }}</option>
                                @endforeach

                            </select>

                            {{-- <input onblur="seal(this)" type="text" class="form-control typeahead seal_typehead" id="seals[{{$loop->iteration}}]" name="seals[{{$loop->iteration}}]" placeholder="Seal..." required> --}}
                        </div>

                        <div class="validation-container ">
                            <div class="form-floating">


                                <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="date_activity_update" name="date_activity_update"
                                    placeholder="Tanggal Kegiatan..." value="" required>
                                <label for="">Tanggal Kegiatan :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container ">


                            <label for="">Lokasi Pickup :<span class="text-danger">*</span></label>
                            <select data-bs-toggle="tooltip" id="lokasi_update" name="lokasi_update" class="form-select"
                                required>
                                <option selected disabled value="0">Pilih Lokasi Pickup</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="validation-container ">
                            <div class="form-floating">

                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="driver_update"
                                    name="driver_update" placeholder="Nama Driver..." value="{{ old('driver') }}"
                                    required>
                                <label for="">Nama Driver :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <div class="form-floating">

                                <input data-bs-toggle="tooltip" type="text" class="form-control"
                                    id="nomor_polisi_update" name="nomor_polisi_update" placeholder="No. Polisi..."
                                    value="{{ old('nomor_polisi') }}" required>
                                <label for="">Nomor Polisi :<span class="text-danger">*</span></label>

                            </div>
                        </div>
                        <div class="validation-container">
                            <div class="form-floating">
                                <textarea data-bs-toggle="tooltip" class="form-control" id="remark_update" name="remark_update" required>{{ old('remark_update') }}</textarea>
                                <label for="">Remark :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya Stuffing :<span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="biaya_stuffing_update" name="biaya_stuffing_update"
                                    placeholder="Biaya Stuffing..." value="@rupiah2(old('biaya_stuffing'))" required>

                            </div>
                        </div>
                        <div class="validation-container">
                            <label class="label-text" for="">Biaya Trucking :<span
                                    class="text-danger">*</span></label>

                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>

                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="biaya_trucking_update" name="biaya_trucking_update"
                                    placeholder="Biaya Trucking..." value="@rupiah2(old('biaya_trucking'))" required>

                            </div>
                        </div>
                        <div class="validation-container">
                            <label class="label-text" for="">Ongkos Supir :<span
                                    class="text-danger">*</span></label>

                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>

                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="ongkos_supir_update" name="ongkos_supir_update" placeholder="Ongkos Supir..."
                                    value="@rupiah2(old('ongkos_supir'))" required>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya THC :<span
                                    class="text-danger">*</span></label>

                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>

                                <input data-bs-toggle="tooltip" oninput="setFormat('biaya_thc');"
                                    onkeydown="numbersonly1(this)" pattern="[0-9]" data-type="number"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="biaya_thc_update" name="biaya_thc_update" placeholder="Biaya THC..."
                                    value="@rupiah2(old('biaya_thc'))" required>

                            </div>
                        </div>

                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="jenis_mobil_update" name="jenis_mobil_update"
                                    class="form-select" required>
                                    <option value="Mobil Sewa" @if ('Mobil Sewa') selected @endif>Mobil
                                        Sewa</option>
                                    <option value="Mobil Sendiri" @if ('Mobil Sendiri') selected @endif>Mobil
                                        Sendiri</option>
                                </select>
                                <label for="">Pilih Jenis Mobil :<span class="text-danger">*</span></label>

                            </div>
                        </div>
                        <div class="validation-container">
                            <label for="">Pilih Deposit Trucking :<span class="text-danger">*</span></label>

                            <select data-bs-toggle="tooltip" required @readonly(true) id="dana_update"
                                name="dana_update" class="form-select danas">
                                @foreach ($danas as $dana)
                                    <option value="{{ $dana->id }}"
                                        @if ($dana->id) selected @endif>
                                        {{ $dana->pj }} - @rupiah($dana->nominal)</option>
                                @endforeach
                            </select>

                        </div>

                        @if (count($spks) > 0)
                            <div class="validation-container">
                                <label for="">SPK-Container : </label>

                                <select data-bs-toggle="tooltip" id="spk_update" multiple="multiple" name="spk_update"
                                    class="form-select" placeholde="Silahkan Pilih SPK">
                                    @foreach ($spks as $spk)
                                        <option value="{{ $spk->kode_spk }}">
                                            {{ $spk->kode_spk }}</option>
                                    @endforeach

                                </select>

                                {{-- <input onblur="seal(this)" type="text" class="form-control typeahead seal_typehead" id="seals[{{$loop->iteration}}]" name="seals[{{$loop->iteration}}]" placeholder="Seal..." required> --}}
                            </div>
                        @endif


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
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
                    <div class="modal-body d-grid gap-3">
                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="size_tambah" name="size_tambah" class="form-select"
                                    @readonly(true)>
                                    <option selected disabled>Pilih Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}">
                                            {{ $size->size_container }}</option>
                                    @endforeach
                                </select>
                                <label for="email">Size :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="type_tambah" name="type_tambah" class="form-select"
                                    @readonly(true) required>
                                    <option selected disabled>Pilih Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}">
                                            {{ $type->type_container }}</option>
                                    @endforeach
                                </select>
                                <label for="">Type :<span class="text-danger">*</span></label>


                            </div>
                        </div>
                        <div class="validation-container">
                            <div class="form-floating">
                                <input data-bs-toggle="tooltip" type="text" class="form-control nomor_kontainer"
                                    id="nomor_kontainer_tambah" minlength="11" name="nomor_kontainer_tambah"
                                    onblur="blur_no_container(this)" required placeholder="XXXX0000000"
                                    onkeypress="char(this, event)" onkeydown="no_paste(event)" onkeyup="uppercase(this)">
                                <label for="">Nomor Kontainer :<span class="text-danger">*</span></label>
                            </div>
                        </div>

                        <div class="validation-container ">
                            <div class="form-floating">
                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="cargo_tambah"
                                    name="cargo_tambah" required>
                                <label for="">Barang (Cargo) :<span class="text-danger">*</span></label>
                            </div>


                        </div>
                        <div class="validation-container">
                            <div class="form-floating">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="detail_barang_tambah" name="detail_barang_tambah"
                                    required>{{ old('detail_barang') }}</textarea>
                                <label for="">Detail Barang :<span class="text-danger">*</span></label>
                            </div>

                        </div>

                        <div class="validation-container">
                            <label for="">Seal-Container :<span class="text-danger">*</span></label>

                            <select data-bs-toggle="tooltip" id="seal_tambah" multiple="multiple" name="seal_tambah"
                                class="form-select seals" placeholde="Silahkan Pilih Seal" required>
                                @foreach ($seals as $seal)
                                    <option value="{{ $seal->kode_seal }}">
                                        {{ $seal->kode_seal }}</option>
                                @endforeach
                            </select>

                            {{-- <input onblur="seal(this)" type="text" class="form-control typeahead seal_typehead" id="seals[{{$loop->iteration}}]" name="seals[{{$loop->iteration}}]" placeholder="Seal..." required> --}}
                        </div>

                        <div class="validation-container ">
                            <div class="form-floating">


                                <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="date_activity_tambah" name="date_activity_tambah"
                                    placeholder="Tanggal Kegiatan..." required>
                                <label for="">Tanggal Kegiatan :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container ">


                            <label for="">Lokasi Pickup :<span class="text-danger">*</span></label>
                            <select data-bs-toggle="tooltip" id="lokasi_tambah" name="lokasi_tambah"
                                class="form-select lokasi-pickup" required>
                                <option selected disabled>Pilih Lokasi Pickup</option>
                                @foreach ($lokasis as $lokasi)
                                    <option value="{{ $lokasi->nama_depo }}">
                                        {{ $lokasi->nama_depo }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="validation-container ">
                            <div class="form-floating">

                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="driver_tambah"
                                    name="driver_tambah" placeholder="Nama Driver..." required>
                                <label for="">Nama Driver :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <div class="form-floating">

                                <input data-bs-toggle="tooltip" type="text" class="form-control"
                                    id="nomor_polisi_tambah" name="nomor_polisi_tambah" placeholder="No. Polisi..."
                                    required>
                                <label for="">Nomor Polisi :<span class="text-danger">*</span></label>

                            </div>
                        </div>
                        <div class="validation-container">
                            <div class="form-floating">
                                <textarea data-bs-toggle="tooltip" class="form-control" id="remark_tambah" name="remark_tambah" required></textarea>
                                <label for="">Remark :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya Stuffing :<span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="biaya_stuffing_tambah" name="biaya_stuffing_tambah"
                                    placeholder="Biaya Stuffing..." required>

                            </div>
                        </div>
                        <div class="validation-container">
                            <label class="label-text" for="">Biaya Trucking :<span
                                    class="text-danger">*</span></label>

                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>

                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="biaya_trucking_tambah" name="biaya_trucking_tambah"
                                    placeholder="Biaya Trucking..." required>

                            </div>
                        </div>
                        <div class="validation-container">
                            <label class="label-text" for="">Ongkos Supir :<span
                                    class="text-danger">*</span></label>

                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>

                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="ongkos_supir_tambah" name="ongkos_supir_tambah" placeholder="Ongkos Supir..."
                                    required>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya THC :<span
                                    class="text-danger">*</span></label>

                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>

                                <input data-bs-toggle="tooltip" oninput="setFormat('biaya_thc');"
                                    onkeydown="numbersonly1(this)" pattern="[0-9]" data-type="number"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="biaya_thc_tambah" name="biaya_thc_tambah" placeholder="Biaya THC..." required>

                            </div>
                        </div>

                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="jenis_mobil_tambah" name="jenis_mobil_tambah"
                                    class="form-select" required>
                                    <option disabled selected>Pilih Jenis Mobil</option>
                                    <option value="Mobil Sewa">Mobil Sewa</option>
                                    <option value="Mobil Sendiri">Mobil Sendiri</option>
                                </select>
                                <label for="">Pilih Jenis Mobil :<span class="text-danger">*</span></label>

                            </div>
                        </div>
                        <div class="validation-container">
                            <label for="">Pilih Deposit Trucking :<span class="text-danger">*</span></label>

                            <select data-bs-toggle="tooltip" @readonly(true) id="dana_tambah" name="dana_tambah"
                                class="form-select danas" required>
                                <option disabled selected>Pilih Deposit Trucking</option>
                                @foreach ($danas as $dana)
                                    <option value="{{ $dana->id }}">
                                        {{ $dana->pj }} - @rupiah($dana->nominal)</option>
                                @endforeach
                            </select>

                        </div>
                        @if (count($spks) > 0)
                        <div class="validation-container">
                            <label for="">SPK-Container : </label>

                            <select data-bs-toggle="tooltip" id="spk_tambah" multiple="multiple" name="spk_tambah"
                                class="form-select" placeholde="Silahkan Pilih SPK">
                                @foreach ($spks as $spk)
                                    <option value="{{ $spk->kode_spk }}">
                                        {{ $spk->kode_spk }}</option>
                                @endforeach

                            </select>

                            {{-- <input onblur="seal(this)" type="text" class="form-control typeahead seal_typehead" id="seals[{{$loop->iteration}}]" name="seals[{{$loop->iteration}}]" placeholder="Seal..." required> --}}
                        </div>
                    @endif

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
                    <div class="modal-body d-grid gap-3">
                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="kontainer_biaya" name="kontainer_biaya"
                                    class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($select_batal_edit as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>
                                <label for="email">Nomor Kontainer :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya :<span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="harga_biaya" name="harga_biaya" placeholder="Biaya..."
                                    value="@rupiah2(old('harga_biaya'))" required>

                            </div>
                        </div>





                        <div class="validation-container">
                            <div class="form-floating">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan" name="keterangan" required>{{ old('keterangan') }}</textarea>
                                <label for="">Keterangan Biaya :<span class="text-danger">*</span></label>
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
                    <div class="modal-body d-grid gap-3">
                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="kontainer_biaya_edit" name="kontainer_biaya_edit"
                                    class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($select_batal_edit as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>
                                <label for="email">Nomor Kontainer :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya :<span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="harga_biaya_edit" name="harga_biaya_edit" placeholder="Biaya..."
                                    value="@rupiah2(old('harga_biaya'))" required>

                            </div>
                        </div>





                        <div class="validation-container">
                            <div class="form-floating">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_edit" name="keterangan_edit" required>{{ old('keterangan') }}</textarea>
                                <label for="">Keterangan Biaya :<span class="text-danger">*</span></label>
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
                    <div class="modal-body d-grid gap-3">
                        <div class="validation-container">
                            <div class="form-floating">

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
                                <label for="email">Nomor Kontainer :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya Batal Muatan :<span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="harga_batal" name="harga_batal" placeholder="Biaya Batal Muatan..."
                                    value="@rupiah2(old('harga_batal'))" required>

                            </div>
                        </div>





                        <div class="validation-container">
                            <div class="form-floating">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_batal" name="keterangan_batal" required>{{ old('keterangan_batal') }}</textarea>
                                <label for="">Keterangan Batal Muat :<span class="text-danger">*</span></label>
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
                    <div class="modal-body d-grid gap-3">
                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="kontainer_batal_edit" name="kontainer_batal_edit"
                                    class="form-select" @disabled(true) @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($select_batal_edit as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>
                                <label for="email">Nomor Kontainer :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya Batal Muatan :<span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="harga_batal_edit" name="harga_batal_edit" placeholder="Biaya Batal Muatan..."
                                    value="@rupiah2(old('harga_batal'))" required>

                            </div>
                        </div>





                        <div class="validation-container">
                            <div class="form-floating">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_batal_edit" name="keterangan_batal_edit"
                                    required>{{ old('keterangan_batal_edit') }}</textarea>
                                <label for="">Keterangan Batal Muat :<span class="text-danger">*</span></label>
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
                    <div class="modal-body d-grid gap-3">
                        <div class="validation-container">
                            <div class="form-floating">

                                <select data-bs-toggle="tooltip" id="kontainer_alih" name="kontainer_alih"
                                    class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($containers_alih as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>
                                <label for="email">Nomor Kontainer :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label for="email">Pilih Pelayaran (Shipping Company) :<span
                                    class="text-danger">*</span></label>

                            <select id="select_company_alih" name="select_company_alih" class="form-select" required>
                                <option selected disabled>Pilih Company</option>
                                @foreach ($shipping_companys as $shippingcompany)
                                    <option value="{{ $shippingcompany->nama_company }}">
                                        {{ $shippingcompany->nama_company }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="validation-container">
                            <label for="email">Pilih POT (jika ada) :</label>

                            <select id="pot_alih" name="pot_alih" class="form-select">
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pelabuhans as $pot)
                                    <option value="{{ $pot->nama_pelabuhan }}">{{ $pot->area_code }} -
                                        {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="validation-container">
                            <label for="email">Pilih POD : <span class="text-danger">*</span></label>

                            <select id="pod_alih" name="pod_alih" class="form-select" required>
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pelabuhans as $pot)
                                    <option value="{{ $pot->nama_pelabuhan }}">{{ $pot->area_code }} -
                                        {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="validation-container">
                            <label for="email">Vessel/Voyage : <span class="text-danger">*</span></label>
                            <input required class="form-control" type="text" name="vessel_alih" id="vessel_alih">

                        </div>
                        <div class="validation-container">
                            <label for="email">Vessel Code : <span class="text-danger">*</span></label>
                            <input required class="form-control" type="text" name="vessel_code_alih"
                                id="vessel_code_alih">

                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya Alih Kapal<span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="harga_alih" name="harga_alih" placeholder="Biaya Alih Kapal..." required>

                            </div>
                        </div>





                        <div class="validation-container">
                            <div class="form-floating">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_alih" placeholder="Keterangan Alih Kapal"
                                    name="keterangan_alih" required>{{ old('keterangan_alih') }}</textarea>
                                <label for="">Keterangan Alih Kapal :<span class="text-danger">*</span></label>
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
                    <div class="modal-body d-grid gap-3">
                        <div class="validation-container">
                            <div class="form-floating">

                                <select disabled data-bs-toggle="tooltip" id="kontainer_alih_edit"
                                    name="kontainer_alih_edit" class="form-select" @readonly(true) required>
                                    <option selected disabled>Pilih Kontainer</option>
                                    @foreach ($select_batal_edit as $container)
                                        <option value="{{ $container->id }}">
                                            {{ $container->nomor_kontainer }}</option>
                                    @endforeach
                                </select>
                                <label for="email">Nomor Kontainer :<span class="text-danger">*</span></label>

                            </div>
                        </div>

                        <div class="validation-container">
                            <label for="email">Pilih Pelayaran (Shipping Company) :<span
                                    class="text-danger">*</span></label>

                            <select id="select_company_alih_edit" name="select_company_alih_edit" class="form-select"
                                required>
                                <option selected disabled>Pilih Company</option>
                                @foreach ($shipping_companys as $shippingcompany)
                                    <option value="{{ $shippingcompany->nama_company }}">
                                        {{ $shippingcompany->nama_company }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="validation-container">
                            <label for="email">Pilih POT (jika ada) :</label>

                            <select id="pot_alih_edit" name="pot_alih_edit" class="form-select">
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pelabuhans as $pot)
                                    <option value="{{ $pot->nama_pelabuhan }}">{{ $pot->area_code }} -
                                        {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="validation-container">
                            <label for="email">Pilih POD : <span class="text-danger">*</span></label>

                            <select id="pod_alih_edit" name="pod_alih_edit" class="form-select" required>
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pelabuhans as $pot)
                                    <option value="{{ $pot->nama_pelabuhan }}">{{ $pot->area_code }} -
                                        {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="validation-container">
                            <label for="email">Vessel/Voyage : <span class="text-danger">*</span></label>
                            <input required class="form-control" type="text" name="vessel_alih_edit"
                                id="vessel_alih_edit">

                        </div>
                        <div class="validation-container">
                            <label for="email">Vessel Code : <span class="text-danger">*</span></label>
                            <input required class="form-control" type="text" name="vessel_code_alih_edit"
                                id="vessel_code_alih_edit">

                        </div>

                        <div class="validation-container">
                            <label class="label-text" for="">Biaya Alih Kapal<span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input data-bs-toggle="tooltip" onkeydown="return numbersonly(this, event);"
                                    onkeyup="javascript:tandaPemisahTitik(this);" type="text" class="form-control"
                                    id="harga_alih_edit" name="harga_alih_edit" placeholder="Biaya Alih Kapal..."
                                    required>

                            </div>
                        </div>





                        <div class="validation-container">
                            <div class="form-floating">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_alih_edit"
                                    placeholder="Keterangan Alih Kapal" name="keterangan_alih_edit" required>{{ old('keterangan_alih_edit') }}</textarea>
                                <label for="">Keterangan Alih Kapal :<span class="text-danger">*</span></label>
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
                    <div class="modal-body d-grid gap-3">
                        <div class="validation-container">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="vessel" name="vessel"
                                    value="{{ $planload->vessel }}">
                                <label for="email">Vessel/Voyage :<span class="text-danger">*</span></label>

                            </div>
                        </div>
                        <div class="validation-container">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="vessel_code" name="vessel_code"
                                    value="{{ $planload->vessel_code }}">
                                <label for="email">Vessel Code :<span class="text-danger">*</span></label>

                            </div>
                        </div>
                        <div class="validation-container">
                            <label for="email">Shipping Company (Pelayaran) :<span
                                    class="text-danger">*</span></label>

                            <select id="select_company" name="select_company" class="form-select">
                                <option selected disabled>Pilih Company</option>
                                @foreach ($shipping_companys as $shippingcompany)
                                    <option value="{{ $shippingcompany->nama_company }}"
                                        @if ($shippingcompany->nama_company == $planload->select_company) selected @endif>
                                        {{ $shippingcompany->nama_company }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="validation-container">
                            <label for="email">Pengirim :<span class="text-danger">*</span></label>

                            <select id="Pengirim_1" name="Pengirim_1" class="form-select">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($pengirim as $pengirim)
                                    <option value="{{ $pengirim->nama_costumer }}"
                                        @if ($pengirim->nama_costumer == $planload->pengirim) selected @endif>{{ $pengirim->nama_costumer }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="validation-container">
                            <label for="email">Penerima :<span class="text-danger">*</span></label>

                            <select id="Penerima_1" name="Penerima_1" class="form-select">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($penerima as $penerima)
                                    <option value="{{ $penerima->nama_penerima }}"
                                        @if ($penerima->nama_penerima == $planload->penerima) selected @endif>{{ $penerima->nama_penerima }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="validation-container">
                            <label for="email">Jenis Kegiatan(Activity) :<span class="text-danger">*</span></label>

                            <select id="activity" name="activity" class="form-select">
                                <option selected disabled>Pilih Activity</option>
                                @foreach ($activity as $activity)
                                    <option value="{{ $activity->kegiatan }}"
                                        @if ($activity->kegiatan == $planload->activity) selected @endif>{{ $activity->kegiatan }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="validation-container">
                            <label for="email">POL :<span class="text-danger">*</span></label>

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
                        <div class="validation-container">
                            <label for="email">POT :<span class="text-danger">*</span></label>

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
                        <div class="validation-container">
                            <label for="email">POD :<span class="text-danger">*</span></label>

                            <select id="POD_1" name="POD_1" class="form-select">
                                <option selected disabled>Pilih POD</option>
                                @foreach ($pelabuhans as $pod)
                                    <option value="{{ $pod->nama_pelabuhan }}"
                                        @if ($pod->nama_pelabuhan == $planload->pod) selected @endif>{{ $pod->area_code }} -
                                        {{ $pod->nama_pelabuhan }}</option>
                                @endforeach
                            </select>

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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('/') }}./js/processload.js"></script> --}}
    <script type="text/javascript" src="{{ asset('/') }}./js/detail_kontainer.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>

    <script>
        $(document).ready(function() {
            $('input, select, .date_activity').blur(function() {
                var $txt = $(this).val();
                $(this).attr('data-bs-original-title', $txt);
            })
        })
    </script>
@endsection
