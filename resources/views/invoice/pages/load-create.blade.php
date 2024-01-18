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
                            <a href="/invoice-load" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="text-primary fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text text-primary">Load</span>
                            </a>
                            <a href="/processload-create/{{ $planload->slug }}" class="breadcrumb-item">
                                <span class="breadcrumb-text text-success">Process</span>
                            </a>

                            <a href="/invoice-load" class="breadcrumb-item">
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
                                class="portlet-title text-center"><u> {{ $planload->vessel }} (
                                    {{ $planload->select_company }}
                                    )</u></h3>
                        </div>
                        <div class="col-md-12 mb-3 table-responsive">
                            <table border="0" style="margin-left: auto; margin-right:auto">
                                <tr>
                                    <td width="47%">Vessel/Voyage</td>
                                    <td width="3%">:</td>
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
                                    <td>Activity</td>
                                    <td>:</td>
                                    <td>{{ $planload->activity }}</td>
                                </tr>
                                <tr>
                                    <td>POL (Port of Loading)</td>
                                    <td>:</td>
                                    <td>{{ $planload->pol }}</td>
                                </tr>



                            </table>
                            <div class="text-center mt-3">
                                <a href="/processload-create/{{ $planload->slug }}" class="btn btn-success ">to Process <i
                                        class="fa fa-arrow-right"></i>
                                </a>
                            </div>

                        </div>





                        <!-- END Form -->


                    </div>
                    <!-- BEGIN Portlet -->

                    <!-- END Portlet -->
                </div>
            </div>


            @if (count($pdfs_si) > 0)
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
                                    <select id="pilih_status_si" name="pilih_status_si" class="form-select pilih"
                                        onchange="filter_status(this)">
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
                                        <th class="">Progress</th>
                                        <th class="">Jenis SI</th>
                                        <th class="">Nomor Invoice</th>
                                        <th class="">Kontainer</th>
                                        <th class="">Shipper</th>
                                        <th class="">Consigne</th>
                                        <th class="">Nomor BL</th>
                                        <th class="">Tanggal BL</th>
                                        <th class="">Tanggal DO</th>
                                        <th class="">BL Fee</th>
                                        <th class="">DO Fee</th>




                                    </tr>
                                </thead>
                                <tbody id="tbody_alih" class="">
                                    @foreach ($pdfs_si as $pdf)
                                        <tr>
                                            <td align="center">

                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="text-nowrap">
                                                <input type="hidden" name="container_id" id="container_id"
                                                    value="{{ $pdf->container_id }}">
                                                @if ($pdf->status_si == 'Default')
                                                    <button data-id="{{ $pdf->container_id }}"
                                                        data-bs-target="modal_invoice_si" type="button"
                                                        value="{{ $pdf->container_id }}" onclick="input_invoice_si(this)"
                                                        class="btn btn-success btn-sm ">Invoice <i
                                                            class="fa fa-pencil"></i></button>
                                                @else
                                                    <button data-id="{{ $pdf->container_id }}"
                                                        data-bs-target="modal_invoice_si" type="button"
                                                        value="{{ $pdf->container_id }}"
                                                        onclick="input_invoice_si_alih(this)"
                                                        class="btn btn-primary btn-sm ">Invoice Alih Kapal <i
                                                            class="fa fa-ship"></i></button>
                                                @endif


                                                <a type="button" href="/preview-si/{{ $pdf->path }}"
                                                    class="btn btn-info btn-sm ">SI <i class="fa fa-eye"></i></a>



                                            </td>

                                            <td class="align-middle text-nowrap">

                                                @if ($pdf->containers->status_invoice == null)
                                                    <span class="badge badge-label-danger fs-6">Invalid</span>
                                                @else
                                                    <span class="badge badge-label-success fs-6">Valid</span>
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
                                                @if ($pdf->containers->status_invoice == null)
                                                    -
                                                @else
                                                    {{ $pdf->containers->status_invoice }}
                                                @endif
                                            </td>
                                            <td>
                                                <ol type="1.">

                                                    @foreach ($container_si as $container)
                                                        @if ($container->slug == $pdf->container_id)
                                                            <li>
                                                                {{ $container->nomor_kontainer }}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ol>


                                            </td>

                                            <td>
                                                {{ $pdf->shipper }}

                                            </td>
                                            <td>
                                                {{ $pdf->consigne }}

                                            </td>
                                            <td>
                                                {{ $pdf->nomor_bl }}

                                            </td>

                                            <td>
                                                @if ($pdf->tanggal_bl != null)
                                                    {{ \Carbon\Carbon::parse($pdf->tanggal_bl)->isoFormat('dddd, DD-MMMM-YYYY') }}
                                                @else
                                                    -
                                                @endif

                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($pdf->tanggal_do_pod)->isoFormat('dddd, DD-MMMM-YYYY') }}
                                            </td>
                                            <td>
                                                @rupiah($pdf->biaya_do_pol)

                                            </td>
                                            <td>
                                                @rupiah($pdf->biaya_do_pod)

                                            </td>





                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>



                            <div class="text-center mt-3">
                                <a href="/realisasi-pod-create/{{ $planload->slug }}" class="btn btn-success ">
                                    Realisasi POD <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>


                        </div>
                        <!-- BEGIN Portlet -->

                        <!-- END Portlet -->
                    </div>
                </div>
            @endif

            @if (count($container_batal) > 0)
                <div class="col-md-12">
                    <div class="portlet">

                        <div class="portlet-body">

                            <!-- BEGIN Form -->

                            <div class="col-md-12 text-center">
                                <label for="inputState" class="form-label"><u><b>KONTAINER BATAL MUAT</b></u></label>
                            </div>
                            <div class="table-responsive">


                                <table id="table_batal" class="table table-bordered table-hover mb-0 seratus">
                                    <thead id="thead_alih" class="table-danger text-nowrap">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center"></th>
                                            <th class="text-center">Input</th>
                                            <th class="text-center">Progress</th>
                                            <th class="text-center">NOMOR INVOICE</th>
                                            <th class="text-center">UNIT PRICE</th>
                                            <th class="text-center">KONDISI</th>
                                            <th class="text-center">KETERANGAN</th>
                                            <th class="text-center">POD</th>
                                            <th class="text-center">Pengirim</th>
                                            <th class="text-center">Penerima</th>
                                            <th class="text-center">Size/Type</th>
                                            <th class="text-center">Nomor Kontainer</th>
                                            <th class="text-center">Cargo (Nama Barang)</th>
                                            <th class="text-center">Seal-Container</th>
                                            <th class="text-center">Biaya Batal Muat Kapal</th>
                                            <th class="text-center">Keterangan Batal Muat</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_alih" class="">
                                        @foreach ($container_batal as $batal)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>



                                                <td>
                                                    @if ($batal->invoices->path == null && $container->price_invoice != null)
                                                        <div class="validation-container">
                                                            <input type="hidden" value="{{ $batal->status_invoice }}"
                                                                class="{{ $batal->status_invoice }}">
                                                            <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                                class="form-check-input check_kontainer_batal"
                                                                id="kontainer_check[{{ $loop->iteration }}]"
                                                                name="{{ $batal->status_invoice }}"
                                                                value="{{ $batal->id }}" autofocus
                                                                onclick="click_check(this)">
                                                        </div>
                                                    @elseif ($batal->invoices->path != null)
                                                        <input readonly disabled checked type="checkbox"
                                                            class="form-check-input"
                                                            id="kontainer_check[{{ $loop->iteration }}]">
                                                    @elseif ($batal->price_invoice == null)
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($batal->price_invoice != null)
                                                        <button type="button" value="{{ $batal->id }}"
                                                            type="button" onclick="update_invoice(this)"
                                                            class="btn btn-primary btn-sm "><i
                                                                class="fa fa-pencil"></i></button>
                                                    @else
                                                        <button type="button" value="{{ $batal->id }}"
                                                            type="button" onclick="input_invoice(this)"
                                                            class="btn btn-success btn-sm text-nowrap ">Input <i
                                                                class="fa fa-pencil"></i></button>
                                                    @endif


                                                </td>
                                                <td>
                                                    @if ($batal->status_invoice == null)
                                                        <span class="badge badge-label-danger fs-6">Invalid</span>
                                                    @else
                                                        <span class="badge badge-label-success fs-6">Valid</span>
                                                    @endif
                                                </td>

                                                <td>{{ $batal->status_invoice }}</td>
                                                <td>@rupiah($batal->price_invoice)</td>
                                                <td>{{ $batal->kondisi_invoice }}</td>
                                                <td>{{ $batal->keterangan_invoice }}</td>
                                                <td>
                                                    <label disabled @readonly(true)
                                                        id="pod_container[{{ $batal->id }}]">{{ old('pod_container', $batal->pod_container) }}</label>
                                                </td>
                                                <td>
                                                    <label disabled @readonly(true)
                                                        id="pengirim[{{ $batal->id }}]">{{ old('pengirim', $batal->pengirim) }}</label>

                                                </td>
                                                <td>
                                                    <label disabled @readonly(true)
                                                        id="penerima[{{ $batal->id }}]">{{ old('penerima', $batal->penerima) }}</label>

                                                </td>
                                                <td>
                                                    <label disabled @readonly(true)
                                                        id="size[{{ $batal->id }}]">{{ $batal->size }}/{{ $batal->type }}
                                                    </label>

                                                </td>

                                                <td>

                                                    <label disabled @readonly(true)
                                                        id="nomor_kontainer[{{ $batal->id }}]">{{ old('nomor_kontainer', $batal->nomor_kontainer) }}</label>
                                                </td>
                                                <td>

                                                    <label disabled @readonly(true)
                                                        id="cargo[{{ $batal->id }}]">{{ old('cargo', $batal->cargo) }}</label>

                                                </td>
                                                <td>
                                                    <ol type="1.">

                                                        @foreach ($sealsc as $seal)
                                                            @if ($seal->kontainer_id == $batal->id)
                                                                <li>
                                                                    {{ $seal->seal_kontainer }}

                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ol>



                                                </td>

                                                <td>
                                                    <label id="harga_batal[{{ $loop->iteration }}]">
                                                        @rupiah($batal->harga_batal)</label>

                                                </td>
                                                <td>
                                                    <label id="keterangan_alih_kapal[{{ $loop->iteration }}]">
                                                        {{ $batal->keterangan_batal }}</label>

                                                </td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>


                            <div class="row row-cols-lg-auto px-3 mt-5 mb-5">
                                <div class="col-auto">
                                    <button id="submit_batal" type="submit" onclick="pdf_invoice_batal()"
                                        class="btn btn-success ">Cetak Invoice Batal Muat <i
                                            class="fa fa-print"></i></button>
                                </div>


                            </div>

                        </div>
                    </div>
                    <!-- BEGIN Portlet -->

                    <!-- END Portlet -->
                </div>
            @endif




            <!-- BEGIN Portlet -->

            <!-- END Portlet -->

            @if (count($pdfs) > 0)
                <div class="col-md-12">
                    <div class="portlet">

                        <div class="portlet-body">

                            <!-- BEGIN Form -->

                            <div class="row row-cols-lg-auto py-5 g-3">
                                <label for="" class="col-form-label">Filter Tabel :</label>
                                {{-- <div class="col-sm-5 col-lg-4">
                                    <input class="form-control" type="text" id="daterangepicker_vendor">
                                </div> --}}

                                <div class="col-sm-5 col-lg-4">
                                    <div class="mb-2">
                                        <!-- BEGIN Input Group -->
                                        <div class="input-group input-daterange">
                                            <input type="text" id="min" class="form-control"
                                                placeholder="From">
                                            <span class="input-group-text">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </span>
                                            <input type="text" id="max" class="form-control" placeholder="To">
                                        </div>
                                        <!-- END Input Group -->
                                    </div>
                                </div>
                                <div class="col-6">
                                    <select multiple id="pilih_vendor" name="pilih_vendor" class="form-select"
                                        onchange="filter_vendor(this)">
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->nama_vendor }}">{{ $vendor->nama_vendor }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-6">
                                    <select id="pilih_status" name="pilih_status" class="form-select"
                                        onchange="filter_status(this)">
                                        <option selected disabled>Pilih Status Bayar</option>
                                        <option value="Belum Lunas">Belum Lunas</option>
                                        <option value="Sudah Lunas">Sudah Lunas</option>

                                    </select>

                                </div>





                            </div>

                            <div class="col-md-12 text-center">
                                <label for="inputState" class="form-label"><u><b>INVOICE</b></u></label>
                            </div>

                            <div class="table-responsive">


                                <table id="tabel_invoice" class="table table-bordered table-hover mb-0 seratus">
                                    <thead id="thead_alih" class="table-danger">
                                        <tr>
                                            <th>No</th>
                                            <th></th>
                                            <th></th>
                                            <th>Progress Bayar</th>
                                            <th>Jenis Invoice</th>
                                            <th>Tanggal Invoice</th>
                                            <th>Nomor Invoice</th>

                                            <th>TOTAL</th>
                                            <th>DITAGIH</th>
                                            <th>DITERIMA</th>
                                            <th>YTH</th>
                                            <th>KM</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_alih" class="">
                                        @foreach ($pdfs as $pdf_inv)
                                            @if ($pdf_inv->tanggal_invoice != null)
                                                <tr>

                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-nowrap text-center">

                                                        @if ($pdf_inv->kirim == 0)
                                                        <button type="button" value="{{ $pdf_inv->id }}"
                                                            onclick="kirim_invoice(this)"
                                                            class="btn btn-label-success btn-sm "><i
                                                                class="bi bi-send-check-fill"></i></button>
                                                        @elseif ($pdf_inv->total - $pdf_inv->terbayar == 0)
                                                        <button type="button" value="{{ $pdf_inv->id }}"
                                                            onclick="batal_kirim_invoice(this)"
                                                            class="btn btn-label-danger btn-sm "><i
                                                                class="bi bi-send-dash-fill"></i></button>
                                                            <input readonly disabled checked type="checkbox"
                                                                class="form-check-input"
                                                                id="kontainer_check[{{ $loop->iteration }}]">
                                                            
                                                        @elseif ($pdf_inv->total - $pdf_inv->terbayar > 0 && $pdf_inv->kirim == 1)
                                                            <div class="validation-container">
                                                                 <button type="button" value="{{ $pdf_inv->id }}"
                                                                    onclick="batal_kirim_invoice(this)"
                                                                    class="btn btn-label-danger btn-sm "><i
                                                                        class="bi bi-send-dash-fill"></i></button>
                                                                <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                                    class="form-check-input check-container2"
                                                                    id="kontainer_check[{{ $loop->iteration }}]"
                                                                    name="letter" value="{{ $pdf_inv->id }}" autofocus>

                                                               

                                                            </div>
                                                        @endif

                                                    </td>

                                                    <td class="text-nowrap">


                                                        <a type="button" href="/preview-invoice/{{ $pdf_inv->path }}"
                                                            class="btn btn-info btn-sm ">Invoice <i
                                                                class="fa fa-eye"></i></a>
                                                       
                                                        <button type="button" value="{{ $pdf_inv->id }}"
                                                            onclick="delete_invoice(this)"
                                                            class="btn btn-danger btn-sm "><i
                                                                class="fa fa-trash"></i></button>

                                                    </td>

                                                    <td>

                                                        <div class="widget4">
                                                            <div class="widget4-group">
                                                                <div class="widget4-addon">
                                                                    
                                                                        <h2 class="widget4-subtitle">
                                                                            {{ round(($pdf_inv->terbayar / $pdf_inv->total) * 100) }}%
                                                                        </h2>
                                                                    
                                                                </div>
                                                            </div>
                                                            @if (round(($pdf_inv->terbayar / $pdf_inv->total) * 100) == 100)
                                                                <div class="progress progress-sm">
                                                                    <div class="progress-bar bg-success"
                                                                        style="width: 100%"></div>
                                                                </div>
                                                            @else
                                                                <div class="progress progress-sm">
                                                                    <div class="progress-bar bg-danger"
                                                                        style="width: {{ round(($pdf_inv->terbayar / $pdf_inv->total) * 100) }}%"></div>
                                                                </div>
                                                            @endif
                                                            <div class="widget4-group">
                                                                <div class="widget4-addon">
                                                                    <h2 class="widget4-subtitle">Progress Bayar</h2>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- <div class="widget4">
                                                                <div class="widget4-group">
                                                                    <div class="widget4-display">
                                                                        <h6 class="widget4-subtitle">20%</h6>
                                                                    </div>
                                                                </div>
                                                                <!-- BEGIN Progress -->
                                                                <div class="progress progress-sm">
                                                                    <div class="progress-bar bg-primary" style="width: 20%"></div>
                                                                </div>
                                                                <!-- END Progress -->
                                                            </div> --}}



                                                    </td>



                                                    <td class="align-middle text-nowrap">
                                                        @if ($pdf_inv->status == 'Alih-Kapal' || $pdf_inv->status == 'Realisasi-Alih')
                                                            <i class="marker marker-dot text-primary"></i>ALIH-KAPAL
                                                        @elseif ($pdf_inv->status == 'Batal-Muat')
                                                            <i class="marker marker-dot text-danger"></i>BATAL-MUAT
                                                        @else
                                                            <i class="marker marker-dot text-success"></i> BIASA
                                                        @endif


                                                    </td>
                                                    <td>
                                                        @if ($pdf_inv->tanggal_invoice != null)
                                                            {{ \Carbon\Carbon::parse($pdf_inv->tanggal_invoice)->isoFormat('dddd, DD MMMM YYYY') }}
                                                        @else
                                                            -
                                                        @endif

                                                    </td>
                                                    <td>
                                                        {{ $pdf_inv->nomor_invoice }}

                                                    </td>

                                                    <td>
                                                        @rupiah($pdf_inv->total)

                                                    </td>

                                                    <td>
                                                        @rupiah($pdf_inv->total - $pdf_inv->terbayar)

                                                    </td>
                                                    <td>
                                                        @rupiah($pdf_inv->terbayar)

                                                    </td>

                                                    <td>
                                                        {{ $pdf_inv->yth }}

                                                    </td>
                                                    <td>
                                                        {{ $pdf_inv->km }}

                                                    </td>




                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div style="" class="text-center">
                                <button id="add_total" type="button" onclick="bayar()" class="btn btn-success">Dana
                                    Telah Terima <i class="fa fa-check"></i></button>
                            </div>


                        </div>
                        <!-- BEGIN Portlet -->

                        <!-- END Portlet -->
                    </div>
                </div>
            @endif


            @if (count($reports) > 0)
                <div class="col-md-12 col-xl-12">

                    <div class="portlet">
                        <div class="portlet-header portlet-header-bordered">
                            <h3 class="portlet-title text-center"><u><b>HISTORY PEMBAYARAN</b></u></h3>
                        </div>
                        <div class="portlet-body">
                            <hr>



                            <!-- BEGIN Datatable -->
                            <table id="tabel_bayar_invoice"
                                class="table table-bordered table-striped table-hover autosize mt-5" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th></th>
                                        <th>Nomor Invoice</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Total Dibayar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        {{-- @foreach ($report as $item) --}}

                                        {{-- @endforeach --}}
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-nowrap text-center">
                                                {{-- @foreach ($report as $item) --}}


                                                <button type="button" value="{{ $report[0]->slug }}"
                                                    onclick="delete_history(this)" class="btn btn-danger btn-sm "><i
                                                        class="fa fa-refresh"></i></button>


                                                {{-- @endforeach --}}
                                            </td>
                                            <td>
                                                @foreach ($report as $item)
                                                    <li>{{ $item->invoices->nomor_invoice }}</li>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($report[0]->tanggal_bayar != null)
                                                    <input type="hidden" id="date[{{ $loop->iteration }}]"
                                                        name="date"
                                                        value="{{ \Carbon\Carbon::parse($report[0]->tanggal_bayar)->isoFormat('dddd, DD MMMM YYYY') }}">
                                                    {{ \Carbon\Carbon::parse($report[0]->tanggal_bayar)->isoFormat('dddd, DD MMMM YYYY') }}
                                                @endif
                                            </td>

                                            <td>
                                                @rupiah($report[0]->pembayaran)
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
            @endif



        </form>
    </div>


    <div class="modal fade" id="modal_invoice">
        <div class="modal-dialog modal-dialog-centered">

            <form class="modal-content" id="valid_invoice" name="valid_invoice">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="id_container" id="id_container">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan Detail Invoice Kontainer :</h5>
                        <br>
                        <h5 class="modal-title" style="margin-left: 10px; margin-right:auto;" id="nomor_kontainer_modal">
                        </h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3">

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Unit Price :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah"
                                        id="price_invoice" name="price_invoice" placeholder="Unit Price..."
                                        onblur="blur_selisih(this)" autofocus required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Total Biaya Container :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input readonly data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="total_biaya_kontainer"
                                        name="total_biaya_kontainer">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Selisih :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input readonly data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="selisih_price" name="selisih_price">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Kondisi:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <select data-bs-toggle="tooltip" id="kondisi_invoice" name="kondisi_invoice"
                                    class="form-select" required>
                                    <option value="DP" @if ('DP') selected @endif>Door to Port
                                    </option>
                                    <option value="DC" @if ('DC') selected @endif>Door to Cy
                                    </option>
                                    <option value="DD" @if ('DD') selected @endif>Door to Door
                                    </option>
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Keterangan :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_invoice" name="keterangan_invoice" required>{{ old('keterangan_invoice') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <h5 id="total_biaya_kontainer" class="modal-title"></h5>
                        <button type="submit" id="btnFinish1" class="btn btn-outline-success">Simpan</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" data-bs-backdrop="static" id="modal_invoice_si">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">

            <form class="modal-content" id="valid_invoice_si" name="valid_invoice_si">
                {{-- @csrf --}}
                {{-- {{ csrf_field() }} --}}


                <input type="hidden" name="new_slug" id="new_slug">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan Detail Invoice Kontainer :</h5>
                        <br>
                        <h5 class="modal-title" style="margin-left: 10px; margin-right:auto;" id="nomor_kontainer_modal">
                        </h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3">
                        <table id="table_modal_container">
                            <thead class="text-center">
                                <tr>

                                    <th>No.</th>
                                    <th>Nomor Kontainer</th>
                                    <th>Size/Type</th>
                                    <th>Biaya Kontainer</th>
                                    <th>Unit Price</th>
                                    <th>Kondisi</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_modal_container">


                            </tbody>

                        </table>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Total Unit Price :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input type="hidden" id="status" name="status">

                                    <input readonly data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="total_price_invoice_si"
                                        name="total_price_invoice_si" placeholder="Total Unit Price..." autofocus
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Total Biaya Kontainer :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input autofocus required readonly data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="total_biaya_kontainer_si"
                                        name="total_biaya_kontainer_si">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Selisih :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input readonly data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="selisih_price_si"
                                        name="selisih_price_si">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">Ditagihkan ke :</label>
                            <div class="col-sm-8 validation-container">
                                <input required class="form-control" id="yth_si" name="yth_si" type="text"
                                    placeholder="Masukkan Kepda YTH....">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">KM :</label>
                            <div class="col-sm-8 validation-container">
                                <input required class="form-control" id="km_si" name="km_si" type="text"
                                    placeholder="Masukkan KM">
                            </div>
                        </div>
                        <div class="row g-2">
                            <label class="col-sm-4 col-form-label" for="text">PPN :</label>

                            <div class="col-4 form-check g-3">
                                <label class="form-check-label px-3" for="ppn">
                                    <input class="form-check-input" type="radio" name="ppn_si" value="1"
                                        id="ppn_si"> Yes

                                </label>
                                <label class="form-check-label px-4" for="ppn_si">
                                    <input class="form-check-input" type="radio" name="ppn_si" value="0"
                                        id="ppn_si" checked> No

                                </label>
                            </div>

                        </div>
                        <div class="row g-2">
                            <label class="col-sm-4 col-form-label" for="text">METERAI :</label>

                            <div class="col-4 form-check g-3">
                                <label class="form-check-label px-3" for="ppn2">
                                    <input class="form-check-input" type="radio" name="materai_si" id="materai_si"
                                        value="1"
                                        onclick="document.getElementById('value_materai_si').disabled = false;"> Yes

                                </label>
                                <label class="form-check-label px-4" for="flexRadioDefault2">
                                    <input class="form-check-input" type="radio" name="materai_si" id="materai_si"
                                        value="0" checked
                                        onclick="document.getElementById('value_materai_si').disabled = true;"> No

                                </label>
                            </div>
                            <div class="col-4">
                                <input disabled class="form-control col-4 currency-rupiah" id="value_materai_si"
                                    name="value_materai_si" type="text" placeholder="ex (10.000)">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <h5 id="total_biaya_kontainer" class="modal-title"></h5>
                        <button type="submit" id="btnFinish1" class="btn btn-outline-success">Simpan</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="modal_invoice_edit">
        <div class="modal-dialog modal-dialog-centered">

            <form class="modal-content" id="valid_invoice_edit" name="valid_invoice_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="id_container_edit" id="id_container_edit">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Detail Invoice/Kontainer:</h5>
                        <br>
                        <h5 class="modal-title" style="margin-left: 10px; margin-right:auto;" id="nomor_kontainer_edit">
                        </h5>

                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Unit Prize :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah"
                                        id="price_invoice_edit" name="price_invoice_edit" placeholder="Unit Price..."
                                        onblur="blur_selisih_edit(this)" required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Total Biaya Container :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input readonly data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="total_biaya_kontainer_edit"
                                        name="total_biaya_kontainer_edit">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Selisih :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input readonly data-bs-toggle="tooltip" type="text"
                                        class="form-control currency-rupiah" id="selisih_price_edit"
                                        name="selisih_price_edit">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Kondisi:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="kondisi_invoice_edit" name="kondisi_invoice_edit"
                                    class="form-select" required>
                                    <option value="DP" @if ('DP') selected @endif>Door to Port
                                    </option>
                                    <option value="DC" @if ('DC') selected @endif>Door to Cy
                                    </option>
                                    <option value="DD" @if ('DD') selected @endif>Door to Door
                                    </option>
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Keterangan :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <textarea data-bs-toggle="tooltip" class="form-control" id="keterangan_invoice_edit" name="keterangan_invoice_edit"
                                    required>{{ old('keterangan_invoice_edit') }}</textarea>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnFinish2" class="btn btn-outline-success">Simpan</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal_pdf_invoice">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" action="#" id="valid_pdf_invoice" name="valid_pdf_invoice">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan Keterangan Invoice</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">Ditagihkan ke :</label>
                            <div class="col-sm-8 validation-container">
                                <input required class="form-control" id="yth" name="yth" type="text"
                                    placeholder="Masukkan Kepda YTH....">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="text">KM :</label>
                            <div class="col-sm-8 validation-container">
                                <input required class="form-control" id="km" name="km" type="text"
                                    placeholder="Masukkan KM">
                            </div>
                        </div>
                        <div class="row g-2">
                            <label class="col-sm-4 col-form-label" for="text">PPN :</label>

                            <div class="col-4 form-check g-3">
                                <label class="form-check-label px-3" for="ppn">
                                    <input class="form-check-input" type="radio" name="ppn" value="1"
                                        id="ppn"> Yes

                                </label>
                                <label class="form-check-label px-4" for="ppn">
                                    <input class="form-check-input" type="radio" name="ppn" value="0"
                                        id="ppn" checked> No

                                </label>
                            </div>
                            {{-- <div class="col-4">
                                <input class="form-control col-4" id="value_ppn" name="value_ppn" type="text"
                                placeholder="Masukkan PPN">
                            </div> --}}
                        </div>
                        <div class="row g-2">
                            <label class="col-sm-4 col-form-label" for="text">METERAI :</label>

                            <div class="col-4 form-check g-3">
                                <label class="form-check-label px-3" for="ppn2">
                                    <input class="form-check-input" type="radio" name="materai" id="materai"
                                        value="1"
                                        onclick="document.getElementById('value_materai').disabled = false;"> Yes

                                </label>
                                <label class="form-check-label px-4" for="flexRadioDefault2">
                                    <input class="form-check-input" type="radio" name="materai" id="materai"
                                        value="0" checked
                                        onclick="document.getElementById('value_materai').disabled = true;"> No

                                </label>
                            </div>
                            <div class="col-4">
                                <input class="form-control col-4 currency-rupiah" id="value_materai" name="value_materai"
                                    type="text" placeholder="ex (10.000)">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnFinish3" class="btn btn-success">Buatkan Invoice</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal_total">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="valid_total" name="valid_total">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="id_container" id="id_container">
                <input type="hidden" name="old_terbayar" id="old_terbayar">
                <input type="hidden" name="old_selisih" id="old_selisih">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan Nominal Invoice Yang Ingin Dibayar</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3">
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Bayar :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input data-bs-toggle="tooltip" type="text" class="form-control date_activity"
                                    id="tanggal_bayar" name="tanggal_bayar" placeholder="Tanggal Bayar..." required>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Nominal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah"
                                        id="terbayar" name="terbayar" placeholder="Nominal..." required
                                        onblur="blur_terbayar(this)">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-6 col-form-label" for="">Total Selisih : <label id="selisih"
                                    class="currency-rupiah"> </label></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn_history" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>






    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>

    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/invoice.js"></script>

    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>

    <script>
        $("#modal_invoice_si").css("display", "none");


        $('.modal>.modal-dialog').draggable({
            cursor: 'move',
            handle: '.modal-header, .modal-footer'
        });
        $('.modal>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');
        $('.modal>.modal-dialog>.modal-content>.modal-footer').css('cursor', 'move');
    </script>


@endsection
