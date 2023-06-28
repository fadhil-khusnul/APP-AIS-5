@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-md-4">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">{{ $title }}</h3>
                </div>
                <div class="portlet-body">

                    <form class="row g-3" id="valid_dana" name="valid_dana">

                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan Tanggal Deposit :</label>
                                <input id="tanggal_deposit" name="tanggal_deposit" type="text" placeholder="Tanggal Deposit" class="form-control date_activity"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan Nama Penanggung Jawab :</label>
                                <input id="pj" name="pj" type="text" placeholder="Nama Penanggung Jawab" class="form-control"
                                    required>
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            </div>
                        </div>

                        <div class="col-md-12">

                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan Nominal Dana :</label>
                                <input id="nominal" name="nominal" type="text" value="0" class="form-control"
                                    required onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                            </div>

                        </div>


                        <div class="text-end">
                            <button type="submit" class="btn btn-success"> Submit </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- END Portlet -->
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>
        <div class="col-md-8">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">{{ $title }}</h3>
                </div>
                <div class="portlet-body">

                    <hr>

                    <!-- BEGIN Datatable -->
                    <table id="input-seal" class="table table-bordered table-striped table-hover autosize">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Deposit</th>
                                <th>Penanggung Jawab</th>
                                <th>Dana Awal</th>
                                <th>Dana Sisa</th>
                                <th class="text-center">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danas as $dana)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($dana->tanggal_deposit)->isoFormat('dddd, DD MMMM YYYY') }}
                                    </td>
                                    <td>
                                        {{ $dana->pj }}
                                    </td>
                                    <td>
                                        @rupiah($dana->nominal_awal)
                                    </td>
                                    <td>
                                        @rupiah($dana->nominal)
                                    </td>
                                    <td class="text-center">
                                        <button onclick="printdana(this)" value="{{ $dana->id }}" type="button"
                                            class="btn btn-label-primary btn-icon btn-circle btn-sm"><i
                                                class="fa fa-print"></i></button>
                                        <button onclick="editdana(this)" value="{{ $dana->id }}"
                                            class="btn btn-label-info btn-icon btn-circle btn-sm"><i
                                                class="fa fa-pencil"></i></button>

                                        <button onclick="deletedana(this)" value="{{ $dana->id }}" type="button"
                                            class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                                class="fa fa-trash"></i></button>
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

    <div class="modal fade" id="modal-dana-edit">
        <div class="modal-dialog">
            <form action="#" name="valid_dana_edit" id="valid_dana_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="new_id" id="new_id">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Deposit</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="">Masukkan Tanggal Deposit :</label>
                        <div class="col-sm-8 validation-container">
                            <input id="tanggal_deposit_update" name="tanggal_deposit_update" type="text" placeholder="Tanggal Deposit" class="form-control date_activity"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label"for="area_code">Nama Penanggung Jawab :</label>
                        <div class="col-sm-8 validation-container">
                        <input class="form-control" id="pj_edit" name="pj_edit" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="email">Nominal :</label>
                        <div class="col-sm-8 validation-container">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" for="">Rp.</span>
                                <input class="form-control currency-rupiah" id="nominal_edit" name="nominal_edit" type="text">
                            </div>
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
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/ongkos_supir.js"></script>
@endsection
