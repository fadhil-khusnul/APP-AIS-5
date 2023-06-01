@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-md-4">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">Tambah {{ $title }}</h3>
                </div>
                <div class="portlet-body">

                    <form class="row g-3" id="valid_supir" name="valid_supir">
                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="company" class="form-label">Pilih Vendor Truck :</label>
                                <select required id="nama_vendor" name="nama_vendor" class="form-select">
                                    <option selected disabled>Pilih Vendor</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan Nama Supir :</label>
                                <input id="nama_supir" name="nama_supir" type="text" placeholder="Nama Supir" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan Nomor Polisi (Truck) :</label>
                                <input id="nomor_polisi" name="nomor_polisi" type="text" placeholder="ex. DD 22212 RT" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success"> Tambah Data <i class="fa fa-plus"></i> </button>
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
                                <th>NAMA VENDOR</th>
                                <th>NAMA SUPIR</th>
                                <th>NOMOR DD</th>
                                <th class="text-center">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supirs as $supir)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $supir->vendors->nama_vendor }}
                                    </td>
                                    <td>
                                        {{ $supir->nama_supir }}
                                    </td>
                                    <td>
                                        {{ $supir->nomor_polisi }}
                                    </td>

                                    <td class="text-center"><button onclick="editsupir(this)" value="{{ $supir->id }}"
                                            class="btn btn-label-info btn-icon btn-circle btn-sm"><i
                                                class="fa fa-pencil"></i></button>

                                        <button onclick="deletesupir(this)" value="{{ $supir->id }}" type="button"
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

    <div class="modal fade" id="modal-supir-edit">
        <div class="modal-dialog">
            <form action="#" name="valid_supir_edit" id="valid_supir_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="old_id_supir" id="old_id_supir">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Supir</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="validation-container">
                        <label for="company" class="form-label">Pilih Vendor Truck :</label>
                        <select required id="nama_vendor_edit" name="nama_vendor_edit" class="form-select">
                            <option selected disabled>Pilih Vendor</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="validation-container">
                        <label for="" class="form-label">Masukkan Nama Supir :</label>
                        <input id="nama_supir_edit" name="nama_supir_edit" type="text" placeholder="Nama Supir" class="form-control"
                            required>
                    </div>

                    <div class="validation-container">
                        <label for="" class="form-label">Masukkan Nomor Polisi (Truck) :</label>
                        <input id="nomor_polisi_edit" name="nomor_polisi_edit" type="text" placeholder="ex. DD 22212 RT" class="form-control"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit Data</button>
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
