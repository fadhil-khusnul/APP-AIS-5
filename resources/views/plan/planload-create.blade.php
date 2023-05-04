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
                        {{-- <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}"> --}}
                        <div class="breadcrumb breadcrumb-transparent mb-0">
                            <a href="/planload" class="breadcrumb-item text-primary">
                                <div class="breadcrumb-icon">
                                    <i class="fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text">Activity</span>
                            </a>
                            <a href="/planload" class="breadcrumb-item text-primary">
                                <span class="breadcrumb-text">Load</span>
                            </a>
                            <a href="/planload" class="breadcrumb-item text-warning">
                                <span class="breadcrumb-text">Plan</span>
                            </a>

                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
        <form class="row row-cols-lg-12 g-3" id="valid_planload" name="valid_planload">
            <div class=" col-md-6">
                <div class="portlet">

                    <div class="portlet-body row">
                        <!-- BEGIN Form -->

                            {{-- <div class="col-md-6 validation-container">
                                <label for="" class="form-label">Date</label>
                                <input type="text" class="form-control data-date-end-date="0d"" placeholder="Select Date" id="tanggal_planload"
                                    name="tanggal_planload">
                            </div> --}}

                            <div class="col-md-6 validation-container">
                                <label for="inputAddress2" class="form-label">Vessel/Voyage</label>
                                <input name="vessel" id="vessel" class="form-control">
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="inputAddress2" class="form-label">Vessel Code</label>
                                <input name="vessel_code" id="vessel_code" class="form-control">
                            </div>


                            <div class="col-md-6 validation-container">
                                <label for="company" class="form-label">Shipping Company</label>
                                <select id="select_company" name="select_company" class="form-select">
                                    <option selected disabled>Pilih Company</option>
                                    @foreach ($shippingcompany as $shippingcompany)
                                        <option value="{{ $shippingcompany->nama_company }}">{{ $shippingcompany->nama_company }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 validation-container">
                                <label for="POL" class="form-label">Pengirim</label>
                                <select id="Pengirim_1" name="Pengirim_1" class="form-select">
                                    <option selected disabled>Pilih Pengirim</option>
                                    @foreach ($pengirim as $pengirim)
                                        <option value="{{ $pengirim->nama_costumer }}">{{ $pengirim->nama_costumer }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 validation-container">
                                <label for="" class="form-label">Activity</label>
                                <select id="activity" name="activity" class="form-select">
                                    <option selected disabled>Pilih Activity</option>
                                    @foreach ($activity as $activity)
                                        <option value="{{ $activity->kegiatan_stuffing }}">{{ $activity->kegiatan_stuffing }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="POL" class="form-label">POL</label>
                                <select id="POL_1" name="POL_1" class="form-select">
                                    <option selected disabled>Pilih POL</option>
                                    @foreach ($pol as $pol)
                                        <option value="{{ $pol->nama_pelabuhan }}">{{ $pol->area_code }} - {{ $pol->nama_pelabuhan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="POL" class="form-label">POT</label>
                                <select id="POT_1" name="POT_1" class="form-select">
                                    <option selected disabled>Pilih POT</option>
                                    @foreach ($pot as $pot)
                                        <option value="{{ $pot->nama_pelabuhan }}">{{ $pot->area_code }} - {{ $pot->nama_pelabuhan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="POL" class="form-label">POD</label>
                                <select id="POD_1" name="POD_1" class="form-select">
                                    <option selected disabled>Pilih POD</option>
                                    @foreach ($pod as $pod)
                                        <option value="{{ $pod->nama_pelabuhan }}">{{ $pod->area_code }} -
                                            {{ $pod->nama_pelabuhan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="col-md-6 validation-container">
                                <label for="POL" class="form-label">Penerima</label>
                                <select id="Penerima_1" name="Penerima_1" class="form-select">
                                    <option selected disabled>Pilih Penerima</option>
                                    @foreach ($penerima as $penerima)
                                        <option value="{{ $penerima->nama_penerima }}">{{ $penerima->nama_penerima }}</option>
                                    @endforeach
                                </select>
                            </div> --}}


                        <!-- END Form -->

                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
            <div class="col-md-6 ">
                <div class="portlet">

                    <div class="portlet-body">
                        {{-- <form action="#" class="row g-3" id="valid_planload" name="valid_planload"></form> --}}

                        <!-- BEGIN Form -->
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Jumlah Kontainer :</b></label>
                        </div>

                        <table class="table mb-0" id="table_container">
                            <thead class="table-warning" id="thead_container">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Jumlah Kontainer</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Nama Barang (CARGO)</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="tbody_container">

                            </tbody>
                        </table>
                        <div class="mt-5 mb-5">
                            <button id="add_container" onclick="tambah_kontener()" type="button"
                                class="btn btn-label-primary btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>



                        <div class="col-12 text-end">
                            {{-- <button onclick="CreateJobPlanload()" class="btn btn-primary">Proccess</button> --}}
                            <button type="submit" onclick="CreateJobPlanload()"
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/planload.js"></script>
@endsection
