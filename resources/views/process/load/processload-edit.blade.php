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
                            <table id="processload_create" name="processload_create"
                                class="table autosize table-responsive table-bordered mb-0 tabel-fiks">
                                <thead class="table-success text-nowrap">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Size Kontainer</th>
                                        <th class="text-center">Type Kontainer</th>
                                        <th class="text-center">Nomor Kontainer</th>
                                        <th class="text-center">Cargo (Nama Barang)</th>
                                        <th class="text-center">Detail Nama Barang</th>
                                        <th class="text-center">Seal-Container</th>
                                        <th class="text-center">Tanggal Kegiatan</th>
                                        <th class="text-center">Lokasi Pickup</th>
                                        <th class="text-center">Nama Driver</th>
                                        <th class="text-center">Nomor Polisi</th>
                                        <th class="text-center">Remark</th>
                                        <th class="text-center">Biaya Stuffing</th>
                                        <th class="text-center">Biaya Trucking</th>
                                        <th class="text-center">Ongkos Supir</th>
                                        <th class="text-center">Biaya THC</th>
                                        <th class="text-center">Jenis Mobil (Sewa/Sendiri)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="tbody_container">
                                    @foreach ($containers as $container)
                                        @if (count($containers) == 1)
                                        <tr>
                                            <td><button id="button_kontainer[{{ $loop->iteration }}]"
                                                    name="button_kontainer[{{ $loop->iteration }}]"
                                                    class="btn btn-label-danger btn-icon btn-circle btn-sm"
                                                    type="button" onclick="delete_kontainer(this)" disabled @readonly(true)><i
                                                        class="fa fa-trash"></i></button></td>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <select data-bs-toggle="tooltip" id="seal[{{ $loop->iteration }}]"
                                                    name="seal[{{ $loop->iteration }}]" class="form-select" disabled @readonly(true)>
                                                    <option disabled>Pilih Size</option>
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->size_container }}" @if ($container->size == $size->size_container) selected @endif>
                                                            {{ $size->size_container }}</option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <select data-bs-toggle="tooltip" id="seal[{{ $loop->iteration }}]"
                                                    name="seal[{{ $loop->iteration }}]" class="form-select" disabled @readonly(true)>
                                                    <option disabled>Pilih Lokasi</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->type_container }}" @if ($container->type == $type->type_container) selected @endif>
                                                            {{ $type->type_container }}</option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control nomor_kontainer"
                                                        id="nomor_kontainer[{{ $loop->iteration }}]" minlength="11"
                                                        name="nomor_kontainer[{{ $loop->iteration }}]"
                                                        onblur="blur_no_container(this)" required placeholder="XXXX0000000" onkeypress="char(this, event)" onkeydown="no_paste(event)" onkeyup="uppercase(this)" value="{{ old('nomor_kontainer', $container->nomor_kontainer) }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    {{-- <label disabled @readonly(true)
                                            id="cargo[{{ $loop->iteration }}]">{{ old('cargo', $container->cargo) }} </label> --}}
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="cargo[{{ $loop->iteration }}]"
                                                        name="cargo[{{ $loop->iteration }}]"
                                                        value="{{ old('cargo', $container->cargo) }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <textarea data-bs-toggle="tooltip" class="form-control" id="detail_barang[{{ $loop->iteration }}]"
                                                        name="detail_barang[{{ $loop->iteration }}]">{{ old('detail_barang', $container->detail_barang) }}</textarea>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip" id="seal[{{ $loop->iteration }}]"
                                                        name="seal[{{ $loop->iteration }}]" class="form-select seals"
                                                        onchange="change_container(this)">
                                                        <option selected disabled>Pilih Seal</option>
                                                        @foreach ($seals as $seal)
                                                            <option value="{{ $seal->kode_seal }}" @if ($container->seal == $seal->kode_seal) selected @endif>
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
                                                        name="date_activity[{{ $loop->iteration }}]"
                                                        placeholder="Date..." value="{{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}" required>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip"
                                                        id="lokasi[{{ $loop->iteration }}]"
                                                        name="lokasi[{{ $loop->iteration }}]"
                                                        class="form-select lokasi-pickup" required>
                                                        <option selected disabled>Pilih Lokasi</option>
                                                        @foreach ($lokasis as $lokasi)
                                                            <option value="{{ $lokasi->nama_depo }}" @if ($container->lokasi_depo == $lokasi->nama_depo) selected @endif>
                                                                {{ $lokasi->nama_depo }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control" id="driver[{{ $loop->iteration }}]"
                                                        name="driver[{{ $loop->iteration }}]" placeholder="Driver..."
                                                        value="{{ old('driver', $container->driver) }}" required>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control"
                                                        id="nomor_polisi[{{ $loop->iteration }}]"
                                                        name="nomor_polisi[{{ $loop->iteration }}]"
                                                        placeholder="No Polisi..." value="{{ old('nomor_polisi', $container->nomor_polisi) }}"  required>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control" id="remark[{{ $loop->iteration }}]"
                                                        name="remark[{{ $loop->iteration }}]" value="{{ old('remark', $container->remark) }}" placeholder="Remark..."
                                                        required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control"
                                                        id="biaya_stuffing[{{ $loop->iteration }}]"
                                                        name="biaya_stuffing[{{ $loop->iteration }}]"
                                                        placeholder="Biaya Stuffing..." value="@rupiah2(old('biaya_stuffing', $container->biaya_stuffing))" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control"
                                                        id="biaya_trucking[{{ $loop->iteration }}]"
                                                        name="biaya_trucking[{{ $loop->iteration }}]"
                                                        placeholder="Biaya Trucking..." value="@rupiah2(old('biaya_trucking', $container->biaya_trucking))" required>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control"
                                                        id="ongkos_supir[{{ $loop->iteration }}]"
                                                        name="ongkos_supir[{{ $loop->iteration }}]"
                                                        placeholder="Ongkos Supir..." value="@rupiah2(old('ongkos_supir', $container->ongkos_supir))" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="biaya_thc[{{ $loop->iteration }}]"
                                                        name="biaya_thc[{{ $loop->iteration }}]"
                                                        placeholder="Biaya THC..." value="@rupiah2(old('biaya_thc', $container->biaya_thc))" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip"
                                                        id="jenis_mobil[{{ $loop->iteration }}]"
                                                        name="jenis_mobil[{{ $loop->iteration }}]"
                                                        class="form-select" required>
                                                        <option value="0">Pilih Jenis Mobil</option>
                                                        <option value="Mobil Sewa" @if ($container->jenis_mobil == "Mobil Sewa") selected @endif>Mobil Sewa</option>
                                                        <option value="Mobil Sendiri" @if ($container->jenis_mobil == "Mobil Sendiri") selected @endif>Mobil Sendiri</option>

                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td><button id="button_kontainer[{{ $loop->iteration }}]"
                                                    name="button_kontainer[{{ $loop->iteration }}]"
                                                    class="btn btn-label-danger btn-icon btn-circle btn-sm"
                                                    type="button" onclick="delete_kontainer(this)"><i
                                                        class="fa fa-trash"></i></button></td>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <label disabled @readonly(true)
                                                    id="size[{{ $loop->iteration }}]">{{ old('size', $container->size) }}
                                                </label>

                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="type[{{ $loop->iteration }}]">{{ old('type', $container->type) }}</label>

                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control nomor_kontainer"
                                                        id="nomor_kontainer[{{ $loop->iteration }}]" minlength="11"
                                                        name="nomor_kontainer[{{ $loop->iteration }}]"
                                                        onblur="blur_no_container(this)" required placeholder="XXXX0000000" onkeypress="char(this, event)" onkeydown="no_paste(event)" onkeyup="uppercase(this)" value="{{ old('nomor_kontainer', $container->nomor_kontainer) }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    {{-- <label disabled @readonly(true)
                                            id="cargo[{{ $loop->iteration }}]">{{ old('cargo', $container->cargo) }} </label> --}}
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="cargo[{{ $loop->iteration }}]"
                                                        name="cargo[{{ $loop->iteration }}]"
                                                        value="{{ old('cargo', $container->cargo) }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <textarea data-bs-toggle="tooltip" class="form-control" id="detail_barang[{{ $loop->iteration }}]"
                                                        name="detail_barang[{{ $loop->iteration }}]">{{ old('detail_barang', $container->detail_barang) }}</textarea>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip" id="seal[{{ $loop->iteration }}]"
                                                        name="seal[{{ $loop->iteration }}]" class="form-select seals"
                                                        onchange="change_container(this)">
                                                        <option selected disabled>Pilih Seal</option>
                                                        @foreach ($seals as $seal)
                                                            <option value="{{ $seal->kode_seal }}" @if ($container->seal == $seal->kode_seal) selected @endif>
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
                                                        name="date_activity[{{ $loop->iteration }}]"
                                                        placeholder="Date..." value="{{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}" required>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip"
                                                        id="lokasi[{{ $loop->iteration }}]"
                                                        name="lokasi[{{ $loop->iteration }}]"
                                                        class="form-select lokasi-pickup" required>
                                                        <option selected disabled>Pilih Lokasi</option>
                                                        @foreach ($lokasis as $lokasi)
                                                            <option value="{{ $lokasi->nama_depo }}" @if ($container->lokasi_depo == $lokasi->nama_depo) selected @endif>
                                                                {{ $lokasi->nama_depo }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control" id="driver[{{ $loop->iteration }}]"
                                                        name="driver[{{ $loop->iteration }}]" placeholder="Driver..."
                                                        value="{{ old('driver', $container->driver) }}" required>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control"
                                                        id="nomor_polisi[{{ $loop->iteration }}]"
                                                        name="nomor_polisi[{{ $loop->iteration }}]"
                                                        placeholder="No Polisi..." value="{{ old('nomor_polisi', $container->nomor_polisi) }}"  required>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text"
                                                        class="form-control" id="remark[{{ $loop->iteration }}]"
                                                        name="remark[{{ $loop->iteration }}]" value="{{ old('remark', $container->remark) }}" placeholder="Remark..."
                                                        required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control"
                                                        id="biaya_stuffing[{{ $loop->iteration }}]"
                                                        name="biaya_stuffing[{{ $loop->iteration }}]"
                                                        placeholder="Biaya Stuffing..." value="@rupiah2(old('biaya_stuffing', $container->biaya_stuffing))" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control"
                                                        id="biaya_trucking[{{ $loop->iteration }}]"
                                                        name="biaya_trucking[{{ $loop->iteration }}]"
                                                        placeholder="Biaya Trucking..." value="@rupiah2(old('biaya_trucking', $container->biaya_trucking))" required>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control"
                                                        id="ongkos_supir[{{ $loop->iteration }}]"
                                                        name="ongkos_supir[{{ $loop->iteration }}]"
                                                        placeholder="Ongkos Supir..." value="@rupiah2(old('ongkos_supir', $container->ongkos_supir))" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="biaya_thc[{{ $loop->iteration }}]"
                                                        name="biaya_thc[{{ $loop->iteration }}]"
                                                        placeholder="Biaya THC..." value="@rupiah2(old('biaya_thc', $container->biaya_thc))" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip"
                                                        id="jenis_mobil[{{ $loop->iteration }}]"
                                                        name="jenis_mobil[{{ $loop->iteration }}]"
                                                        class="form-select" required>
                                                        <option value="0">Pilih Jenis Mobil</option>
                                                        <option value="Mobil Sewa" @if ($container->jenis_mobil == "Mobil Sewa") selected @endif>Mobil Sewa</option>
                                                        <option value="Mobil Sendiri" @if ($container->jenis_mobil == "Mobil Sendiri") selected @endif>Mobil Sendiri</option>

                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <!-- END Form -->

                        <div class="mb-5 mt-5">
                            <button id="add_kontainer" type="button" onclick="tambah_kontainer()"
                                class="btn btn-label-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>
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
                            <thead id="" class="table-success">
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
                            <label for="inputState" class="form-label"><b>ALIH KAPAL (JIKA ADA)</b></label>
                        </div>
                        <div class="table-responsive">

                            <table id="table_alih_kapal" class="table table-responsive mb-0 tabel-fiks">
                                <thead id="thead_alih" class="table-success text-nowrap">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Pilih Nomor Kontainer</th>
                                        <th class="text-center">Piih Pelayaran</th>
                                        <th class="text-center">Piih POT (Jika Ada)</th>
                                        <th class="text-center">Piih POD</th>
                                        <th class="text-center">vessel/Voyage</th>
                                        <th class="text-center">Kode vessel</th>
                                        <th class="text-center">Biaya Alih Kapal</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_alih" class="text-center">

                                </tbody>
                            </table>
                        </div>

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
            </div>

        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/processload.js"></script>
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
