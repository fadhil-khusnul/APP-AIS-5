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
                                <label for="" class="form-label">Pilih Seal</label>
                                <select id="seal" name="seal" class="form-select">
                                    <option selected disabled value="0">Pilih Seal</option>
                                    @foreach ($seal as $seal)
                                        <option value="{{ $seal->kode_seal }}">
                                            {{ $seal->kode_seal }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="validation-container">
                                    <label for="" class="form-label">Keterangan Kerusakan :</label>
                                    <textarea class="form-control" name="keterangan_damage" id="keterangan_damage"></textarea>
                            </div>
                            {{-- <label for="" class="form-label">Tanggal & Bulan</label>
                        <input type="text" class="form-control" id="bulan_seal" name="bulan_seal"> --}}
                        </div>


                        <div class="text-end">
                            <button type="submit" onclick="damage_seal()" class="btn btn-success"> Submit </button>
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
                                <th>Keterangan Kerusakan</th>

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
                                        {{ $seal->keterangan_damage }}
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
