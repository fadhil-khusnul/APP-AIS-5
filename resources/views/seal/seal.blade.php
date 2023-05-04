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
                                <div class="input-group">
                                    <input id="bulan_seal" name="bulan_seal" type="text" class="form-control" required><span
                                        class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                            {{-- <label for="" class="form-label">Tanggal & Bulan</label>
                        <input type="text" class="form-control" id="bulan_seal" name="bulan_seal"> --}}
                        </div>
                        <div class="col-md-6" style="margin-left: auto; margin-right:auto;">
                            <div class="text-center">
                                <div class="validation-container">
                                    <label for="" class="form-label">Stock Seal :</label>
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
                                {{-- <th>Tahun</th>
                                <th>Aksi</th> --}}
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
                                    {{-- <td>
                                        {{ $seal-> }}
                                    </td> --}}
                                    {{-- <td class="text-center"><button onclick="editstripp(this)" value="{{ $seal->id }}"
                                            class="btn btn-label-info btn-icon btn-circle btn-sm"><i
                                                class="fa fa-pencil"></i></button>

                                        <button onclick="deleteseal(this)" value="{{ $seal->id }}" type="button"
                                            class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                                class="fa fa-trash"></i></button> --}}
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/seal.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>


@endsection
