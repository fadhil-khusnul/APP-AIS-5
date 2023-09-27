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


        <div class="col-md-12 col-xl-12">

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
                                <th>Nama Shipping Company (Pelayaran)</th>
                                <th>Kode SPK</th>
                                <th>Nomor Kontainer</th>
                                <th class="text-wrap">Keterangan SPK</th>

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
                                        {{ $spk->pelabuhans->nama_company }}
                                    </td>
                                    <td>
                                        {{ $spk->kode_spk }}
                                    </td>
                                    <td> @if ($spk->status == "Container")
                                        {{$spk->container_planloads->nomor_kontainer}}
                                        {{-- @foreach ($spksc as $c)
                                            @if ($c->spk_kontainer === $spk->kode_spk)
                                            @endif
                                        @endforeach--}}
                                    @else
                                    -
                                    @endif

                                    </td>
                                    <td>
                                        {{ $spk->keterangan_spk }}
                                        <div class="text-end">
                                            <button onclick="tambah_keterangan(this)" value="{{ $spk->id }}"
                                                class="btn btn-label-primary btn-icon"><i
                                                    class="fa fa-pencil"></i></button>

                                        </div>


                                    </td>



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

    <div class="modal fade" id="modal-spk-edit">
        <div class="modal-dialog">
            <form action="#" name="valid_spk_edit" id="valid_spk_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="old_id_spk" id="old_id_spk">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Keterangan Data SPK</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <label for="company" class="col-sm-4 form-label">Pilih Shipping Company (Pelayaran)</label>
                        <div class="col-sm-8 validation-container">
                            <select disabled id="select_company_edit" name="select_company_edit" class="form-select">
                                <option selected disabled>Pilih Pelayaran</option>
                                @foreach ($pelayarans as $shippingcompany)
                                    <option value="{{ $shippingcompany->id }}">{{ $shippingcompany->nama_company }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">


                        <label class="col-sm-4 form-label" for="area_code">KODE SPK :</label>
                        <div class="col-sm-8 validation-container">
                            <input disabled class="form-control" id="kode_spk_edit" name="kode_spk_edit" type="text">
                        </div>
                    </div>

                   
                    <div class="row">


                        <label class="col-sm-4 form-label" for="area_code">KETERANGAN SPK :</label>
                        <div class="col-sm-8 validation-container">
                            <textarea class="form-control" name="keterangan_spk_edit" id="keterangan_spk_edit"></textarea>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

            </form>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/spk.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>
@endsection
