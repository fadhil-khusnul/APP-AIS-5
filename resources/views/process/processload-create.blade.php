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
                        <input type="hidden" name="old_slug" id="old_slug" value="{{$planload->slug}}">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="breadcrumb breadcrumb-transparent mb-0">
                            <a href="/processload" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text">Activity</span>
                            </a>
                            <a href="/processload" class="breadcrumb-item">
                                <span class="breadcrumb-text">Job Order Process</span>
                            </a>
                            <a href="/processload" class="breadcrumb-item">
                                <span class="breadcrumb-text">Load</span>
                            </a>

                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="portlet">

                <div class="portlet-body">

                    <!-- BEGIN Form -->
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="" class="form-label">Date</label>
                            <input disabled readonly type="text" class="form-control" placeholder="Select Date" id="tanggal_planload"
                                name="tanggal_planload" value="{{ old('tanggal_planload', $planload->tanggal_planload) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Activity</label>
                            <select disabled id="activity" name="activity" class="form-select">
                                <option selected disabled>Pilih Activity</option>
                                @foreach ($activity as $activity)
                                    <option value="{{ $activity->kegiatan_stuffing }}" @if ($activity->kegiatan_stuffing == $planload->activity) selected @endif>{{ $activity->kegiatan_stuffing }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="company" class="form-label">Shipping Company</label>
                                <select disabled id="select_company" name="select_company" class="form-select">
                                    <option selected disabled>Pilih Company</option>
                                    @foreach ($shippingcompany as $shippingcompany)
                                        <option value="{{ $shippingcompany->nama_company }}" @if ($shippingcompany->nama_company == $planload->select_company) selected @endif>{{ $shippingcompany->nama_company }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress2" class="form-label">Vessel/Voyage</label>
                            <textarea disabled name="vessel" id="vessel" class="form-control" >{{ old('vessel', $planload->vessel) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">POL</label>
                                <select disabled id="POL_1" name="POL_1" class="form-select">
                                    <option selected disabled>Pilih POL</option>
                                    @foreach ($pol as $pol)
                                        <option value="{{ $pol->nama_pelabuhan }}" @if ($pol->nama_pelabuhan == $planload->pol) selected @endif>{{ $pol->area_code }} - {{ $pol->nama_pelabuhan }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">POT</label>
                            <select disabled id="POT_1" name="POT_1" class="form-select">
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pot as $pot)
                                    <option value="{{ $pot->nama_pelabuhan }}" @if ($pot->nama_pelabuhan == $planload->pot) selected @endif>{{ $pot->area_code }} - {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">POD</label>
                                <select disabled id="POD_1" name="POD_1" class="form-select">
                                    <option selected disabled>Pilih POD</option>
                                    @foreach ($pod as $pod)
                                        <option value="{{ $pod->nama_pelabuhan }}" @if ($pod->nama_pelabuhan == $planload->pod) selected @endif>{{ $pod->area_code }} -
                                            {{ $pod->nama_pelabuhan }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">Pengirim</label>
                                <select disabled id="Pengirim_1" name="Pengirim_1" class="form-select">
                                    <option selected disabled>Pilih Pengirim</option>
                                    @foreach ($pengirim as $pengirim)
                                        <option value="{{ $pengirim->nama_costumer }}" @if ($pengirim->nama_costumer == $planload->pengirim) selected @endif>{{ $pengirim->nama_costumer }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">Penerima</label>
                            <select disabled id="Penerima_1" name="Penerima_1" class="form-select">
                                <option selected disabled>Pilih Penerima</option>
                                @foreach ($penerima as $penerima)
                                    <option value="{{ $penerima->nama_penerima }}" @if ($penerima->nama_penerima == $planload->penerima) selected @endif>{{ $penerima->nama_penerima }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
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
                    <form class="row g-3">

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Jumlah Kontainer :</b></label>
                        </div>
                        <div class="table-responsive width-auto">

                            <table id="processload-create" name="processload-create" class="table mb-0 table-responsive" >
                                <thead class="table-success">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Kontainer</th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Seal</th>
                                        <th class="text-center">Date Activity</th>
                                        <th class="text-center">Cargo</th>
                                        <th class="text-center">Lokasi Pickup</th>
                                        <th class="text-center">Driver</th>
                                        <th class="text-center">No Polisi</th>
                                        <th class="text-center">Remark</th>
                                        <th class="text-center">Biaya Stuffing</th>
                                        <th class="text-center">Biaya Trucking</th>
                                        <th class="text-center">Ongkos Supir</th>
                                        <th class="text-center">Biaya THC</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="tbody_container">
                                    @foreach ($containers as $container)

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <div class="validation-container">
                                                <select disabled id="kontainer[{{$loop->iteration}}]" name="kontainer" class="form-select"
                                                    onchange="change_container(this)" required>
                                                    <option selected disabled>Pilih Kontainer</option>
                                                    @foreach ($kontainers as $kontainer)
                                                        <option value="{{$kontainer->id}}" @if ($kontainer->id == $container->kontainer) selected @endif>
                                                            {{ $kontainer->jenis_container }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <label disabled @readonly(true) id="size[{{$loop->iteration}}]">{{ old('size', $container->size) }}</label>
                                        </td>
                                        <td>
                                            <label disabled @readonly(true) id="type[{{$loop->iteration}}]">{{ old('type', $container->type) }}</label>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control typeahead seal_typehead" id="seals[{{$loop->iteration}}]" name="seals[{{$loop->iteration}}]" placeholder="Seal...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control date_activity" id="date_activity[{{$loop->iteration}}]" name="date_activity[{{$loop->iteration}}]" placeholder="Date...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control" id="cargo[{{$loop->iteration}}]" name="cargo[{{$loop->iteration}}]" placeholder="Cargo...">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="validation-container">
                                                <select  id="lokasi[{{$loop->iteration}}]" name="lokasi[{{$loop->iteration}}]" class="form-select"
                                                    onchange="change_container(this)" required>
                                                    <option selected disabled>Pilih Lokasi</option>
                                                    @foreach ($lokasis as $lokasi)
                                                        <option value="{{$lokasi->id}}">
                                                            {{ $lokasi->nama_depo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>


                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control" id="driver[{{$loop->iteration}}]" name="driver[{{$loop->iteration}}]" placeholder="Driver...">

                                            </div>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control" id="nomor_polisi[{{$loop->iteration}}]" name="nomor_polisi[{{$loop->iteration}}]" placeholder="No Polisi...">

                                            </div>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control" id="remark[{{$loop->iteration}}]" name="remark[{{$loop->iteration}}]" placeholder="Remark...">

                                            </div>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control" id="biaya_stuffing[{{$loop->iteration}}]" name="biaya_stuffing[{{$loop->iteration}}]" placeholder="Biaya Stuffing...">

                                            </div>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control" id="biaya_trucking[{{$loop->iteration}}]" name="biaya_trucking[{{$loop->iteration}}]" placeholder="Biaya Trucking...">

                                            </div>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control" id="ongkos_supir[{{$loop->iteration}}]" name="ongkos_supir[{{$loop->iteration}}]" placeholder="Ongkos Supir...">

                                            </div>
                                        </td>
                                        <td>
                                            <div class="validation-container">
                                                <input type="text" class="form-control" id="biaya_thc[{{$loop->iteration}}]" name="biaya_thc[{{$loop->iteration}}]" placeholder="Biaya THC...">
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>

                    </form>
                    <!-- END Form -->
                </div>
            </div>
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>


        <div class="col-12">
            <!-- BEGIN Portlet -->
            <div class="portlet">
                <div class="portlet-header portlet-header-bordered text-center">
                    <h3 class="portlet-title text-center">#JOB ORDER NUMBER (1111)</h3>

                </div>
            </div>
        </div>


        {{-- <div class="col-md-6">
            <div class="portlet">

                <div class="portlet-body">

                    <!-- BEGIN Form -->
                    <form class="row g-3">

                        <div class="col-md-6">
                            <label for="" class="form-label">Seal</label>
                            <select id="activity" class="form-select">
                                <option selected disabled>Pilih Seal</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Date Activity</label>
                            <input type="text" class="form-control" placeholder="Select Date" id="datepicker-3">
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Cargo</label>
                            <input class="form-control" id="touch-cargo" type="text" value="55">
                        </div>

                        <div class="col-md-6">
                            <label for="POL" class="form-label">Lokasi Pickup</label>
                            <select class="form-select" id="pickup-lokasi">
                                <option value="AK" selected disabled>Pilih Lokasi</option>
                                <option value="HI">Hawaii</option>
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Driver</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">No. Polisi</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Remark</label>
                            <textarea name="" id="process-remark" class="form-control"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Biaya Stuffing</label>
                            <input class="form-control" id="touch-stuffing" type="text" value="55">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Biaya Trucking</label>
                            <input class="form-control" id="touch-trucking" type="text" value="55">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Pengongkosan Supir</label>
                            <input class="form-control" id="touch-supir" type="text" value="55">
                        </div>



                    </form>
                    <!-- END Form -->
                </div>
            </div> --}}
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>

        <div class="col-md-12">
            <div class="portlet">

                <div class="portlet-body">

                    <!-- BEGIN Form -->
                    <form class="row g-3">

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Biaya Lainnya :</b></label>
                        </div>

                        <table id="table_biaya" class="table mb-0">
                            <thead id="thead_biaya" class="table-success">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Jenis Kontainer</th>
                                    <th class="text-center">Biaya</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">A</th>
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
                        <div class="">
                            <button id="add_biaya" type="button" onclick="tambah_biaya()" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" onclick="UpdateteJobProcessload()"" class="btn btn-primary">Proccess</button>
                        </div>
                    </form>
                    <!-- END Form -->
                </div>
            </div>
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/processload.js"></script>

@endsection
