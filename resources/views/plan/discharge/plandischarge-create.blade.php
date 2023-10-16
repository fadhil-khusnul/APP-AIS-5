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
                            <a href="/plandischarge" class="breadcrumb-item text-primary">
                                <div class="breadcrumb-icon">
                                    <i class="fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text">Activity</span>
                            </a>
                            <a href="/plandischarge" class="breadcrumb-item text-primary">
                                <span class="breadcrumb-text">Load</span>
                            </a>
                            <a href="/plandischarge" class="breadcrumb-item text-warning">
                                <span class="breadcrumb-text">Plan</span>
                            </a>

                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
        <form class="row row-cols-lg-12 g-3" id="valid_planload" name="valid_planload">
            <div class=" col-md-4">
                <div class="portlet">

                    <div class="portlet-body row">
                        <!-- BEGIN Form -->

                           
                            <div class=" row mb-3">
                                <label for="inputAddress2" class="col-sm-4 col-form-label">Nomor DO</label>
            
                                <div class="col-sm-8 validation-container">
                                    <input name="nomor_do" id="nomor_do" class="form-control">
                                </div>
                            </div>
                            <div class=" row mb-3">
                            <label for="inputAddress2" class="col-sm-4 col-form-label">Tanggal Tiba Kapal</label>
                            <div class="col-sm-8 validation-container">
                                <input name="tanggal_tiba" id="tanggal_tiba" class="form-control">
                            </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputAddress2" class="col-sm-4 form-label">Jumlah Free Time</label>
                                <div class="col-sm-8 validation-container">
                                    <input required name="tanggal_free" id="tanggal_free" value="0" class="form-control"
                                        onblur="tambah_free_time()">
                                </div>
                            </div>
                            <div class="row mb-3">
    
                                <label for="inputAddress2" class="col-sm-4 form-label">Total Tanggal Hari Free</label>
                                <div class="col-sm-8 validation-container">
                                    <input required readonly name="total_hari" id="total_hari" class="form-control"
                                        value="">
                                </div>
                            </div>

                            <div class=" row mb-3">
                            <label for="inputAddress2" class="col-sm-4 col-form-label">Vessel/Voyage</label>
                            <div class="col-sm-8 validation-container">
                                <input name="vessel" id="vessel" class="form-control">
                            </div>
                            </div>

                            <div class=" row mb-3">

                            <label for="inputAddress2" class="col-sm-4 col-form-label">Vessel Code</label>
                            <div class="col-sm-8 validation-container">
                                <input name="vessel_code" id="vessel_code" class="form-control">
                            </div>
                            </div>

                            <div class=" row mb-3">
                            <label for="company" class="col-sm-4 col-form-label">Shipping Company</label>
                            <div class="col-sm-8 validation-container">
                                <select id="select_company" name="select_company" class="form-select">
                                    <option selected disabled>Pilih Company</option>
                                    @foreach ($shippingcompany as $shippingcompany)
                                        <option value="{{ $shippingcompany->nama_company }}">{{ $shippingcompany->nama_company }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>

                            <div class=" row mb-3">

                            <label for="POL" class="col-sm-4 col-form-label">Pengirim</label>
                            <div class="col-sm-8 validation-container">
                                <select id="Pengirim_1" name="Pengirim_1" class="form-select">
                                    <option selected disabled value="0">Pilih Pengirim</option>
                                    @foreach ($pengirim as $pengirim)
                                        <option value="{{ $pengirim->nama_costumer }}">{{ $pengirim->nama_costumer }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>

                            <div class=" row mb-3">
                            <label for="POL" class="col-sm-4 col-form-label">Penerima</label>
                            <div class="col-sm-8 validation-container">
                                <select id="penerima_1" name="penerima_1" class="form-select">
                                    <option selected disabled value="0">Pilih Penerima</option>
                                    @foreach ($penerima as $penerima)
                                        <option value="{{ $penerima->nama_penerima }}">{{ $penerima->nama_penerima }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>

                            <div class=" row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Activity</label>
                            <div class="col-sm-8 validation-container">
                                <select id="activity" name="activity" class="form-select">
                                    <option selected disabled value="0">Pilih Activity</option>
                                    @foreach ($activity as $activity)
                                        <option value="{{ $activity->kegiatan}}">{{ $activity->kegiatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class=" row mb-3">
                            <label for="POL" class="col-sm-4 col-form-label">POL</label>
                            <div class="col-sm-8 validation-container">
                                <select id="POL_1" name="POL_1" class="form-select">
                                    <option selected disabled value="0">Pilih POL</option>
                                    @foreach ($pol as $pol)
                                        <option value="{{ $pol->nama_pelabuhan }}">{{ $pol->area_code }} - {{ $pol->nama_pelabuhan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class=" row mb-3">

                            <label for="POL" class="col-sm-4 col-form-label">POD</label>
                            <div class="col-sm-8 validation-container">
                                <select id="POD_1" name="POD_1" class="form-select">
                                    <option selected disabled value="0">Pilih POD</option>
                                    @foreach ($pod as $pod)
                                        <option value="{{ $pod->nama_pelabuhan }}">{{ $pod->area_code }} -
                                            {{ $pod->nama_pelabuhan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>

                            <div class="col-12 text-center">
                                {{-- <button onclick="CreateJobPlanload()" class="btn btn-primary">Proccess</button> --}}
                                <button type="submit"  onclick="CreateJobPlanDischarge()"
                                    class="btn btn-success">Simpan <i class="fa fa-save"></i></button>
                            </div>



                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>

            <div class="col-md-8 ">
                <div class="portlet">

                    <div class="portlet-body">
                        {{-- <form action="#" class="row g-3" id="valid_planload" name="valid_planload"></form> --}}

                        <!-- BEGIN Form -->
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Detail Kontainer :</b></label>
                        </div>

                        <table class="table mb-0 seratus" id="table_container">
                            <thead class="table-warning " id="thead_container">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Nomor Kontainer</th>
                                    <th class="text-center">Seal Kontainer</th>
                                    <th class="text-center">Nama Barang (CARGO)</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="tbody_container">

                            </tbody>
                        </table>
                        <div class="mt-5 mb-5 text-center">
                            <button disabled type="button"
                                class="btn btn-success btn-icon"><i class="fa fa-plus"></i></button>
                        </div>



                        {{-- <div class="col-12 text-end">
                            <button type="submit" onclick="ToProcess()"
                                class="btn btn-success">ke Proses <i class="fa fa-arrow-right"></i></button>
                        </div> --}}
                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
          
        </form>


    </div>

   
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/discharge-plan.js"></script>

@endsection
