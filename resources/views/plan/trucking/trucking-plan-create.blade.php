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
            <div class=" col-md-6">
                <div class="portlet">

                    <div class="portlet-body row">
                        <!-- BEGIN Form -->

                            {{-- <div class="col-md-6 validation-container">
                                <label for="" class="form-label">Date</label>
                                <input type="text" class="form-control data-date-end-date="0d"" placeholder="Select Date" id="tanggal_planload"
                                    name="tanggal_planload">
                            </div> --}}

                            <div class="col-md-12 validation-container">
                                <label for="inputAddress2" class="form-label">Pelayaran :</label>
                                <input name="pelayaran" id="pelayaran" class="form-control">
                            </div>

                            <div class="col-md-6 validation-container">
                                <label for="inputAddress2" class="form-label">Vessel/Voyage :</label>
                                <input name="vessel" id="vessel" class="form-control">
                            </div>

                            <div class="col-md-6 validation-container">
                                <label for="inputAddress2" class="form-label">Vessel Code :</label>
                                <input name="vessel_code" id="vessel_code" class="form-control">
                            </div>




                            <div class="col-md-6 validation-container">
                                <label for="" class="form-label">Activity :</label>
                                <select id="activity" name="activity" class="form-select">
                                    <option selected disabled value="0">Pilih Activity</option>
                                    @foreach ($activity as $activity)
                                    <option value="{{ $activity->kegiatan}}">{{ $activity->kegiatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6 validation-container">
                                <label for="inputAddress2" class="form-label">EMKL :</label>
                                <input name="emkl" id="emkl" class="form-control">
                            </div>




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
                            <label for="inputState" class="form-label"><b>Detail Kontainer :</b></label>
                        </div>

                        <table class="table mb-0" id="table_container">
                            <thead class="table-warning" id="thead_container">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Jumlah Kontainer</th>
                                    <th></th>
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
                            <button type="submit" onclick="CreateJobPlanDischarge()"
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
    <script type="text/javascript" src="{{ asset('/') }}./js/trucking-plan.js"></script>
@endsection
