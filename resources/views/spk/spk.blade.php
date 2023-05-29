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
                                <label for="company" class="form-label">Pilih Shipping Company (Pelayaran)</label>
                                <select id="select_company" name="select_company" class="form-select">
                                    <option selected disabled>Pilih Pelayaran</option>
                                    @foreach ($pelayarans as $shippingcompany)
                                        <option value="{{ $shippingcompany->id }}">{{ $shippingcompany->nama_company }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="kode_spk" name="kode_spk" required>
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">

                                <div class="validation-container">
                                        <label for="" class="form-label">Nilai Awal SPK :</label>
                                        <input id="start_spk" name="start_spk" type="text" value="0" class="form-control" required><span
                                            class="col-md-6 form-control">
                                </div>
                            </div>
                            {{-- <label for="" class="form-label">Tanggal & Bulan</label>
                        <input type="text" class="form-control" id="bulan_seal" name="bulan_seal"> --}}
                        </div>
                        <div class="col-md-6" style="margin-left: auto; margin-right:auto;">
                            <div class="text-center">
                                <div class="validation-container">
                                    <label for="" class="form-label">Stock (Jumlah) SPK :</label>
                                    <input class="col-md-6 form-control"
                                        id="touch_spk" name="touch_spk" value="0" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" onclick="Tambah_SPK()" class="btn btn-success"> <i class="fa fa-plus"></i> Buat SPK</button>
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
                    <div class="col-6">
                            <label for="company" class="form-label filter">Shipping Company (Pelayaran)</label>
                            <select id="filter_pelayaran" name="filter_pelayaran" class="form-select">
                                <option selected disabled>Pilih Shipping Company (Pelayaran)</option>
                                @foreach ($pelayarans as $shippingcompany)
                                    <option value="{{ $shippingcompany->nama_company }}">{{ $shippingcompany->nama_company }}</option>
                                @endforeach
                            </select>
                    </div>
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
                                <th>Nama Shipping Company (Pelayaran)</th>
                                <th>Kode SPK</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spks as $spk)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $spk->pelabuhans->nama_company }}
                                    </td>
                                    <td>
                                        {{ $spk->kode_spk }}
                                    </td>
                                    {{-- <td>
                                        {{ $spk-> }}
                                    </td> --}}
                                    <td class="text-center"><button onclick="editspk(this)" value="{{ $spk->id }}"
                                            class="btn btn-label-info btn-icon btn-circle btn-sm"><i
                                                class="fa fa-pencil"></i></button>

                                        <button onclick="deletespk(this)" value="{{ $spk->id }}" type="button"
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


    <div class="modal fade" id="modal-spk-edit">
        <div class="modal-dialog">
            <form action="#" name="valid_spk_edit" id="valid_spk_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data SPK</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="validation-container">
                        <label for="company" class="form-label">Pilih Shipping Company (Pelayaran)</label>
                        <select id="select_company_edit" name="select_company_edit" class="form-select">
                            <option selected disabled>Pilih Pelayaran</option>
                            @foreach ($pelayarans as $shippingcompany)
                                <option value="{{ $shippingcompany->id }}">{{ $shippingcompany->nama_company }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="validation-container">
                        <label class="form-label" for="area_code">KODE SPK :</label>
                        <input class="form-control" id="kode_spk_edit" name="kode_spk_edit" type="text">
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
