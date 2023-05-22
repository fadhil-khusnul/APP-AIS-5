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
                            <a href="/truckingprocess" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-primary">Activity</span>
                            </a>
                            <a href="/truckingprocess" class="breadcrumb-item">
                                <span class="breadcrumb-text text-primary">Trucking</span>
                            </a>

                            <a href="/truckingprocess" class="breadcrumb-item">
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
                                    <td>Pengirim</td>
                                    <td>:</td>
                                    <td>{{ $planload->pengirim }}</td>
                                </tr>
                                <tr>
                                    <td>Penerima</td>
                                    <td>:</td>
                                    <td>{{ $planload->penerima }}</td>
                                </tr>
                                <tr>
                                    <td>Activity</td>
                                    <td>:</td>
                                    <td>{{ $planload->activity }}</td>
                                </tr>
                                <tr>
                                    <td>EMKL</td>
                                    <td>:</td>
                                    <td>{{ $planload->emkl }}</td>
                                </tr>

                            </table>

                        </div>

                        <div class="table-responsive">

                            <table id="processload_create" name="processload_create" class="table table-bordered mb-0 tabel-fiks">
                                <thead class="table-success text-nowrap">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Size - Type</th>
                                        <th class="text-center">Nomor Kontainer</th>
                                        <th class="text-center">Cargo (Nama Barang)</th>
                                        <th class="text-center">Detail Barang</th>
                                        <th class="text-center">Seal-Container</th>
                                        <th class="text-center">Tanggal kegiatan</th>
                                        <th class="text-center">Lokasi Pickup</th>
                                        <th class="text-center">Lokasi Tujuan</th>
                                        <th class="text-center">Mty To</th>
                                        <th class="text-center">Nama Driver</th>
                                        <th class="text-center">Nomor Polisi</th>
                                        <th class="text-center">Ongkos Supir</th>
                                        <th class="text-center">Remark Container (jika ada)</th>
                                        <th class="text-center">Jenis Mobil</th>
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
                                                        name="nomor_kontainer[{{ $loop->iteration }}]" minlength="11" onblur="blur_no_container(this)"  placeholder="XXXX0000000" onkeypress="char(this, event)" onkeydown="no_paste(event)" onkeyup="uppercase(this)" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="cargo[{{ $loop->iteration }}]"
                                                        name="cargo[{{ $loop->iteration }}]"
                                                        value="{{ old('cargo', $container->cargo) }}" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">

                                                    <textarea class="form-control" placeholder="Detail Barang..." name="detail_barang[{{$loop->iteration}}]" id="detail_barang[{{$loop->iteration}}]" required></textarea>

                                                </div>
                                            </td>

                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" placeholder="Seal Container..." type="text" class="form-control"
                                                    id="seal[{{ $loop->iteration }}]"
                                                    name="seal[{{ $loop->iteration }}]" required
                                                    >
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
                                                    <select data-bs-toggle="tooltip" id="lokasi_pickup[{{ $loop->iteration }}]"
                                                        name="lokasi_pickup[{{ $loop->iteration }}]"
                                                        class="form-select lokasi-pickup" required>
                                                        <option selected disabled>Pilih Lokasi Pickup</option>
                                                        @foreach ($lokasis as $lokasi)
                                                            <option value="{{ $lokasi->nama_depo }}">
                                                                {{ $lokasi->nama_depo }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip" id="lokasi_tujuan[{{ $loop->iteration }}]"
                                                        name="lokasi_tujuan[{{ $loop->iteration }}]"
                                                        class="form-select lokasi-pickup" required>
                                                        <option selected disabled>Pilih Lokasi Tujuan</option>
                                                        @foreach ($lokasis as $lokasi)
                                                            <option value="{{ $lokasi->nama_depo }}">
                                                                {{ $lokasi->nama_depo }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip" id="mty_to[{{ $loop->iteration }}]"
                                                        name="mty_to[{{ $loop->iteration }}]"
                                                        class="form-select lokasi-pickup" required>
                                                        <option selected disabled>Pilih MTY to</option>
                                                        @foreach ($lokasis as $lokasi)
                                                            <option value="{{ $lokasi->nama_depo }}">
                                                                {{ $lokasi->nama_depo }}</option>
                                                        @endforeach
                                                    </select>
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
                                                    <input data-bs-toggle="tooltip"
                                                        onkeydown="return numbersonly(this, event);"
                                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                                        class="form-control" id="ongkos_supir[{{ $loop->iteration }}]"
                                                        name="ongkos_supir[{{ $loop->iteration }}]"
                                                        placeholder="Ongkos Supir...">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="validation-container">
                                                    <input data-bs-toggle="tooltip" type="text" class="form-control"
                                                        id="remark[{{ $loop->iteration }}]"
                                                        name="remark[{{ $loop->iteration }}]" placeholder="Remark..."
                                                        >
                                                </div>
                                            </td>

                                            <td>
                                                <div class="validation-container">
                                                    <select data-bs-toggle="tooltip"
                                                        id="jenis_mobil[{{ $loop->iteration }}]"
                                                        name="jenis_mobil[{{ $loop->iteration }}]"
                                                        class="form-select" required>
                                                        <option selected disabled>Pilih Jenis Mobil</option>
                                                        <option value="Mobil Sewa">Mobil Sewa</option>
                                                        <option value="Mobil Sendiri">Mobil Sendiri</option>

                                                    </select>
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

                            </tbody>
                        </table>
                        <div class="mb-5 mt-5">
                            <button id="add_biaya" type="button" onclick="tambah_biaya()"
                                class="btn btn-label-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>

                        <!-- END Form -->
                        <div class="row row-cols-lg-auto px-5 g-5">

                            <div style="margin-left: auto; margin-right:0px; margin-top:20px;" class="margin-atas text-end">
                                <button type="submit" onclick="CreateJobProcessDischarge()"
                                class="btn btn-primary">Selesai</button>                            </div>


                        </div>
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>

        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/trucking-process.js"></script>
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
