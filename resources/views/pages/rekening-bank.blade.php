@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-md-4">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">For Tambah {{ $title }}</h3>
                </div>
                <div class="portlet-body">

                    <form class="row g-3" id="valid_rekening" name="valid_rekening">
                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan Nama Bank:</label>
                                <input id="nama_bank" name="nama_bank" type="text" placeholder="Nama BANK ex. BCA" class="form-control"
                                    required>
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan No. Rekening:</label>
                                <input id="no_rekening" name="no_rekening" type="text" placeholder="No.Rekening (123xxxxxx)" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan Pemilik Rekening:</label>
                                <input id="atas_nama" name="atas_nama" type="text" placeholder="ex. John Doe" class="form-control"
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
                                <th>NAMA BANK</th>
                                <th>NO. REKENING</th>
                                <th>PEMILIK REKENING</th>
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
                                        {{ $dana->nama_bank }}
                                    </td>
                                    <td>
                                        {{ $dana->no_rekening }}
                                    </td>
                                    <td>
                                        {{ $dana->atas_nama }}
                                    </td>

                                    <td class="text-center"><button onclick="editrekening(this)" value="{{ $dana->id }}"
                                            class="btn btn-label-info btn-icon btn-circle btn-sm"><i
                                                class="fa fa-pencil"></i></button>

                                        <button onclick="deleterekening(this)" value="{{ $dana->id }}" type="button"
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
            <form action="#" name="valid_rekening_edit" id="valid_rekening_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pelabuhan</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="validation-container">
                        <label for="" class="form-label">Masukkan Nama Bank:</label>
                        <input id="nama_bank_edit" name="nama_bank_edit" type="text" placeholder="Nama BANK ex. BCA" class="form-control"
                            required>
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                    </div>

                    <div class="validation-container">
                        <label for="" class="form-label">Masukkan No. Rekening:</label>
                        <input id="no_rekening_edit" name="no_rekening_edit" type="text" placeholder="No.Rekening (123xxxxxx)" class="form-control"
                            required>
                    </div>

                    <div class="validation-container">
                        <label for="" class="form-label">Masukkan Pemilik Rekening:</label>
                        <input id="atas_nama_edit" name="atas_nama_edit" type="text" placeholder="ex. John Doe" class="form-control"
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
