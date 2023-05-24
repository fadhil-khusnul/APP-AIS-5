@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="portlet">
                <div class="portlet-body">
                    <!-- BEGIN Widget -->
                    <div class="widget8">
                        <div class="widget8-content">
                            <!-- BEGIN Avatar -->
                            <div class="avatar avatar-label-success avatar-circle widget8-avatar">
                                <div class="avatar-display">
                                    <i class="fa fa-list-ul"></i>
                                </div>
                            </div>
                            <!-- END Avatar -->
                            <h4 class="widget8-highlight">{{count($tersedia)}}</h4>
                            <h6 class="widget8-title">SPK Tersedia</h6>

                        </div>
                    </div>
                    <!-- END Widget -->
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="portlet">
                <div class="portlet-body">
                    <!-- BEGIN Widget -->
                    <div class="widget8">
                        <div class="widget8-content">
                            <!-- BEGIN Avatar -->
                            <div class="avatar avatar-label-info avatar-circle widget8-avatar">
                                <div class="avatar-display mt-1">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                            </div>
                            <!-- END Avatar -->
                            <h4 class="widget8-highlight">{{count($container)}}</h4>
                            <h6 class="widget8-title">SPK Terpakai</h6>
                        </div>
                    </div>
                    <!-- END Widget -->
                </div>
            </div>

        </div>


        <div class="col-md-6 col-xl-12">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">Tabel {{ $title }}</h3>
                </div>
                <div class="portlet-body">
                    <hr>
                    <!-- BEGIN Datatable -->
                    <table id="input-seal" class="table table-bordered table-striped table-hover autosize">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status SPK</th>
                                <th>Kode SPK</th>
                                <th>Nomor Kontainer</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spks as $spk)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="align-middle text-nowrap">
                                        @if ($spk->status == 'input')
                                        <i class="marker marker-dot text-success"></i>
                                            Available
                                        @endif



                                        @if ($spk->status == 'Container')
                                        <i class="marker marker-dot text-info"></i>
                                           Used
                                        @endif
                                    </td>
                                    <td>
                                        {{ $spk->kode_spk }}
                                    </td>
                                    @if ($spk->status === "Container")
                                    <td> {{$spk->container_planloads->nomor_kontainer}}
                                    </td>
                                    @else
                                    <td>-</td>
                                    @endif



                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- END Datatable -->
                </div>
            </div>

            <!-- END Portlet -->
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/spk.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>
@endsection
