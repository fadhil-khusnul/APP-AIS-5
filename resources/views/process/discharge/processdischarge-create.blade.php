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
                                    <td width="45%">Nomor DO</td>
                                    <td width="5%">:</td>
                                    <td width="50%">{{ $planload->nomor_do }}</td>
                                </tr>
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
                                    <td>Pengirim</td>
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

                            <table id="processload-create" name="processload-create" class="table table-bordered mb-0">
                                <thead class="table-success text-nowrap">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Size - Type</th>
                                        <th class="text-center">Nomor Kontainer</th>
                                        <th class="text-center">Cargo (Nama Barang)</th>
                                        <th class="text-center">Seal-Container</th>
                                        <th class="text-center">Tanggal kegiatan</th>
                                        <th class="text-center">Lokasi Pickup</th>
                                        <th class="text-center">Lokasi Kembali MTY</th>
                                        <th class="text-center">Tanggal Kembali MTY</th>
                                        <th class="text-center">Nama Driver</th>
                                        <th class="text-center">Nomor Polisi</th>
                                        <th class="text-center">Remark</th>
                                        <th class="text-center">Jaminan Kontainer</th>
                                        <th class="text-center">Biaya Trucking</th>
                                        <th class="text-center">Ongkos Supir</th>
                                        <th class="text-center">Biaya THC</th>
                                        <th class="text-center">Biaya Demurrage</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="tbody_container">
                                    @foreach ($containers as $container)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <label disabled @readonly(true)
                                                    id="size[{{ $loop->iteration }}]">{{ old('size', $container->size) }}</label>
                                                -
                                                <label disabled @readonly(true)
                                                    id="type[{{ $loop->iteration }}]">{{ old('type', $container->type) }}</label>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control nomor_kontainer"
                                                        id="nomor_kontainer[{{ $loop->iteration }}]"
                                                        name="nomor_kontainer[{{ $loop->iteration }}]" onblur="blur_no_container_discharge(this)" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="cargo[{{ $loop->iteration }}]"
                                                        name="cargo[{{ $loop->iteration }}]"
                                                        value="{{ old('cargo', $container->cargo) }}">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip" id="seal[{{ $loop->iteration }}]"
                                                        name="seal[{{ $loop->iteration }}]" class="form-select seals"
                                                        onchange="change_container_discharge(this)">
                                                        <option selected disabled>Pilih Seal</option>
                                                        @foreach ($seals as $seal)
                                                            <option value="{{ $seal->kode_seal }}">
                                                                {{ $seal->kode_seal }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <input onblur="seal(this)" type="text" class="form-control typeahead seal_typehead" id="seals[{{$loop->iteration}}]" name="seals[{{$loop->iteration}}]" placeholder="Seal..." required> --}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control date_activity"
                                                        id="date_activity[{{ $loop->iteration }}]"
                                                        name="date_activity[{{ $loop->iteration }}]" placeholder="Date..."
                                                        required>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip" id="lokasi[{{ $loop->iteration }}]"
                                                        name="lokasi[{{ $loop->iteration }}]"
                                                        class="form-select lokasi-pickup" required>
                                                        <option selected disabled>Pilih Lokasi</option>
                                                        @foreach ($lokasis as $lokasi)
                                                            <option value="{{ $lokasi->nama_depo }}">
                                                                {{ $lokasi->nama_depo }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip" id="lokasi_kembali[{{ $loop->iteration }}]"
                                                        name="lokasi_kembali[{{ $loop->iteration }}]"
                                                        class="form-select lokasi-pickup" required>
                                                        <option selected disabled>Pilih Lokasi</option>
                                                        @foreach ($lokasis as $lokasi)
                                                            <option value="{{ $lokasi->nama_depo }}">
                                                                {{ $lokasi->nama_depo }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control date_activity"
                                                        id="tanggal_kembali[{{ $loop->iteration }}]"
                                                        name="tanggal_kembali[{{ $loop->iteration }}]" placeholder="Tanggal Kembali..."
                                                        required>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="driver[{{ $loop->iteration }}]"
                                                        name="driver[{{ $loop->iteration }}]" placeholder="Driver..."
                                                        required>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="nomor_polisi[{{ $loop->iteration }}]"
                                                        name="nomor_polisi[{{ $loop->iteration }}]"
                                                        placeholder="No Polisi..." required>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="remark[{{ $loop->iteration }}]"
                                                        name="remark[{{ $loop->iteration }}]" placeholder="Remark..."
                                                        required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="jaminan_kontainer[{{ $loop->iteration }}]"
                                                        name="jaminan_kontainer[{{ $loop->iteration }}]"
                                                        placeholder="Jaminan Kontainer..." required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="biaya_trucking[{{ $loop->iteration }}]"
                                                        name="biaya_trucking[{{ $loop->iteration }}]"
                                                        placeholder="Biaya Trucking..." required>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="ongkos_supir[{{ $loop->iteration }}]"
                                                        name="ongkos_supir[{{ $loop->iteration }}]"
                                                        placeholder="Ongkos Supir..." required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="biaya_thc[{{ $loop->iteration }}]"
                                                        name="biaya_thc[{{ $loop->iteration }}]"
                                                        placeholder="Biaya THC..." required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="biaya_demurrage[{{ $loop->iteration }}]"
                                                        name="biaya_demurrage[{{ $loop->iteration }}]"
                                                        placeholder="Biaya Demurrage..." required>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>




            <!-- BEGIN Portlet -->

            <!-- END Portlet -->

            <div class="col-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Biaya Lainnya (JIKA ADA)</b></label>
                        </div>

                        <table id="table_biaya" class="table mb-0">
                            <thead id="thead_biaya" class="table-success">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Pilih Nomor Kontainer</th>
                                    <th class="text-center">Biaya</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_biaya" class="text-center">
                                {{-- <tr>
                                        <td>1.</td>
                                        <td>
                                            <div class="validation-container">
                                                <select id="kontainer[1]" name="kontainer[1]" class="form-select">
                                                    <option selected disabled>Pilih Kontainer</option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control" id="harga[1]" name="harga[1]" placeholder="Harga">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <textarea name="keterangan[1]" id="keterangan[1]" class="form-control"></textarea>
                                            </div>
                                        </td>
                                    </tr> --}}
                            </tbody>
                        </table>
                        <div class="mb-5 mt-5">
                            <button id="add_biaya" type="button" onclick="tambah_biaya()"
                                class="btn btn-label-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>

                        <!-- END Form -->
                        <div class="col-12 text-end">
                            <button type="submit" onclick="UpdateteJobProcessDischarge()"
                                class="btn btn-primary">Proccess (Surat Jalan)</button>
                        </div>
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
            {{-- <div class="col-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>ALIH KAPAL (JIKA ADA)</b></label>
                        </div>

                        <table id="table_alih_kapal" class="table mb-0">
                            <thead id="thead_alih" class="table-success">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Pilih Nomor Kontainer</th>
                                    <th class="text-center">Biaya Alih Kapal</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_alih" class="text-center">

                            </tbody>
                        </table>
                        <div class="mb-5 mt-5">
                            <button id="add_biaya" type="button" onclick="tambah_alih()"
                                class="btn btn-label-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>
                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
            <div class="col-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>BATAL MUAT (JIKA ADA)</b></label>
                        </div>

                        <table id="table_batal_muat" class="table mb-0">
                            <thead id="thead_batal_muat" class="table-success">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Pilih Nomor Container</th>
                                    <th class="text-center">Biaya Batal Muat</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_batal_muat" class="text-center">

                            </tbody>
                        </table>
                        <div class="mb-5 mt-5">
                            <button id="add_biaya" type="button" onclick="tambah_batal_muat()"
                                class="btn btn-label-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" onclick="UpdateteJobProcessload()"
                                class="btn btn-primary">Proccess</button>
                        </div>

                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div> --}}

        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/discharge-process.js"></script>
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
