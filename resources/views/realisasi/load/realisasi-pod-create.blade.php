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

              <a href="/realisasi-load-create/{{ $planload->slug }}" class="breadcrumb-item">
                <span class="breadcrumb-text text-danger">Realisasi POL</span>

              </a>
              <a href="/realisasi-pod" class="breadcrumb-item">
                @if ($active == 'Plan')
                  <span class="breadcrumb-text text-warning">{{ $active }}</span>
                @endif
                @if ($active == 'Process')
                  <span class="breadcrumb-text text-success">{{ $active }}</span>
                @endif
                @if ($active == 'Realisasi POD')
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
              <h1 style="margin-left: auto !important; margin-right:auto !important" class="portlet-title text-center">
                KAPAL :
              </h1>
              <h3 style="margin-left: auto !important; margin-right:auto !important" class="portlet-title text-center"><u>
                  {{ $planload->vessel }} (
                  {{ $planload->select_company }}
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
                <a href="/realisasi-load-create/{{ $planload->slug }}" class="btn btn-success "><i
                    class="fa fa-arrow-left"></i> Realisasi (POL)
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
            <div class="col-auto">

            </div>


            <div class="col-md-12 text-center">
              <label for="inputState" class="form-label"><u><b>DETAIL KONTAINER :</b></u></label>
            </div>

            <div class="row row-cols-lg-auto py-5 g-3">
              <label for="" class="col-form-label">Filter Tabel :</label>

              <div class="col-6">
                <select id="pilih_pod" name="pilih_pod" class="form-select pilih" onchange="filter_status(this)">
                  <option selected disabled>Pilih POD</option>
                  @foreach ($pelabuhans as $pelabuhan)
                    <option value="{{ $pelabuhan->nama_pelabuhan }}">
                      {{ $pelabuhan->nama_pelabuhan }}/{{ $pelabuhan->area_code }}</option>
                  @endforeach

                </select>

              </div>
              <div class="col-6">
                <select id="pilih_pot" name="pilih_pot" class="form-select pilih" onchange="filter_status(this)">
                  <option selected disabled>Pilih POT</option>
                  @foreach ($pelabuhans as $pelabuhan)
                    <option value="{{ $pelabuhan->nama_pelabuhan }}">
                      {{ $pelabuhan->nama_pelabuhan }}/{{ $pelabuhan->area_code }}</option>
                  @endforeach

                </select>

              </div>
              <div class="col-6">
                <select id="pilih_size" name="pilih_size" class="form-select pilih" onchange="filter_status(this)">
                  <option selected disabled>Pilih Size</option>
                  @foreach ($sizes as $size)
                    <option value="{{ $size->size_container }}">{{ $size->size_container }}</option>
                  @endforeach

                </select>

              </div>
              <div class="col-6">
                <select id="pilih_type" name="pilih_type" class="form-select pilih" onchange="filter_status(this)">
                  <option selected disabled>Pilih Type</option>
                  @foreach ($types as $type)
                    <option value="{{ $type->type_container }}">{{ $type->type_container }}</option>
                  @endforeach

                </select>

              </div>



            </div>
            <div class="table-responsive">

              <table id="realisasiload_create" name="realisasiload_create"
                class="table table-bordered table-hover mb-0 seratus">
                <thead class="table-danger text-nowrap">
                  <tr>
                    <th class="text-center">No</th>
                    <th class="">Input Biaya POD</th>
                    <th class="text-center">POD</th>
                    <th class="text-center">POT</th>
                    <th class="text-center">Nomor Kontainer</th>
                    <th class="text-center">Size</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Pengirim</th>
                    <th class="text-center">Penerima</th>
                    <th class="text-center">Seal-Container</th>
                    <th class="text-center">Cargo (Nama Barang)</th>
                  </tr>
                </thead>
                <tbody class="" id="tbody_container">
                  @foreach ($containers as $container)
                    <tr>
                      <td>{{ $loop->iteration }}</td>

                      <td>
                        @if ($container->status_container == 'POD')
                          <button type="button" class="btn btn-primary btn-sm" value="{{ $container->id }}"
                            onclick="edit_biaya_do(this)">Edit
                            Biaya POD <i class="fa fa-pencil"></i>
                          </button>
                        @else
                          <button type="button" class="btn btn-success btn-sm" value="{{ $container->id }}"
                            onclick="biaya_do(this)">Input Biaya
                            POD <i class="fa fa-pencil"></i>

                          </button>
                        @endif
                      </td>



                      <td>
                        <label disabled @readonly(true)
                          id="pod_container[{{ $container->id }}]">{{ old('pod_container', $container->pod_container) }}</label>
                      </td>
                      <td>
                        <label disabled @readonly(true)
                          id="pot_container[{{ $container->id }}]">{{ old('pot_container', $container->pot_container) }}</label>
                      </td>
                      <td>
                        <label disabled @readonly(true)
                          id="nomor_kontainer[{{ $container->id }}]">{{ old('nomor_kontainer', $container->nomor_kontainer) }}</label>
                      </td>
                      <td>
                        <label disabled @readonly(true)
                          id="size[{{ $container->id }}]">{{ $container->size }}</label>
                      </td>
                      <td>
                        <label disabled @readonly(true)
                          id="type[{{ $container->id }}]">{{ $container->type }}</label>
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
                <label for="inputState" class="form-label"><u><b>KONTAINER ALIH KAPAL</b></u></label>
              </div>
              <div class="table-responsive">

                <table id="table_alih_kapal_realisasi" class="table table-bordered table-hover mb-0 seratus">
                  <thead id="thead_alih" class="table-danger tex-nowrao">
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Input Biaya POD</th>
                      <th class="text-center">Nomor Kontainer</th>
                      <th class="text-center">Pelayaran (Shipping Company)</th>
                      <th class="text-center">POT</th>
                      <th class="text-center">POD</th>
                      <th class="text-center">Vessel/Voyage</th>
                      <th class="text-center">Code Vessel/Voyage</th>
                      <th class="text-center">Biaya Alih Kapal</th>
                      <th class="text-center">Keterangan Alih Kapal</th>
                      <th class="text-center">Detail Barang Kontainer</th>
                      <th class="text-center">Biaya Lain Kontainer</th>
                    </tr>
                  </thead>
                  <tbody id="tbody_alih" class="text-center text-nowrap">
                    @foreach ($alihs as $alih)
                      <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                          @if ($alih->container_planloads->status_container == 'POD')
                            <button type="button" class="btn btn-primary btn-sm"
                              value="{{ $alih->container_planloads->id }}" onclick="edit_biaya_do(this)">Edit Biaya POD
                              <i class="fa fa-pencil"></i>
                            </button>
                          @else
                            <button type="button" class="btn btn-success btn-sm"
                              value="{{ $alih->container_planloads->id }}" onclick="biaya_do(this)">Input Biaya POD <i
                                class="fa fa-pencil"></i>
                            </button>
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
                          <ol type="1.">
                            @foreach ($details as $detail)
                              @if ($detail->kontainer_id == $alih->container_planloads->id)
                                <li id="detail[{{ $alih->container_planloads->id }}]">
                                  {{ $detail->detail_barang }}

                                </li>
                              @endif
                            @endforeach
                          </ol>
                        </td>
                        <td>
                          <ol type="1.">
                            @foreach ($biayas as $biaya)
                              @if ($biaya->kontainer_id == $alih->container_planloads->id)
                                <li id="biaya[{{ $alih->container_planloads->id }}]">
                                  @rupiah($biaya->harga_biaya) ({{ $biaya->keterangan }})

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

              <table id="tabel_si" class="table table-bordered table-hover mb-0 seratus">
                <thead id="thead_alih" class="table-danger text-nowrap">
                  <tr>
                    <th class="">No</th>
                    <th class=""></th>
                    <th class="">Jenis SI</th>
                    <th class="">Kontainer</th>
                    <th class="">Shipper</th>
                    <th class="">Consigne</th>
                    <th class="">Tanggal BL</th>
                    <th class="">Nomor BL</th>
                    <th class="">Tanggal DO</th>
                    <th class="">DO FEE</th>


                  </tr>
                </thead>
                <tbody id="tbody_alih" class="text-nowrap">
                  @foreach ($pdfs as $pdf)
                    <tr>

                      <td>
                        {{ $loop->iteration }}
                      </td>
                      <td class="text-center">
                        <button type="button" value="{{ $pdf->id }}" onclick="delete_SI(this)"
                          class="btn btn-danger btn-sm "><i class="fa fa-trash"></i></button>
                        <a type="button" href="/preview-si/{{ $pdf->path }}" class="btn btn-info btn-sm ">SI <i
                            class="fa fa-eye"></i></a>
                        @if ($pdf->status == 'POD')
                          <button type="button" value="{{ $pdf->id }}" type="button"
                            onclick="do_fee_edit(this)" class="btn btn-primary btn-sm ">Edit
                            DO <i class="fa fa-pencil"></i></button>
                        @elseif ($sums[$loop->iteration - 1] != null || $sums[$loop->iteration - 1] == 0)
                          <button type="button" value="{{ $pdf->id }}" type="button"
                            onclick="input_biaya_do(this)" class="btn btn-success btn-sm ">Input DO <i
                              class="fa fa-pencil"></i></button>
                        @endif
                      </td>
                      <td>

                        @if ($pdf->status_si == 'Default')
                          <i class="marker marker-dot text-success"></i> BIASA
                        @else
                          <i class="marker marker-dot text-primary"></i>ALIH-KAPAL
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
                        @if ($pdf->tanggal_do_pod != null)
                          {{ \Carbon\Carbon::parse($pdf->tanggal_do_pod)->isoFormat('dddd, DD MMMM YYYY') }}
                        @else
                          -
                        @endif

                      </td>
                      <td>
                        @if ($pdf->biaya_do_pod != null)
                          @rupiah($pdf->biaya_do_pod)
                        @else
                          -
                        @endif

                      </td>







                    </tr>
                  @endforeach

                </tbody>
              </table>

              <div class="text-center mt-3">

                <a href="/invoice-load-create/{{ $planload->slug }}" class="btn btn-success ">
                  Invoice <i class="fa fa-arrow-right"></i>
                </a>
              </div>



            </div>
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
          </div>
        </div>
      @endif



    </form>
  </div>





  <div class="modal fade" id="modal_biaya_do" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">

      <form class="modal-content" id="valid_pod" name="valid_pod">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="id_container" id="id_container">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Masukkan Biaya-Biaya POD</h5>
            <h5 id="nomor_kontainer" class="modal-title"></h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body d-grid gap-3">
            <div class="row">
              <label class="col-sm-4 col-form-label" for="">THC POD :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" for="">Rp.</span>

                  <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah" id="thc_pod"
                    name="thc_pod" placeholder="THC POD..." required>

                </div>
              </div>
            </div>
            {{-- <div class="row">
              <label class="col-sm-4 col-form-label" for="">Lolo :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" for="">Rp.</span>

                  <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah" id="lolo"
                    name="lolo" placeholder="Biaya Lolo..." required>

                </div>
              </div>
            </div> --}}

            <div class="row">
              <label class="col-sm-4 col-form-label" for="">Dooring :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" for="">Rp.</span>

                  <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah" id="dooring"
                    name="dooring" placeholder="Biaya Dooring..." required>

                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-4 col-form-label" for="">Demurrage :<span
                  class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" for="">Rp.</span>

                  <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah" id="demurrage"
                    name="demurrage" placeholder="Biaya Demurrage..." required>

                </div>
              </div>
            </div>

            <div class="text-center col-12">
              <label id="label_biaya" name="label_biaya" class="col-sm-4 col-form-label">
                <button type="button" id="button_biaya_lain" name="button_biaya_lain" value="{{ 0 }}"
                  class="btn btn-sm btn-label-success btn-sm text-nowrap" onclick="total_biaya_lain(this)">Biaya Lain <i
                    class="fa fa-plus"></i>
                </button>
              </label>
              {{-- <label class="col-sm-4 col-form-label" for="">Total Biaya Lain : </label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="total_biaya_lain" name="total_biaya_lain" placeholder="Total Biaya Lain..." >

                                </div>
                            </div> --}}
            </div>
            <div id="div_total_biaya" class="row">

              {{-- <label class="col-sm-4 col-form-label">Total Biaya Lain : </label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="total_biaya_lain" name="total_biaya_lain" placeholder="Total Biaya Lain..." >

                                </div>
                            </div> --}}
            </div>


            <div id="div_keterangan_biaya" class="row">
              {{-- <div id="body_biaya[1]" class="row row-cols">
                                <label id="label_biaya" name="label_biaya" class="col-sm-4 col-form-label">
                                    <a id="tambah_keterangan" name="tambah_keterangan" class="btn btn-sm btn-label-success btn-sm text-nowrap"
                                        onclick="tambah_keterangan()">Keterangan Biaya Lain <i class="fa fa-plus"></i>
                                    </a>
                                </label>
                                <div id="div_textarea_biaya" name="div_textarea_biaya" class="col-sm-6 validation-container d-grid gap-3">
                                    <textarea style="margin-left: 10px" data-bs-toggle="tooltip" class="form-control" id="keterangan_biaya[1]" name="keterangan_biaya[1]" placeholder="ex. (Rp. 10.000 untuk kebutuhan kontainer)" required></textarea>
                                </div>
                                <div id="div_button_biaya" name="div_button_biaya" class="col-sm-2 py-4">
                                    <a style="margin-left: 10px" id="hapus_biaya[1]" name="hapus_biaya" class="btn btn-sm btn-label-danger btn-icon" onclick="hapus_biaya(this)"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                            <div id="body_biaya[1]" class="row row-cols">
                                <label id="label_biaya" name="label_biaya" class="col-sm-4 col-form-label">
                                    <a id="tambah_keterangan" name="tambah_keterangan" class="btn btn-sm btn-label-success btn-sm text-nowrap"
                                        onclick="tambah_keterangan()">Keterangan Biaya Lain <i class="fa fa-plus"></i>
                                    </a>
                                </label>
                                <div id="div_textarea_biaya" name="div_textarea_biaya" class="col-sm-6 validation-container d-grid gap-3">
                                    <textarea style="margin-left: 10px" data-bs-toggle="tooltip" class="form-control" id="keterangan_biaya[1]" name="keterangan_biaya[1]" placeholder="ex. (Rp. 10.000 untuk kebutuhan kontainer)" required></textarea>
                                </div>
                                <div id="div_button_biaya" name="div_button_biaya" class="col-sm-2 py-4">
                                    <a style="margin-left: 10px" id="hapus_biaya[1]" name="hapus_biaya" class="btn btn-sm btn-label-danger btn-icon" onclick="hapus_biaya(this)"><i class="fa fa-trash"></i></a>
                                </div>
                            </div> --}}
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


  <div class="modal fade" id="modal_biaya_do_edit" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">

      <form class="modal-content" id="valid_pod_edit" name="valid_pod_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="id_container_edit" id="id_container_edit">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Masukkan Biaya-Biaya POD</h5>
            <h5 class="modal-title" id="nomor_kontainer_edit"></h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body d-grid gap-3">
          

            <div class="row">
              <label class="col-sm-4 col-form-label" for="">THC POD :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" for="">Rp.</span>

                  <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah"
                    id="thc_pod_edit" name="thc_pod_edit" placeholder="THC POD..." required>

                </div>
              </div>
            </div>
            {{-- <div class="row">
              <label class="col-sm-4 col-form-label" for="">Lolo :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" for="">Rp.</span>

                  <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah" id="lolo_edit"
                    name="lolo_edit" placeholder="Biaya Lolo..." required>

                </div>
              </div>
            </div> --}}

            <div class="row">
              <label class="col-sm-4 col-form-label" for="">Dooring :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" for="">Rp.</span>

                  <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah"
                    id="dooring_edit" name="dooring_edit" placeholder="Biaya Dooring..." required>

                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-4 col-form-label" for="">Demurrage :<span
                  class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" for="">Rp.</span>

                  <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah"
                    id="demurrage_edit" name="demurrage_edit" placeholder="Biaya Demurrage..." required>

                </div>
              </div>
            </div>
            <div class="text-center col-12" id="div_button_biaya">
              {{-- <label id="label_biaya" name="label_biaya" class="col-sm-4 col-form-label">
                                <button type="button" id="button_biaya_lain" name="button_biaya_lain" value="{{ 0 }}" class="btn btn-sm btn-label-success btn-sm text-nowrap"
                                    onclick="edit_total_biaya_lain(this)">Biaya Lain <i class="fa fa-plus"></i>
                                </button>
                            </label> --}}
            </div>
            <div class="row" id="div_total_biaya_edit">
              {{-- <label class="col-sm-4 col-form-label">Total Biaya Lain : </label>
                            <div class="col-sm-8 validation-container">

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Rp.</span>
                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="total_biaya_lain" name="total_biaya_lain" placeholder="Total Biaya Lain..." >

                                </div>
                            </div> --}}
            </div>
            <div class="row" id="div_keterangan_biaya_edit">
              {{-- <div id="body_biaya[1]" class="row row-cols">
                                <label id="label_biaya" name="label_biaya" class="col-sm-4 col-form-label">
                                    <a id="tambah_keterangan" name="tambah_keterangan" class="btn btn-sm btn-label-success btn-sm text-nowrap"
                                        onclick="tambah_keterangan()">Keterangan Biaya Lain <i class="fa fa-plus"></i>
                                    </a>
                                </label>
                                <div id="div_textarea_biaya" name="div_textarea_biaya" class="col-sm-6 validation-container d-grid gap-3">
                                    <textarea style="margin-left: 10px" data-bs-toggle="tooltip" class="form-control" id="keterangan_biaya[1]" name="keterangan_biaya[1]" placeholder="ex. (Rp. 10.000 untuk kebutuhan kontainer)" required></textarea>
                                </div>
                                <div id="div_button_biaya" name="div_button_biaya" class="col-sm-2 py-4">
                                    <a style="margin-left: 10px" id="hapus_biaya[1]" name="hapus_biaya" class="btn btn-sm btn-label-danger btn-icon" onclick="hapus_biaya(this)"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                            <div id="body_biaya[1]" class="row row-cols">
                                <label id="label_biaya" name="label_biaya" class="col-sm-4 col-form-label">
                                    <a id="tambah_keterangan" name="tambah_keterangan" class="btn btn-sm btn-label-success btn-sm text-nowrap"
                                        onclick="tambah_keterangan()">Keterangan Biaya Lain <i class="fa fa-plus"></i>
                                    </a>
                                </label>
                                <div id="div_textarea_biaya" name="div_textarea_biaya" class="col-sm-6 validation-container d-grid gap-3">
                                    <textarea style="margin-left: 10px" data-bs-toggle="tooltip" class="form-control" id="keterangan_biaya[1]" name="keterangan_biaya[1]" placeholder="ex. (Rp. 10.000 untuk kebutuhan kontainer)" required></textarea>
                                </div>
                                <div id="div_button_biaya" name="div_button_biaya" class="col-sm-2 py-4">
                                    <a style="margin-left: 10px" id="hapus_biaya[1]" name="hapus_biaya" class="btn btn-sm btn-label-danger btn-icon" onclick="hapus_biaya(this)"><i class="fa fa-trash"></i></a>
                                </div>
                            </div> --}}
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

  <div class="modal fade" id="modal_do_fee_si" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">

      <form class="modal-content" id="valid_do_fee" name="valid_do_fee">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="id_si" id="id_si">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Masukkan Biaya DO POD</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body d-grid gap-3">
            <div class="row">
              <label class="col-sm-4 col-form-label" for="">DO FEE :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" for="">Rp.</span>

                  <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah"
                    id="biaya_do_pod" name="biaya_do_pod" placeholder="Nominal DO FEE.." required>

                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-4 col-form-label" for="text">Tanggal DO</label>
              <div class="col-sm-8 validation-container">
                <input required class="form-control date_activity" id="tanggal_do_pod" name="tanggal_do_pod"
                  type="text" placeholder="Masukkan Tanggal DO">
              </div>
            </div>


          </div>
          <div class="modal-footer">
            <button type="submit" id="btnFinish3" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="modal_do_fee_si_edit" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">

      <form class="modal-content" id="valid_do_fee_edit" name="valid_do_fee_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="id_si_edit" id="id_si_edit">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Masukkan Biaya DO POD</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body d-grid gap-3">
            <div class="row">
              <label class="col-sm-4 col-form-label" for="">DO FEE :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">
                <div class="input-group input-group-sm">
                  <span class="input-group-text" for="">Rp.</span>

                  <input data-bs-toggle="tooltip" type="text" class="form-control currency-rupiah"
                    id="biaya_do_pod_edit" name="biaya_do_pod_edit" placeholder="Nominal DO FEE.." required>

                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-4 col-form-label" for="text">Tanggal DO</label>
              <div class="col-sm-8 validation-container">
                <input required class="form-control date_activity" id="tanggal_do_pod_edit" name="tanggal_do_pod_edit"
                  type="text" placeholder="Masukkan Tanggal DO">
              </div>
            </div>


          </div>
          <div class="modal-footer">
            <button type="submit" id="btnFinish4" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>









  <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
  <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>
  <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/datatable/extension/exportkontainer.js">
  </script>

  <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>


  <script type="text/javascript" src="{{ asset('/') }}./js/pod.js"></script>

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

      $(".modal-dialog").draggable({
        handle: ".modal-header",
      });

    });

    $('.modal>.modal-dialog').draggable({
      cursor: 'move',
      handle: '.modal-header, .modal-footer'
    });
    $('.modal>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');
    $('.modal>.modal-dialog>.modal-content>.modal-footer').css('cursor', 'move');
  </script>
@endsection
