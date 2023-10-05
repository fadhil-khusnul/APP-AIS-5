@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- BEGIN Portlet -->
            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="header-title">Report Vendor Truck</h3>
                    <i class="header-divider"></i>
                    <div class="header-wrap header-wrap-block justify-content-start">
                        <!-- BEGIN Breadcrumb -->

                        <div class="breadcrumb breadcrumb-transparent mb-0">
                            <a href="/report-vendor-load/{{$planload->slug}}" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-primary">Report Vendor</span>
                            </a>



                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>



        <form action="#" class="row row-cols-lg-12" id="valid_realisasi" name="valid_realisasi">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <div class="col-12">
                <div class="portlet">

                    <div class="portlet-body row">

                        <div class="col-md-12 text-center mb-5">
                            <h3 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center">Report-Vendor-Load {{ $planload->vessel }} ( {{ $planload->select_company }}
                                )</h3>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="col-12"  style="padding-left: 20px; padding-right: 20px">

                                <embed src="{{ asset('storage/report/'.$pdf->path.'.pdf') }}"
                                    type="application/pdf" width="100%" height="650px" />
                            </div>
                            <div class="col-auto text-center mt-3 mb-5">
                                <a type="button" href="#" onclick="GoBackWithRefresh();return false;"><i class="fa fa-arrow-left"></i> Back</a>

                            </div>

                        </div>







                        <!-- END Form -->


                    </div>
                    <!-- BEGIN Portlet -->

                    <!-- END Portlet -->
                </div>




                <!-- BEGIN Portlet -->

                <!-- END Portlet -->



        </form>
    </div>






    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('/') }}./js/processload.js"></script> --}}
    <script type="text/javascript" src="{{ asset('/') }}./js/create_si.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>


@endsection
