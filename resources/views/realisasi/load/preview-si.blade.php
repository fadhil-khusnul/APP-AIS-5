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
                            <a href="/realisasi-load-create/{{$planload->slug}}" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-danger fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-danger">Realisasi</span>
                            </a>
                            <a href="/realisasi-load-create/{{$planload->slug}}" class="breadcrumb-item">
                                <span class="breadcrumb-text text-danger">Realisasi-Load</span>
                            </a>

                            <a href="/realisasi-load-create/{{$planload->slug}}" class="breadcrumb-item">
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



        <form action="#" class="row row-cols-lg-12" id="valid_realisasi" name="valid_realisasi">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <div class="col-12">
                <div class="portlet">

                    <div class="portlet-body row">

                        <div class="col-md-12 text-center mb-5">
                            <h3 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center">SI-{{ $planload->vessel }} ( {{ $planload->select_company }}
                                )</h3>
                        </div>




                                <div class="col-md-12 mb-3">
                                    <div class="col-12"  style="padding-left: 20px; padding-right: 20px">
                                        @if ($pdf->status == "Disetujui")

                                        <embed src="{{ asset('storage/si-container/'.$pdf->path.'.pdf') }}"
                                        type="application/pdf" width="100%" height="650px" />

                                        @elseif ($pdf->status == "Ditolak")

                                        <embed src="{{ asset('storage/si-container/'.$pdf->path.'-ditolak.pdf') }}"
                                            type="application/pdf" width="100%" height="650px" />

                                        @else
                                        <embed src="{{ asset('storage/si-container/'.$pdf->path.'-progress.pdf') }}"
                                            type="application/pdf" width="100%" height="650px" />
                                        @endif
                                    </div>


                                    <div class="col-auto text-center mt-3 mb-5">
                                        {{-- <input type="hidden" id="container_id{{$loop->iteration}}" name="container_id" value="{{$pdf->container_id}}"> --}}
                                        <button type="button" value="{{$pdf->container_id}}" onclick="approve_si(this)" class="btn btn-success ">Approve SI <i
                                                class="fa fa-check"></i></button>
                                        <button type="button" value="{{$pdf->container_id}}" onclick="tolak_si(this)" class="btn btn-danger ">Tolak SI <i
                                                class="fa  fa-times"></i></button>

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
   


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('/') }}./js/processload.js"></script> --}}
    <script type="text/javascript" src="{{ asset('/') }}./js/create_si.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>


@endsection
