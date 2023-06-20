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
                            <h3 style="margin-left: auto !important; margin-right:auto !important"
                                class="portlet-title text-center"> {{ $planload->vessel }} ( {{ $planload->select_company }}
                                )</h3>
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
                                <tr>
                                    <td>POT (Port of Transit)</td>
                                    <td>:</td>
                                    <td>{{ $planload->pot }}</td>
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
            <div class="col-md-12">
                <div class="portlet">

                    <div class="portlet-body">


                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>DETAIL KONTAINER :</b></label>
                        </div>
                        <div class="table-responsive">

                            <table id="realisasiload_create" name="realisasiload_create" class="table table-bordered mb-0">
                                <thead class="table-danger text-nowrap">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Input</th>
                                        <th class="text-center"> </th>
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

                                    </tr>
                                </thead>
                                <tbody class="text-center" id="tbody_container">
                                    @foreach ($containers as $container)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                @if ($container->status_invoice == 'ready')
                                                    <button type="button" value="{{ $container->id }}" type="button"
                                                        onclick="update_invoice(this)"
                                                        class="btn btn-outline-primary btn-sm "><i
                                                            class="fa fa-pencil"></i></button>
                                                @else
                                                    <button type="button" value="{{ $container->id }}" type="button"
                                                        onclick="input_invoice(this)"
                                                        class="btn btn-outline-success btn-sm text-nowrap ">Input <i
                                                            class="fa fa-pencil"></i></button>
                                                @endif


                                            </td>
                                            <td>
                                                @if ($container->status_invoice == 'ready')
                                                    <div class="validation-container">
                                                        <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                            class="form-check-input check-container"
                                                            id="kontainer_check[{{ $loop->iteration }}]" name="letter"
                                                            value="{{ $container->id }}" required autofocus>

                                                    </div>
                                                @elseif ($container->status_invoice == 'done')
                                                    <input readonly disabled checked type="checkbox"
                                                        class="form-check-input"
                                                        id="kontainer_check[{{ $loop->iteration }}]">
                                                @elseif ($container->status_invoice == null)
                                                    -
                                                @endif
                                            </td>

                                            <td>@rupiah($container->price_invoice)</td>
                                            <td>{{$container->kondisi_invoice}}</td>
                                            <td>{{$container->keterangan_invoice}}</td>


                                            <td>
                                                <label disabled @readonly(true)
                                                    id="pod_container[{{ $container->id }}]">{{ old('pod_container', $container->pod_container) }}</label>

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
                                                <label disabled @readonly(true)
                                                    id="size[{{ $container->id }}]">{{ $container->size }}/{{$container->type}} </label>

                                            </td>

                                            <td>

                                                <label disabled @readonly(true)
                                                    id="nomor_kontainer[{{ $container->id }}]">{{ old('nomor_kontainer', $container->nomor_kontainer) }}</label>
                                            </td>
                                            <td>

                                                <label disabled @readonly(true)
                                                    id="cargo[{{ $container->id }}]">{{ old('cargo', $container->cargo) }}</label>

                                            </td>
                                             <td>
                                                <ol type="1.">

                                                    @foreach ($sealsc as $seal)
                                                        @if ($seal->kontainer_id == $container->id)
                                                            <li id="seal[{{ $container->id }}]">
                                                                {{ $seal->seal_kontainer }}

                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ol>



                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <!-- END Form -->
                        <div class="row row-cols-lg-auto px-3 mt-5 mb-5">

                            <div class="col-auto">
                                <button id="submit-id" type="submit" onclick="pdf_invoice()"
                                    class="btn btn-primary ">Cetak
                                    Invoice <i class="fa fa-print"></i></button>
                            </div>



                        </div>

                    </div>
                    <!-- BEGIN Portlet -->

                    <!-- END Portlet -->
                </div>
            </div>




            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
            @if (count($alihs) > 0)
                <div class="col-md-12">
                    <div class="portlet">

                        <div class="portlet-body">

                            <!-- BEGIN Form -->

                            <div class="col-md-12 text-center">
                                <label for="inputState" class="form-label"><b>ALIH KAPAL</b></label>
                            </div>
                            <div class="table-responsive">


                                <table id="table_alih_kapal_realisasi" class="table mb-0">
                                    <thead id="thead_alih" class="table-danger">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Input</th>
                                            <th class="text-center"></th>
                                            <th class="text-center">Nomor Kontainer</th>
                                            <th class="text-center">Pelayaran (Shipping Company)</th>
                                            <th class="text-center">POT</th>
                                            <th class="text-center">POD</th>
                                            <th class="text-center">Vessel/Voyage</th>
                                            <th class="text-center">Code Vessel/Voyage</th>
                                            <th class="text-center">Biaya Alih Kapal</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_alih" class="text-center">
                                        @foreach ($alihs as $alih)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    @if ($alih->container_planloads->status_invoice == 'ready')
                                                        <button type="button" value="{{ $alih->container_planloads->id }}" type="button"
                                                            onclick="update_invoice(this)"
                                                            class="btn btn-outline-primary btn-sm "><i
                                                                class="fa fa-pencil"></i></button>
                                                    @else
                                                        <button type="button" value="{{ $alih->container_planloads->id }}" type="button"
                                                            onclick="input_invoice(this)"
                                                            class="btn btn-outline-success btn-sm text-nowrap ">Input <i
                                                                class="fa fa-pencil"></i></button>
                                                    @endif


                                                </td>

                                                <td>
                                                    @if ($alih->container_planloads->status_invoice == 'ready')
                                                        <div class="validation-alih->container_planloads">
                                                            <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                                class="form-check-input check-alih->container_planloads"
                                                                id="kontainer_check[{{ $loop->iteration }}]" name="letter"
                                                                value="{{ $alih->container_planloads->id }}" required autofocus>

                                                        </div>
                                                    @elseif ($alih->container_planloads->status_invoice == 'done')
                                                        <input readonly disabled checked type="checkbox"
                                                            class="form-check-input"
                                                            id="kontainer_check[{{ $loop->iteration }}]">
                                                    @elseif ($alih->container_planloads->status_invoice == null)
                                                        -
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
                                                <td>
                                                    <button type="button" id="btn_detail" name="btn_detail"
                                                        class="btn btn-outline-info btn-sm text-nowrap"
                                                        value="{{ $alih->kontainer_alih }}"
                                                        onclick="detail_update(this)">Detail Kontainer <i
                                                            class="fa fa-eye"></i></button>

                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>


                            <div class="row row-cols-lg-auto px-3 mt-5 mb-5">
                                <div class="col-auto">
                                    <button id="submit-id1" type="submit" onclick="pdf_si_alih()"
                                        class="btn btn-info ">Cetak Invoice Alih KAPAL <i class="fa fa-print"></i></button>
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

                            <div class="row row-cols-lg-auto py-5 g-3">
                                <label for="" class="col-form-label">Filter Tabel :</label>
                                {{-- <div class="col-sm-5 col-lg-4">
                                    <input class="form-control" type="text" id="daterangepicker_vendor">
                                </div> --}}

                                <div class="col-sm-5 col-lg-4">
                                    <div class="mb-2">
                                        <!-- BEGIN Input Group -->
                                        <div class="input-group input-daterange">
                                            <input type="text" id="min" class="form-control" placeholder="From">
                                            <span class="input-group-text">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </span>
                                            <input type="text" id="max" class="form-control" placeholder="To">
                                        </div>
                                        <!-- END Input Group -->
                                    </div>
                                </div>
                                <div class="col-6">
                                    <select multiple id="pilih_vendor" name="pilih_vendor" class="form-select" onchange="filter_vendor(this)">
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->nama_vendor }}">{{ $vendor->nama_vendor }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-6">
                                    <select id="pilih_status" name="pilih_status" class="form-select" onchange="filter_status(this)">
                                        <option selected disabled>Pilih Status Bayar</option>
                                        <option value="Belum Lunas">Belum Lunas</option>
                                        <option value="Sudah Lunas">Sudah Lunas</option>

                                    </select>

                                </div>


                                <div style="" class="">
                                    <button id="add_total" type="button" onclick="bayar()"
                                    class="btn btn-success">Bayar <i class="fa fa-arrow-right"></i></button>
                                </div>


                            </div>

                            <div class="col-md-12 text-center">
                                <label for="inputState" class="form-label"><b>INVOICE</b></label>
                            </div>

                            <div class="table-responsive">


                            <table id="tabel_si" class="table mb-0">
                                <thead id="thead_alih" class="table-danger">
                                    <tr>
                                        <th>No</th>
                                        <th>Preview</th>
                                        <th></th>
                                        <th>Jenis Invoice</th>
                                        <th>Tanggal Invoice</th>
                                        <th>Nomor Invoice</th>
                                        <th>YTH</th>
                                        <th>KM</th>
                                        <th>TOTAL</th>
                                        <th>TERBAYAR</th>
                                        <th>SELISIH</th>
                                        <th class="text-end"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_alih" class="">
                                    @foreach ($pdfs as $pdf)
                                        <tr>

                                            <td>
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="text-nowrap">


                                                <a type="button" href="/preview-invoice/{{ $pdf->path }}"
                                                    class="btn btn-outline-primary btn-sm ">Preview Invoice <i
                                                        class="fa fa-eye"></i></a>

                                            </td>
                                            <td class="text-nowrap">

                                                @if ($pdf->total - $pdf->terbayar == 0)
                                                <input readonly disabled checked type="checkbox"
                                                    class="form-check-input"
                                                    id="kontainer_check[{{ $loop->iteration }}]">
                                                @elseif ($pdf->total - $pdf->terbayar > 0)
                                                <div class="validation-container">
                                                    <input data-tagname={{ $loop->iteration }} type="checkbox"
                                                        class="form-check-input check-container2"
                                                        id="kontainer_check[{{ $loop->iteration }}]" name="letter"
                                                        value="{{ $pdf->id }}" required autofocus>

                                                </div>

                                                @endif

                                            </td>


                                            <td>

                                                @if ($pdf->status == 'Default')
                                                    <span class="badge badge-label-success">NORMAL</span>
                                                @else
                                                    <span class="badge badge-label-primary">ALIH-KAPAL</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($pdf->tanggal_invoice != null)
                                                    {{ \Carbon\Carbon::parse($pdf->tanggal_invoice)->isoFormat('dddd, DD MMMM YYYY') }}
                                                @else
                                                    -
                                                @endif

                                            </td>
                                            <td>
                                                {{ $pdf->nomor_invoice }}

                                            </td>

                                            <td>
                                                {{ $pdf->yth }}

                                            </td>
                                            <td>
                                                {{ $pdf->km }}

                                            </td>
                                            <td>
                                                @rupiah($pdf->total)

                                            </td>
                                            <td>
                                                @rupiah($pdf->terbayar)

                                            </td>
                                            <td>
                                                @rupiah($pdf->total - $pdf->terbayar)

                                            </td>

                                            <td>
                                                <button type="button" value="{{ $pdf->id }}"
                                                    onclick="delete_invoice(this)" class="btn btn-outline-danger btn-sm "><i
                                                        class="fa fa-trash"></i></button>
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
                        <h5 class="modal-title">Masukkan Detail Invoice Kontainer</h5>
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
                                        id="price_invoice" name="price_invoice" placeholder="Unit Price..." required>

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
                        <button type="submit" id="btnFinish1" class="btn btn-success">Simpan</button>
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
                        <h5 class="modal-title">Edit Detail Invoice Kontainer</h5>
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
                                        required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Pilih Kondisi:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="kondisi_invoice_edit" name="kondisi_invoice_edit"
                                    class="form-select" required>
                                    <option value="DP" @if ('DP') selected @endif>DP
                                    </option>
                                    <option value="DD" @if ('DD') selected @endif>DD
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
                        <button type="submit" id="btnFinish2" class="btn btn-success">Simpan</button>
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
                                    <input class="form-check-input" type="radio" name="ppn" value="1" id="ppn"> Yes

                                </label>
								<label class="form-check-label px-4" for="ppn">
                                    <input class="form-check-input" type="radio" name="ppn" value="0" id="ppn" checked> No

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
                                    <input class="form-check-input" type="radio" name="materai" id="materai" value="1" onclick="document.getElementById('value_materai').disabled = false;"> Yes

                                </label>
								<label class="form-check-label px-4" for="flexRadioDefault2">
                                    <input class="form-check-input" type="radio" name="materai" id="materai" value="0" checked onclick="document.getElementById('value_materai').disabled = true;"> No

                                </label>
                            </div>
                            <div class="col-4">
                                <input class="form-control col-4 currency-rupiah" id="value_materai" name="value_materai" type="text"
                                placeholder="ex (10.000)">
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
                            <label class="col-sm-4 col-form-label" for="">Nominal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="terbayar" name="terbayar" placeholder="Nominal..."
                                        required onblur="blur_terbayar(this)">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-6 col-form-label" for="">Total Selisih : <label id="selisih" class="currency-rupiah"> </label></label>
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






    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>

    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/invoice.js"></script>

    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>

    <script>
        $(document).ready(function() {
            var check = $(".check-container");

            $("#submit-id").attr("disabled", "disabled");
            check.click(function() {
                if ($(this).is(":checked")) {
                    $("#submit-id").removeAttr("disabled");
                } else {
                    $("#submit-id").attr("disabled", "disabled");
                }
            });

            var check = $(".check-container1");

            $("#submit-id1").attr("disabled", "disabled");
            check.click(function() {
                if ($(this).is(":checked")) {
                    $("#submit-id1").removeAttr("disabled");
                } else {
                    $("#submit-id1").attr("disabled", "disabled");
                }
            });

            var check2 = $(".check-container2");

            $("#add_total").attr("disabled", "disabled");
            check2.click(function() {
                if ($(this).is(":checked")) {
                    $("#add_total").removeAttr("disabled");
                } else {
                    $("#add_total").attr("disabled", "disabled");
                }
            });


            // var radiom = $("#materai")
            $("#value_materai").attr("disabled", "disabled");
            // radiom.click(function() {
            //     if ($(this).val() == "no") {
            //         $("#value_materai").attr("disabled", "disabled");
            //     } else{
            //         $("#value_materai").removeAttr("disabled");
            //     }
            // });
        });

        $('.modal>.modal-dialog').draggable({
                cursor: 'move',
                handle: '.modal-header, .modal-footer'
        });
        $('.modal>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');
        $('.modal>.modal-dialog>.modal-content>.modal-footer').css('cursor', 'move');



    </script>


@endsection
