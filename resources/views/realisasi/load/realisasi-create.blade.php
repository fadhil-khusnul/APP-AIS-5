@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- BEGIN Portlet -->
            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">

                    <h3 class="header-title">
                    <a href="#" onclick="GoBackWithRefresh();return false;">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    </h3>
                    <i class="header-divider"></i>
                    <div class="header-wrap header-wrap-block justify-content-start">
                        <!-- BEGIN Breadcrumb -->

                        <div class="breadcrumb breadcrumb-transparent mb-0">
                            <a href="/realisasi-load" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-primary">Load</span>
                            </a>
                            <a href="/processload-create/{{ $planload->slug }}" class="breadcrumb-item">
                                <span class="breadcrumb-text text-success">Process</span>
                            </a>

                            <a href="/realisasi-load" class="breadcrumb-item">
                                @if ($active == 'Plan')
                                    <span class="breadcrumb-text text-warning">{{ $active }}</span>
                                @endif
                                @if ($active == 'Process')
                                    <span class="breadcrumb-text text-success">{{ $active }}</span>
                                @endif
                                @if ($active == 'Realisasi POL')
                                    <span class="breadcrumb-text text-danger">{{ $active }}</span>
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
            <div class="col-md-12">
                <div class="portlet">

                    <div class="portlet-body py-5">



                        <div class="col-md-12 text-center mb-3">
                            <h1 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center">KAPAL :
                            </h1>
                            <h3 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center"><u> {{ $planload->vessel }} ( {{ $planload->select_company }}
                                )</u></h3>
                        </div>
                        <div class="col-md-12 mb-3 table-responsive">
                            <table border="0" style="margin-left: auto; margin-right:auto">
                                <tr>
                                    <td width="47%">Vessel/Voyage</td>
                                    <td width="3%">:</td>
                                    <td width="50%" id="nama_kapal">{{ $planload->vessel }}</td>
                                </tr>
                                <tr>
                                    <td>Vessel Code</td>
                                    <td>:</td>
                                    <td id="kode_kapal">{{ $planload->vessel_code }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Company</td>
                                    <td>:</td>
                                    <td>{{ $planload->select_company }}</td>
                                </tr>

                                <tr>
                                    <td>Activity</td>
                                    <td>:</td>
                                    <td>{{ $planload->activity }}</td>
                                </tr>
                                <tr>
                                    <td>POL (Port of Loading)</td>
                                    <td>:</td>
                                    <td>{{ $planload->pol }}</td>
                                </tr>
                                {{-- <tr>
                                    <td>POT (Port of Transit)</td>
                                    <td>:</td>
                                    <td>{{ $planload->pot }}</td>
                                </tr> --}}


                            </table>
                            <div class="text-center mt-3">
                                <a href="/processload-create/{{ $planload->slug }}"
                                    class="btn btn-success "><i
                                    class="fa fa-arrow-left"></i> ke Process
                                </a>
                            </div>

                        </div>





                        <!-- END Form -->


                    </div>
                    <!-- BEGIN Portlet -->

                    <!-- END Portlet -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="portlet">

                    <div class="portlet-body">


                        <div class="col-md-12 text-center py-4">
                            <label for="inputState" class="form-label"><u><b>DETAIL KONTAINER :</b></u></label>
                        </div>

                        <div class="row row-cols-lg-auto py-5 g-3">
                            <label for="" class="col-form-label">Filter Tabel :</label>

                            <div class="col-6">
                                <select multiple id="pilih_pod_input" name="pilih_pod_input" class="form-select" onchange="pilih_pod_input_fun(this)">
                                    @foreach ($pelabuhans as $pelabuhan)
                                    <option value="{{$pelabuhan->nama_pelabuhan}}">{{$pelabuhan->nama_pelabuhan}}/{{$pelabuhan->area_code}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_pot_input" name="pilih_pot_input" class="form-select" onchange="pilih_pot_input_fun(this)">
                                    @foreach ($pelabuhans as $pelabuhan)
                                    <option value="{{$pelabuhan->nama_pelabuhan}}">{{$pelabuhan->nama_pelabuhan}}/{{$pelabuhan->area_code}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_size_input" name="pilih_size_input" class="form-select pilih" onchange="pilih_size_input_fun(this)">
                                    @foreach ($sizes as $size)
                                    <option value="{{$size->size_container}}">{{$size->size_container}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_type_input" name="pilih_type_input" class="form-select pilih" onchange="pilih_type_input_fun(this)">
                                    @foreach ($types as $type)
                                    <option value="{{$type->type_container}}">{{$type->type_container}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select id="pilih_ok_input" name="pilih_ok_input" class="form-select" onchange="pilih_ok_input_fun(this)">
                                    <option selected value="">Pilih Status Container</option>
                                    <option value="Receiving OK">Delivery OK</option>
                                    <option value="Belum Buat JOB">Belum Buat JOB</option>


                                </select>

                            </div>



                        </div>
                        <div class="table-responsive">

                            <table id="realisasiload_create" name="realisasiload_create" class="table table-bordered table-hover mb-0 seratus">
                                <thead class="table-danger text-nowrap text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>SI</th>
                                        <th>Delivery OK</th>
                                        <th>POD</th>
                                        <th>POT</th>
                                        <th>Nomor Kontainer</th>
                                        <th>Size</th>
                                        <th>Type</th>
                                        <th>Pengirim</th>
                                        <th>Penerima</th>
                                        <th>Seal-Container</th>
                                        <th>Cargo (Nama Barang)</th>



                                    </tr>
                                </thead>
                                <tbody class="text-center" id="tbody_container">
                                    @foreach ($containers as $container)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                    
                                            
                                            <td class="text-nowrap text-center">

                                                @if ($container->status != 'Realisasi')
                                                    <div class="validation-container">
                                                        <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                            class="form-check-input check-container"
                                                            id="kontainer_check[{{ $loop->iteration }}]" name="letter" onchange="countCheck()"
                                                            value="{{ $container->id }}"  autofocus>

                                                    </div>
                                                @else
                                                <div class="">

                                                    <input readonly disabled checked type="checkbox"
                                                        class="form-check-input"
                                                        id="kontainer_check[{{ $loop->iteration }}]">
                                                </div>
                                                @endif

                                               


                                            </td>
                                        
                                            <td class="text-nowrap text-start">
                                                @if ($container->ok == 1 )
                                                <i class="marker marker-dot text-success"></i>Receiving OK
                                                <input readonly disabled checked type="checkbox"
                                                        class="form-check-input"
                                                        id="kontainer_check[{{ $loop->iteration }}]">
                                               

                                                @else
                                                <i class="marker marker-dot text-danger"></i>Belum Buat JOB
                                                <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                class="form-check-input check_job"
                                                id="delivery_check[{{ $loop->iteration }}]" name="delivery" onchange="countCheck_delivery()"
                                                value="{{ $container->id }}" autofocus>

                                                @endif


                                            </td>
                                            



                                            <td>
                                                <label disabled @readonly(true)
                                                    id="pod_container[{{ $container->id }}]">{{ old('pod_container', $container->pod_container) }}</label>

                                            </td>
                                            <td>
                                                @if ($container->pot_container != null)
                                                <label disabled @readonly(true)
                                                    id="pot_container[{{ $container->id }}]">{{ old('pot_container', $container->pot_container) }}</label>
                                                @else
                                                -
                                                @endif

                                            </td>

                                            <td>

                                                <label disabled @readonly(true)
                                                    id="nomor_kontainer[{{ $container->id }}]">{{ old('nomor_kontainer', $container->nomor_kontainer) }}</label>
                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="size[{{ $container->id }}]">{{ old('size', $container->size) }}</label>

                                            </td>
                                            <td>
                                                <label disabled @readonly(true)
                                                    id="type[{{ $container->id }}]">{{ old('type', $container->type) }}</label>
                                            </td>

                                            <td>
                                                <label disabled @readonly(true)
                                                    id="pengirim[{{ $container->id }}]">{{ old('pengirim', $container->pengirim) }}</label>

                                            </td>

                                            <td>
                                                <label disabled @readonly(true)
                                                    id="penerima[{{ $container->id }}]">{{ old('penerima', $container->penerima) }}</label>

                                            </td>


                                            <td>
                                                @if ($sealsc->count() == 1)
                                                    @foreach ($sealsc as $seal)
                                                    @if ($seal->kontainer_id == $container->id)
                                                            {{ $seal->seal_kontainer }}

                                                    @endif
                                                    @endforeach
                                                @elseif($sealsc->count() == 0)
                                                -
                                                @else
                                                <ol type="1.">

                                                    @foreach ($sealsc as $seal)
                                                        @if ($seal->kontainer_id == $container->id)
                                                            <li id="seal[{{ $container->id }}]">
                                                                {{ $seal->seal_kontainer }}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ol>
                                                @endif



                                            </td>
                                            <td>

                                                <label disabled @readonly(true)
                                                    id="cargo[{{ $container->id }}]">{{ old('cargo', $container->cargo) }}</label>

                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <!-- END Form -->
                        <div class="text-center">

                            <div class="col-auto text-center">
                                <button id="submit-id" type="submit" onclick="pdf_si()" class="btn btn-primary ">Cetak
                                    SI <i class="fa fa-print"></i></button> <label for="" class="" style="margin-left: "><b id="nomor">0</b> dari <b id="jumlah">{{count($containers)}}</b> Kontainer dipilih.</label>
                                <button id="submit_ok" type="button" onclick="ok_load()" class="btn btn-success ">Buat Job
                                    <i class="fa fa-check-square"></i></button> <label for="" class="" style="margin-left: "><b id="nomor_delivery">0</b> dari <b id="jumlah">{{count($containers)}}</b> Kontainer dipilih.</label>
                            </div>
                           



                        </div>
                       

                    </div>
                    <!-- BEGIN Portlet -->

                    <!-- END Portlet -->
                </div>
            </div>
            @if (count($alihs) > 0)
            <div class="col-md-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">

                            <label for="inputState" class="form-label"><u><b>KONTAINER ALIH KAPAL</b></u></label>
                        </div>

                        <div class="row row-cols-lg-auto py-5 g-3">
                            <label for="" class="col-form-label">Filter Tabel :</label>
                            <div class="col-6">
                                <select id="pilih_pot_alih" name="pilih_pot_alih" class="form-select pilih" onchange="filter_status(this)">
                                    <option selected disabled>Pilih POT</option>
                                    @foreach ($pelabuhans as $pelabuhan)
                                    <option value="{{$pelabuhan->nama_pelabuhan}}">{{$pelabuhan->nama_pelabuhan}}/{{$pelabuhan->area_code}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select id="pilih_pod_alih" name="pilih_pod_alih" class="form-select pilih" onchange="filter_status(this)">
                                    <option selected disabled>Pilih POD</option>
                                    @foreach ($pelabuhans as $pelabuhan)
                                    <option value="{{$pelabuhan->nama_pelabuhan}}">{{$pelabuhan->nama_pelabuhan}}/{{$pelabuhan->area_code}}</option>
                                    @endforeach

                                </select>

                            </div>


                        </div>
                        <div class="table-responsive">


                            <table id="table_alih_kapal_realisasi" class="table table-bordered table-hover mb-0 seratus">
                                <thead id="thead_alih" class="table-danger">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">Nomor Kontainer</th>
                                        <th class="text-center">Pelayaran (Shipping Company)</th>
                                        <th class="text-center">POT</th>
                                        <th class="text-center">POD</th>
                                        <th class="text-center">Vessel/Voyage</th>
                                        <th class="text-center">Code Vessel/Voyage</th>
                                        <th class="text-center">Biaya Alih Kapal</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_alih" class="text-center">
                                    @foreach ($alihs as $alih)
                                        <tr>
                                            <td align="center">

                                                {{ $loop->iteration }}
                                            </td>

                                            <td>
                                                @if ($alih->container_planloads->slug != null)
                                                <input readonly disabled checked type="checkbox"
                                                    class="form-check-input"
                                                    id="kontainer_check[{{ $loop->iteration }}]">

                                                @else
                                                    <div class="validation-container">
                                                        <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                            class="form-check-input check-container1"
                                                            id="kontainer_check[{{ $loop->iteration }}]" name="letter1" onchange="countCheck1()"
                                                            value="{{ $alih->kontainer_alih }}" autofocus>

                                                    </div>
                                                @endif
                                            </td>

                                            <td>
                                                <label id="kontainer_alih[{{ $loop->iteration }}]">
                                                    {{ $alih->container_planloads->nomor_kontainer }}</label>
                                            </td>
                                            <td>
                                                <label id="pelayaran_alih[{{ $loop->iteration }}]">
                                                    {{ $alih->pelayaran_alih }}</label>
                                            </td>
                                            <td>
                                                <label id="pot_alih[{{ $loop->iteration }}]">
                                                    {{ $alih->pot_alih }}</label>
                                            </td>
                                            <td>
                                                <label id="pod_alih[{{ $loop->iteration }}]">
                                                    {{ $alih->pod_alih }}</label>
                                            </td>
                                            <td>
                                                <label id="vesseL_alih[{{ $loop->iteration }}]">
                                                    {{ $alih->vesseL_alih }}</label>
                                            </td>
                                            <td>
                                                <label id="code_vesseL_alih[{{ $loop->iteration }}]">
                                                    {{ $alih->code_vesseL_alih }}</label>
                                            </td>
                                            <td>
                                                <label id="harga_alih_kapal[{{ $loop->iteration }}]">
                                                    @rupiah($alih->harga_alih_kapal)</label>

                                            </td>
                                            <td>
                                                <label id="keterangan_alih_kapal[{{ $loop->iteration }}]">
                                                    {{ $alih->keterangan_alih_kapal }}</label>

                                            </td>
                                           

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                         </div>


                        <div class="row row-cols-lg-auto px-3 mt-5 mb-5">
                            <div class="col-auto">
                                <button id="submit-id1" type="submit" onclick="pdf_si_alih()"
                                    class="btn btn-info ">Cetak SI ALIH KAPAL <i class="fa fa-print"></i></button>
                                    <label for="" class="" style="margin-left: "><b id="nomor1">0</b> dari <b id="jumlah">{{count($alihs)}}</b> Kontainer dipilih.</label>
                                
                            </div>


                        </div>

                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
            @endif





        @if (count($pdfs) > 0)
            <div class="col-md-12">
                <div class="portlet">

                    <div class="portlet-body">

                        <!-- BEGIN Form -->

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><u><b>SI/BL/DO</b></u></label>
                        </div>

                        <div class="row row-cols-lg-auto py-5 g-3">
                            <label for="" class="col-form-label">Filter Tabel :</label>
                            <div class="col-6">
                                <select id="pilih_status" name="pilih_status" class="form-select pilih" onchange="filter_status(this)">
                                    <option selected disabled>Pilih Status Approve</option>
                                    <option value="Belum Approve">Belum Approve</option>
                                    <option value="Sudah Approve">Sudah Approve</option>

                                </select>

                            </div>
                            <div class="col-6">
                                <select id="pilih_status_bl" name="pilih_status_bl" class="form-select pilih" onchange="filter_status(this)">
                                    <option selected disabled>Pilih Status BL</option>
                                    <option value="Belum BL">Belum BL</option>
                                    <option value="Sudah BL">Sudah BL</option>

                                </select>

                            </div>

                            <div class="col-6">
                                <select id="pilih_status_si" name="pilih_status_si" class="form-select pilih" onchange="filter_status(this)">
                                    <option selected disabled>Pilih Jenis SI</option>
                                    <option value="BIASA">BIASA</option>
                                    <option value="ALIH-KAPAL">ALIH-KAPAL</option>

                                </select>

                            </div>

                        </div>

                        <table id="tabel_si" class="table table-bordered table-hover mb-0 seratus">
                            <thead id="thead_alih" class="table-danger text-center">
                                <tr>
                                    <th class="">No</th>
                                    <th class=""></th>
                                    <th class="">Status Approve</th>
                                    <th class="">Status BL</th>
                                    <th class="">Jenis SI</th>
                                    <th class="">Shipper</th>
                                    <th class="">Consigne</th>
                                    <th class="">Tanggal BL</th>
                                    <th class="">Nomor BL</th>
                                    <th class="">DO Fee</th>



                                </tr>
                            </thead>
                            <tbody id="tbody_alih" class="">
                                @foreach ($pdfs as $pdf)
                                    <tr>
                                        <td align="center">

                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-nowrap text-center">
                                            <button type="button" value="{{$pdf->id}}" onclick="delete_SI(this)"
                                                class="btn btn-danger btn-sm "><i
                                                    class="fa fa-trash"></i></button>

                                            <a type="button" href="/preview-si/{{ $pdf->path }}"
                                                class="btn btn-info btn-sm ">Preview SI <i
                                                    class="fa fa-eye"></i></a>

                                            
                                            @if ($pdf->nomor_bl == null && $pdf->status_approve == "Disetujui")
                                                <button value="{{ $pdf->id }}" type="button"
                                                    onclick="input_bl(this)"
                                                    class="btn btn-success btn-sm ">Input BL <i
                                                        class="fa fa-pencil"></i></button>

                                            @elseif ($pdf->nomor_bl != null)
                                                <button value="{{ $pdf->id }}" type="button"
                                                    onclick="update_bl(this)"
                                                    class="btn btn-primary btn-sm ">Edit BL <i
                                                        class="fa fa-pencil"></i></button>
                                            @endif

                                            

                                        </td>

                                     


                                        <td>
                                            @if ($pdf->status_approve == 'Disetujui')
                                            <i class="marker marker-dot text-success"></i>Approve
                                            @elseif ($pdf->status_approve == 'Ditolak')
                                            <i class="marker marker-dot text-danger"></i>Ditolak
                                            @elseif ($pdf->status_approve == null)
                                            <i class="marker marker-dot text-warning"></i>Belum Approve
                                            @endif

                                        </td>
                                        <td>
                                            @if ($pdf->nomor_bl != null)
                                            <i class="marker marker-dot text-success"></i>Selesai
                                            @else
                                                <i class="marker marker-dot text-warning"></i>
                                                Belum BL
                                            @endif

                                        </td>
                                        <td class="align-middle text-nowrap">

                                            @if ($pdf->status_si == 'Default')
                                            <i class="marker marker-dot text-success"></i>
                                            BIASA
                                            @else
                                            <i class="marker marker-dot text-primary"></i>
                                            ALIH-KAPAL
                                            @endif
                                        </td>

                                        <td>
                                            {{ $pdf->shipper }}

                                        </td>
                                        <td>
                                            {{ $pdf->consigne }}

                                        </td>

                                        <td>
                                            @if ($pdf->tanggal_bl != null)
                                                {{ \Carbon\Carbon::parse($pdf->tanggal_bl)->isoFormat('dddd, DD MMMM YYYY') }}
                                            @else
                                                -
                                            @endif

                                        </td>
                                        <td>
                                            @if ($pdf->nomor_bl != null)
                                                {{ $pdf->nomor_bl }}
                                            @else
                                                -
                                            @endif

                                        </td>
                                        <td>
                                            @if ($pdf->biaya_do_pol != null)
                                                @rupiah($pdf->biaya_do_pol)
                                            @else
                                                -
                                            @endif

                                        </td>





                                       
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>



                        <div class="text-center mt-3">
                            <a href="/realisasi-pod-create/{{ $planload->slug }}"
                                class="btn btn-success ">
                                Realisasi POD <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>


                    </div>
                    <!-- BEGIN Portlet -->

                    <!-- END Portlet -->
                </div>
            </div>
        @endif

        <div class="col-md-12 col-xl-12">
            <div class="portlet">
                <div class="portlet-body">

                    <div class="col-md-12 text-center">
                        <label for="inputState" class="form-label"><u><b>INFORMASI KONTAINER :</u></b></label>
                    </div>

                    <div class="row row-cols-lg-auto py-5 g-3">
                        <label for="" class="col-form-label">Filter Tabel :</label>

                        <div class="col-6">
                            <select id="pilih_status_if1" name="pilih_status_if1" class="form-select pilih" onchange="pilih_status_if1_fun(this)">
                                <option selected value="">Pilih Status Container</option>
                                <option value="BIASA">BIASA</option>
                                <option value="ALIH-KAPAL">ALIH-KAPAL</option>


                            </select>

                        </div>
                        <div class="col-6">
                            <select multiple id="pilih_pod_if1" name="pilih_pod_if1" class="form-select" onchange="pilih_pod_if1_fun(this)">
                                @foreach ($pelabuhans as $pelabuhan)
                                <option value="{{$pelabuhan->nama_pelabuhan}}">{{$pelabuhan->nama_pelabuhan}}/{{$pelabuhan->area_code}}</option>
                                @endforeach

                            </select>

                        </div>
                        <div class="col-6">
                            <select multiple id="pilih_pot_if1" name="pilih_pot_if1" class="form-select" onchange="pilih_pot_if1_fun(this)">
                                @foreach ($pelabuhans as $pelabuhan)
                                <option value="{{$pelabuhan->nama_pelabuhan}}">{{$pelabuhan->nama_pelabuhan}}/{{$pelabuhan->area_code}}</option>
                                @endforeach

                            </select>

                        </div>
                        <div class="col-6">
                            <select multiple id="pilih_size_if1" name="pilih_size_if1" class="form-select pilih" onchange="pilih_size_if1_fun(this)">
                                @foreach ($sizes as $size)
                                <option value="{{$size->size_container}}">{{$size->size_container}}</option>
                                @endforeach

                            </select>

                        </div>
                        <div class="col-6">
                            <select multiple id="pilih_type_if1" name="pilih_type_if1" class="form-select pilih" onchange="pilih_type_if1_fun(this)">
                                @foreach ($types as $type)
                                <option value="{{$type->type_container}}">{{$type->type_container}}</option>
                                @endforeach

                            </select>

                        </div>



                    </div>
                    <div class="table-responsive">

                        <table id="table_informasi1" class="table table-bordered table-striped table-hover autosize" style="width: 100% !important">
                            <thead class="table">
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Tgl. Kegiatan</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>POD</th>
                                    <th>POT</th>
                                    <th>VESEEL POT</th>
                                    <th>Size Container</th>
                                    <th>Type Container</th>
                                    <th>Nomor Container</th>
                                    <th>Cargo</th>
                                    <th>Seal</th>
                                    <th>Lokasi Pickup</th>
                                    <th>Nama Supir/Nomor Polisi</th>
                                    <th>Vendor Truck</th>
                                    <th>Jenis Mobil</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($containers_info as $container)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="align-middle text-nowrap">
                                        @if ($container->status == "Alih-Kapal" || $container->status == "Realisasi-Alih" )
                                        <i class="marker marker-dot text-primary"></i>ALIH-KAPAL
                                        @elseif ($container->status == "Batal-Muat")
                                        <i class="marker marker-dot text-danger"></i>BATAL-MUAT
                                        @else
                                        <i class="marker marker-dot text-success"></i> BIASA
                                        @endif


                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}
                                    </td>
                                    <td>{{$container->pengirim}}</td>
                                    <td>{{$container->penerima}}</td>
                                    <td>{{$container->pod_container}}</td>
                                    <td>{{$container->pot_container}}</td>
                                    <td>{{$container->vessel_pot}}</td>
                                    <td>{{$container->size}}</td>
                                    <td>{{$container->type}}</td>
                                    <td>{{$container->nomor_kontainer}}</td>
                                    <td>{{$container->cargo}}</td>
                                    <td>
                                        @if ($sealsc->count() == 1)
                                            @foreach ($sealsc as $seal)
                                            @if ($seal->kontainer_id == $container->id)
                                                    {{ $seal->seal_kontainer }}

                                            @endif
                                            @endforeach
                                        @else
                                        <ol type="1.">

                                            @foreach ($sealsc as $seal)
                                                @if ($seal->kontainer_id == $container->id)
                                                    <li id="seal[{{ $container->id }}]">
                                                        {{ $seal->seal_kontainer }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ol>
                                        @endif
                                    </td>
                                    <td>{{$container->lokasi_depo}}</td>

                                    <td>
                                        @if ($container->nomor_polisi != null)
                                            {{ $container->mobils->nama_supir }}/{{ $container->mobils->nomor_polisi }}

                                        @endif
                                    </td>
                                    <td>
                                        @if ($container->nomor_polisi != null)
                                            {{ $container->mobils->vendors->nama_vendor }}

                                        @endif
                                    </td>
                                    <td>{{$container->jenis_mobil}}
                                    </td>
                                </tr>


                                @endforeach
                            </tbody>

                        </table>


                        </div>
                        <div class="row row-cols-lg-auto py-5 g-3">
                            <label for="" class="col-form-label">Filter Tabel :</label>


                            <div class="col-6">
                                <select multiple id="pilih_size_if2" name="pilih_size_if2" class="form-select" onchange="pilih_size_if2_fun(this)">
                                    @foreach ($sizes as $size)
                                    <option value="{{$size->size_container}}">{{$size->size_container}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-6">
                                <select multiple id="pilih_type_if2" name="pilih_type_if2" class="form-select" onchange="pilih_type_if2_fun(this)">
                                    @foreach ($types as $type)
                                    <option value="{{$type->type_container}}">{{$type->type_container}}</option>
                                    @endforeach

                                </select>

                            </div>



                        </div>

                        <div class="table-responsive">


                            <table id="table_informasi2" class="table table-bordered table-striped table-hover autosize" style="width: 100% !important">
                                <thead class="table">
                                    <tr>
                                        <th>No</th>
                                        <th>Container</th>
                                        <th>Size</th>
                                        <th>Type</th>
                                        <th>SPK</th>
                                        <th>Biaya Stuffing</th>
                                        <th>Biaya Trucking</th>
                                        <th>Ongkos Supir</th>
                                        <th>Biaya Seal</th>
                                        <th>Biaya THC POL</th>
                                        <th>Biaya Freight</th>
                                        <th>Biaya LSS</th>
                                        <th>Biaya Lain-Lain</th>
                                        <th>Biaya Alih Kapal</th>
                                        <th>Biaya Batal Muat</th>
                                        <th>Jenis Mobil</th>
                                        <th>Deposit Trucking</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($containers_info as $container)
                                <tr>

                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{$container->nomor_kontainer}}</td>
                                    <td>{{$container->size}}</td>
                                    <td>{{$container->type}}</td>
                                    <td>{{$container->spk}}</td>
                                    <td>@rupiah($container->biaya_stuffing)</td>
                                    <td>@rupiah($container->biaya_trucking)</td>
                                    <td>@rupiah($container->ongkos_supir)</td>
                                    <td>@rupiah($container->biaya_seal)</td>
                                    <td>@rupiah($container->biaya_thc)</td>
                                    <td>@rupiah($container->freight)</td>
                                    <td>@rupiah($container->lss)</td>
                                    <td>@rupiah($container->total_biaya_lain)</td>

                                    {{-- <td>@if ($biayas->count() == 1)
                                        @foreach ($biayas as $biaya)
                                        @if ($biaya->kontainer_id == $container->id)
                                                @rupiah($biaya->harga_biaya)

                                        @endif
                                        @endforeach
                                        @else
                                        <ol type="1.">

                                            @foreach ($biayas as $biaya)
                                                @if ($biaya->kontainer_id == $container->id)
                                                    <li id="biaya[{{ $container->id }}]">
                                                        @rupiah($biaya->harga_biaya)
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ol>
                                        @endif
                                    </td> --}}
                                    <td>
                                        @if ($container->harga_alih != null)

                                        @rupiah($container->alihs->harga_alih_kapal)
                                        @endif

                                    </td>

                                    <td>@rupiah($container->harga_batal)</td>
                                    <td>{{$container->jenis_mobil}}</td>
                                    <td>@if ($container->dana != null)
                                        {{$container->danas->pj}}
                                        @endif
                                    </td>



                                </tr>






                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                </div>
            </div>
        </div>




            <!-- BEGIN Portlet -->

            <!-- END Portlet -->




        </form>
    </div>


    <div class="modal fade" id="modal-si">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" action="#" id="valid_si" name="valid_si">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan SHIPPER dan CONSIGNE Terlebih Dahulu</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">SHIPPER :</label>
                            <div class="col-sm-8 validation-container">
                            <input required class="form-control" id="shipper" name="shipper" type="text"
                                placeholder="Masukkan shipper">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">CONSIGNE</label>
                            <div class="col-sm-8 validation-container">
                                <input required class="form-control" id="consigne" name="consigne" type="text"
                                    placeholder="Masukkan consigne">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnFinish" class="btn btn-success">Buatkan SI</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal-bl">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="valid_bl" name="valid_bl">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan Nomor dan Tanggal BL</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">Nomor BL :</label>

                            <div class="col-sm-8 validation-container">
                                <input required class="form-control" id="nomor_bl" name="nomor_bl" type="text"
                                    placeholder="Masukkan Nomor BL">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">Tanggal BL</label>
                            <div class="col-sm-8 validation-container">
                                <input required class="form-control date_activity" id="tanggal_bl" name="tanggal_bl" type="text"
                                placeholder="Masukkan Tanggal BL">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">DO Fee :</label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input required class="form-control currency-rupiah" id="biaya_do_pol" name="biaya_do_pol" type="text"
                                        placeholder="Masukkan DO Fee">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">Tanggal DO POL:</label>
                            <div class="col-sm-8 validation-container">
                                <input required class="form-control date_activity" id="tanggal_do_pol" name="tanggal_do_pol" type="text"
                                placeholder="Tanggal DO POL">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnFinish1" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal-job-update">
        <div class="modal-dialog modal-dialog-scrollable">
            <form class="modal-dialog-scrollable" action="#" name="valid_job_update" id="valid_job_update">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="new_id_update" id="new_id_update">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">DETAIL KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Pengirim :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled id="pengirim_update" name="pengirim_update" class="form-select">
                                    <option selected disabled>Pilih Pengirim</option>
                                    @foreach ($pengirims as $pengirim)
                                        <option value="{{ $pengirim->nama_costumer }}"
                                            @if ($pengirim->nama_costumer == $planload->pengirim) selected @endif>
                                            {{ $pengirim->nama_costumer }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Penerima :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled id="penerima_update" name="penerima_update" class="form-select">
                                    <option selected disabled>Pilih Pengirim</option>
                                    @foreach ($penerimas as $penerima)
                                        <option value="{{ $penerima->nama_penerima }}"
                                            @if ($penerima->nama_penerima == $planload->penerima) selected @endif>
                                            {{ $penerima->nama_penerima }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Size :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled data-bs-toggle="tooltip" id="size_update" name="size_update"
                                    class="form-select" @readonly(true) required>
                                    <option disabled>Pilih Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}"
                                            @if ($size->size_container) selected @endif>
                                            {{ $size->size_container }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Type :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled data-bs-toggle="tooltip" id="type_update" name="type_update"
                                    class="form-select" @readonly(true) required>
                                    <option disabled>Pilih Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}"
                                            @if ($type->type_container) selected @endif>
                                            {{ $type->type_container }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Nomor Kontainer :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input type="hidden" id="no_container_edit" name="no_container_edit">
                                <input disabled required data-bs-toggle="tooltip" type="text"
                                    class="form-control nomor_kontainer" id="nomor_kontainer_update" minlength="11"
                                    maxlength="11" name="nomor_kontainer_update" onblur="blur_no_container_edit(this)"
                                    required placeholder="XXXX0000000">
                            </div>
                        </div>

                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Barang (Cargo) :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input disabled data-bs-toggle="tooltip" type="text" class="form-control"
                                    id="cargo_update" name="cargo_update" value="{{ old('cargo') }}" required>
                            </div>


                        </div>


                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Seal-Container :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled data-bs-toggle="tooltip" id="seal_update" multiple="multiple"
                                    name="seal_update" class="form-select" placeholde="Silahkan Pilih Seal" required>
                                    @foreach ($seals as $seal)
                                        <option value="{{ $seal->kode_seal }}">
                                            {{ $seal->kode_seal }}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Kegiatan :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input disabled data-bs-toggle="tooltip" type="text"
                                    class="form-control date_activity" id="date_activity_update"
                                    name="date_activity_update" placeholder="Tanggal Kegiatan..." value=""
                                    required>

                            </div>
                        </div>

                        <div class="row ">
                            <label for="" class="col-sm-4 col-form-label">Lokasi Pickup :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled data-bs-toggle="tooltip" id="lokasi_update" name="lokasi_update"
                                    class="form-select" required>
                                    <option selected disabled value="0">Pilih Lokasi Pickup</option>
                                    @foreach ($lokasis as $lokasi)
                                        <option value="{{ $lokasi->nama_depo }}">
                                            {{ $lokasi->nama_depo }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label">Vendor Truck :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled required id="driver_update" name="driver_update" class="form-select">
                                    <option selected disabled>Pilih Vendor</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label">Nama Supir/Nomor Polisi :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled required id="nomor_polisi_update" name="nomor_polisi_update"
                                    class="form-select">
                                    <option selected disabled>Pilih Supir/Nomor polisi</option>
                                    {{-- @foreach ($supirs as $supir)
                                        <option @if ($supir->id)
                                            disabled
                                        @endif  value="{{ $supir->id }}"
                                            >{{ $supir->nama_supir }} / {{$supir->nomor_polisi}}
                                        </option>

                                @endforeach --}}

                                </select>

                            </div>
                        </div>


                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Remark :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea disabled data-bs-toggle="tooltip" class="form-control" id="remark_update" name="remark_update" required>{{ old('remark_update') }}</textarea>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Stuffing :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input disabled data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="biaya_stuffing_update"
                                        name="biaya_stuffing_update" placeholder="Biaya Stuffing..."
                                        value="@rupiah2(old('biaya_stuffing'))" required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Trucking :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input disabled data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="biaya_trucking_update"
                                        name="biaya_trucking_update" placeholder="Biaya Trucking..."
                                        value="@rupiah2(old('biaya_trucking'))" required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Ongkos Supir :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input type="hidden" id="old_ongkos_supir" name="old_ongkos_supir">
                                    <input disabled data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="ongkos_supir_update"
                                        name="ongkos_supir_update" placeholder="Ongkos Supir..."
                                        value="@rupiah2(old('ongkos_supir'))" required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Seal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input disabled data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="biaya_seal_update"
                                        name="biaya_seal_update" placeholder="Biaya Seal..." required>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya THC POL:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input disabled data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="biaya_thc_update"
                                        name="biaya_thc_update" placeholder="Biaya THC POL..." required>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Freight:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input disabled data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="freight_update" name="freight_update"
                                        placeholder="Biaya Freight..." required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya LSS:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input disabled data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="lss_update" name="lss_update"
                                        placeholder="Biaya LSS..." required>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Jenis Mobil :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select disabled data-bs-toggle="tooltip" id="jenis_mobil_update"
                                    name="jenis_mobil_update" class="form-select" required>
                                    <option value="Mobil Sewa" @if ('Mobil Sewa') selected @endif>Mobil
                                        Sewa</option>
                                    <option value="Mobil Sendiri" @if ('Mobil Sendiri') selected @endif>Mobil
                                        Sendiri</option>
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Deposit Trucking :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <select disabled data-bs-toggle="tooltip" required @readonly(true) id="dana_update"
                                    name="dana_update" class="form-select danas">
                                    @foreach ($danas as $dana)
                                        <option value="{{ $dana->id }}"
                                            @if ($dana->id) selected @endif>
                                            {{ $dana->pj }} - @rupiah($dana->nominal)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if (count($spks) > 0)
                            <div class="row">
                                <label for="" class="col-sm-4 col-form-label">SPK-Container : </label>
                                <div class="col-sm-8 validation-container">

                                    <select disabled data-bs-toggle="tooltip" id="spk_update" multiple="multiple"
                                        name="spk_update" class="form-select" placeholde="Silahkan Pilih SPK">
                                        @foreach ($spks as $spk)
                                            <option value="{{ $spk->kode_spk }}">
                                                {{ $spk->kode_spk }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                        @endif


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="modal fade" id="modal-bl-edit">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="valid_bl_edit" name="valid_bl_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="id_container" id="id_container">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan Nomor dan Tanggal BL</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">Nomor BL :</label>

                            <div class="col-sm-8 validation-container">
                                <input required class="form-control" id="nomor_bl_edit" name="nomor_bl_edit" type="text"
                                    placeholder="Masukkan Nomor BL">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">Tanggal BL</label>
                            <div class="col-sm-8 validation-container">
                                <input required class="form-control date_activity" id="tanggal_bl_edit" name="tanggal_bl_edit" type="text"
                                    placeholder="Masukkan Tanggal BL">
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">DO Fee :</label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input required class="form-control currency-rupiah" id="biaya_do_pol_edit" name="biaya_do_pol_edit" type="text"
                                        placeholder="Masukkan DO Fee">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">Tanggal DO POL:</label>
                            <div class="col-sm-8 validation-container">
                                <input required class="form-control date_activity" id="tanggal_do_pol_edit" name="tanggal_do_pol_edit" type="text"
                                placeholder="Tanggal DO POL">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnFinish2" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>







    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>



    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>

    <script>
        


        $('.modal>.modal-dialog').draggable({
            cursocr: 
            e: '.modal-header, .modal-footer'
        });
        $('.modal>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');
        $('.modal>.modal-dialog>.modal-content>.modal-footer').css('cursor', 'move');

    </script>
     <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>
     <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/datatable/extension/export_filter_kontainer_real.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/create_si.js"></script>

@endsection
