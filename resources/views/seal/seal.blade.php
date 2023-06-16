@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-md-4">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">{{ $title }}</h3>
                </div>
                <div class="portlet-body">

                    <form class="row g-3" id="valid_seal" name="valid_seal">
                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="kode_seal" name="kode_seal" required>
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            </div>
                        </div>
                        <div class="col-md-12">

                                <div class="validation-container">
                                        <label for="" class="form-label">Harga per Seal (Rp.) :</label>
                                        <input id="harga_seal" name="harga_seal" type="text" value="0" class="form-control currency-rupiah" required><span
                                            class="col-md-6 form-control">
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">

                                <div class="validation-container">
                                        <label for="" class="form-label">Nilai Awal Seal :</label>
                                        <input id="start_seal" name="start_seal" type="text" value="0" class="form-control" required><span
                                            class="col-md-6 form-control">
                                </div>
                            </div>
                            {{-- <label for="" class="form-label">Tanggal & Bulan</label>
                        <input type="text" class="form-control" id="bulan_seal" name="bulan_seal"> --}}
                        </div>

                        <div class="col-md-6" style="margin-left: auto; margin-right:auto;">
                            <div class="text-center">
                                <div class="validation-container">
                                    <label for="" class="form-label">Stock (Jumlah) Seal :</label>
                                    <input class="col-md-6 form-control"
                                        id="touch_seal" name="touch_seal" value="0" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" onclick="Tambah_Seal()" class="btn btn-success"> <i class="fa fa-plus"></i> Buat Seal</button>
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
                    {{-- <div class="text-end">

                    <a href="planload/create" class="btn btn-success"> <i class="fa fa-plus"></i> Buat Job (Load)</a>
                </div> --}}
                    {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
                    <hr>

                    <!-- BEGIN Datatable -->
                    <table id="input-seal" class="table table-bordered table-striped table-hover autosize">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Seal</th>
                                <th>Harga Seal</th>
                                {{-- <th>Tahun</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seals as $seal)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $seal->kode_seal }}
                                    </td>
                                    <td>
                                        @rupiah($seal->harga_seal)
                                    </td>
                                    {{-- <td>
                                        {{ $seal-> }}
                                    </td> --}}
                                    <td class="text-center"><button onclick="editseal(this)" value="{{ $seal->id }}"
                                            class="btn btn-label-info btn-icon btn-circle btn-sm"><i
                                                class="fa fa-pencil"></i></button>

                                        <button onclick="deleteseal(this)" value="{{ $seal->id }}" type="button"
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


    <div class="modal fade" id="modal-seal-edit">
        <div class="modal-dialog">
            <form action="#" name="valid_pelabuhan_edit" id="valid_pelabuhan_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data SEAL</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <label class="col-sm-4 form-label" for="area_code">KODE SEAL :</label>
                        <div class="col-sm-8 validation-container">
                            <input class="form-control" id="kode_seal_edit" name="kode_seal_edit" type="text">
                        </div>
                    </div>
                    <div class="row">

                        <label class="col-sm-4 form-label" for="area_code">HARGA SEAL :</label>
                        <div class="col-sm-8 validation-container">
                            <input required class="form-control currency-rupiah" id="harga_seal_edit" name="harga_seal_edit" type="text">
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
    <script type="text/javascript" src="{{ asset('/') }}./js/seal.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>
@endsection
