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
                            <a href="/realisasi-trucking" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-primary">Activity</span>
                            </a>
                            <a href="/realisasi-trucking" class="breadcrumb-item">
                                <span class="breadcrumb-text text-primary">Trucking</span>
                            </a>

                            <a href="/realisasi-trucking" class="breadcrumb-item">
                                @if ($active == "Plan")

                                <span class="breadcrumb-text text-warning">{{$active}}</span>
                                @endif
                                @if ($active == "Process")
                                <span class="breadcrumb-text text-success">{{$active}}</span>
                                @endif
                                @if ($active == "Realisasi")
                                <span class="breadcrumb-text text-danger">{{$active}}</span>
                                @endif
                            </a>


                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>



        <form action="#" class="row row-cols-lg-12 g-3" id="valid_realisasi" name="valid_realisasi">
            <input type="hidden" name="old_slug" id="old_slug" value="{{ $planload->slug }}">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <div class="col-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <div class="col-md-12 text-center mb-3">
                            <h3 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center"> {{ $planload->vessel }} ( {{ $planload->select_company }}
                                )</h3>
                        </div>
                        <div class="col-md-12 mb-3">
                            <table border="0">


                                <tr>
                                    <td width="45%">Vessel/Voyage</td>
                                    <td width="5%">:</td>
                                    <td width="50%">{{ $planload->vessel }}</td>
                                </tr>
                                <tr>
                                    <td>Vessel Code</td>
                                    <td>:</td>
                                    <td>{{ $planload->vessel_code }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Company</td>
                                    <td>:</td>
                                    <td>{{ $planload->select_company }}</td>
                                </tr>
                                <tr>
                                    <td>Pengirim</td>
                                    <td>:</td>
                                    <td>{{ $planload->pengirim }}</td>
                                </tr>
                                <tr>
                                    <td>Penerima</td>
                                    <td>:</td>
                                    <td>{{ $planload->penerima }}</td>
                                </tr>
                                <tr>
                                    <td>Activity</td>
                                    <td>:</td>
                                    <td>{{ $planload->activity }}</td>
                                </tr>
                                <tr>
                                    <td>EMKL</td>
                                    <td>:</td>
                                    <td>{{ $planload->emkl }}</td>
                                </tr>

                            </table>

                        </div>
                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Detail Kontainer (Process) :</b></label>
                        </div>
                            <table id="realisasiload_create" name="realisasiload_create" class="table table-bordered mb-0">
                                <thead class="align-top text-nowrap">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Size - Type</th>
                                        <th class="text-center">Nomor Kontainer</th>
                                        <th class="text-center">Cargo (Nama Barang)</th>
                                        <th class="text-center">Detail Barang</th>
                                        <th class="text-center">Seal-Container</th>
                                        <th class="text-center">Tanggal kegiatan</th>
                                        <th class="text-center">Lokasi Pickup</th>
                                        <th class="text-center">Lokasi Tujuan</th>
                                        <th class="text-center">Mty To</th>
                                        <th class="text-center">Nama Driver</th>
                                        <th class="text-center">Nomor Polisi</th>
                                        <th class="text-center">Ongkos Supir</th>
                                        <th class="text-center">Remark Container (jika ada)</th>
                                        <th class="text-center">Jenis Mobil</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="tbody_container">
                                    @foreach ($containers as $container)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>


                                            <td>
                                                <label disabled @readonly(true)
                                                    id="size[{{ $loop->iteration }}]">{{ old('size', $container->size) }}</label>
                                                -
                                                <label disabled @readonly(true)
                                                    id="type[{{ $loop->iteration }}]">{{ old('type', $container->type) }}</label>
                                            </td>
                                            <td>

                                                <label disabled @readonly(true)
                                                    id="nomor_kontainer[{{ $loop->iteration }}]">{{ old('nomor_kontainer', $container->nomor_kontainer) }}</label>
                                            </td>
                                            <td>

                                                <label disabled @readonly(true)
                                                    id="cargo[{{ $loop->iteration }}]">{{ old('cargo', $container->cargo) }}</label>

                                            </td>
                                            <td>

                                                <label disabled @readonly(true)
                                                    id="detail_barang[{{ $loop->iteration }}]">{{ old('detail_barang', $container->detail_barang) }}</label>

                                            </td>

                                            <td>
                                                <label disabled @readonly(true)
                                                    id="seal[{{ $loop->iteration }}]">{{ old('seal', $container->seal) }}</label>

                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="date_activity[{{ $loop->iteration }}]">{{ \Carbon\Carbon::parse(old('date_activity', $container->date_activity))->isoFormat('dddd, DD MMMM YYYY') }}</td>
                                                </label>
                                            </td>


                                            <td>
                                                <label disabled @readonly(true)
                                                    id="lokasi_pickup[{{ $loop->iteration }}]">{{ old('lokasi_pickup', $container->lokasi_pickup) }}</label>
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="lokasi_tujuan[{{ $loop->iteration }}]">{{ old('lokasi_tujuan', $container->lokasi_tujuan) }}</label>
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="mty_to[{{ $loop->iteration }}]">{{ old('mty_to', $container->mty_to) }}</label>
                                            </td>

                                            <td>
                                                <label disabled @readonly(true)
                                                    id="driver[{{ $loop->iteration }}]">{{ old('driver', $container->driver) }}</label>
                                            </td>


                                            <td>
                                                <label disabled @readonly(true)
                                                    id="nomor_polisi[{{ $loop->iteration }}]">{{ old('nomor_polisi', $container->nomor_polisi) }}</label>
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                id="ongkos_supir[{{ $loop->iteration }}]">@rupiah(old('ongkos_supir', $container->ongkos_supir))</label>

                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="remark[{{ $loop->iteration }}]">{{old('remark', $container->remark)}}</label>

                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="jenis_mobil[{{ $loop->iteration }}]">{{old('jenis_mobil', $container->jenis_mobil)}}</label>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                    </div>

                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>


            @if (count($biayas) > 0)
            <div class="col-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->


                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Biaya Lainnya</b></label>
                        </div>

                        <table id="table_biaya" class="table mb-0">
                            <thead id="thead_biaya" class="table-danger">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nomor Kontainer</th>
                                    <th class="text-center">Biaya</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_biaya" class="text-center">

                                @foreach ($biayas as $biaya)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <label id="kontainer_biaya[{{ $loop->iteration }}]">
                                                {{ $biaya->kontainer_biaya }}</label>
                                        </td>
                                        <td>
                                            <label id="harga_biaya[{{ $loop->iteration }}]">
                                                {{ $biaya->harga_biaya }}</label>

                                        </td>
                                        <td>
                                            <label id="keterangan[{{ $loop->iteration }}]">
                                                {{ $biaya->keterangan }}</label>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="mb-5 mt-5">
                    <button id="add_biaya" type="button" onclick="tambah_biaya()"
                        class="btn btn-label-danger btn-icon"> <i class="fa fa-plus"></i></button>
                </div> --}}

                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
        @endif




        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/discharge-realisasi.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>

    <script>
        $(document).ready(function() {
            $('input, select, .date_activity').blur(function() {
                var $txt = $(this).val();
                $(this).attr('data-bs-original-title', $txt);
            })
        })
    </script>
@endsection
