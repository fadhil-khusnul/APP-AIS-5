@extends('layouts.main')

@section('content')
  <div class="row">

    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">SHIPPING COMPANY</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">

            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-company" class="btn btn-success btn-icon"> <i
                class="fa fa-plus"></i></a>
          </div>
          {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
          <hr>

          <!-- BEGIN Datatable -->
          <table id="shipping" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Company/Pelayaran (PT)</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($companies as $company)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $company->nama_company }}
                  </td>
                  <td class="text-center"><button onclick="editCompany(this)" value="{{ $company->id }}"
                      class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                    <button onclick="deleteCompany(this)" value="{{ $company->id }}" type="button"
                      class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
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
    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">KAPAL</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">

            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-kapal" class="btn btn-success btn-icon"> <i
                class="fa fa-plus"></i></a>
          </div>
          {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
          <hr>

          <!-- BEGIN Datatable -->
          <table id="kapal_master" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kapal</th>
                <th>Code Kapal</th>
                <th>Nama Pelayaran</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kapals as $kapal)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $kapal->nama_kapal }}
                  </td>
                  <td>
                    {{ $kapal->code_kapal }}
                  </td>
                  <td>
                    {{ optional($kapal->pelayaran)->nama_company }}
                  </td>
                  <td class="text-center"><button onclick="editKapal(this)" value="{{ $kapal->id }}"
                      class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                    <button onclick="deleteKapal(this)" value="{{ $kapal->id }}" type="button"
                      class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
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
    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">DEPO</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">

            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-depo" class="btn btn-success btn-icon"> <i
                class="fa fa-plus"></i></a>
          </div>
          <hr>

          <!-- BEGIN Datatable -->
          <table id="depo" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pelayaran</th>
                <th>Nama DEPO</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($depos as $depo)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $depo->pelabuhans->nama_company }}
                  </td>
                  <td>
                    {{ $depo->nama_depo }}
                  </td>
                  <td class="text-center"><button onclick="editDepo(this)" value="{{ $depo->id }}"
                      class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                    <button onclick="deleteDepo(this)" value="{{ $depo->id }}" type="button"
                      class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                  </td>

                </tr>
              @endforeach


            </tbody>
          </table>
          <!-- END Datatable -->
        </div>
      </div>

    </div>
    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">PELABUHAN</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">

            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-port" class="btn btn-success btn-icon"> <i
                class="fa fa-plus"></i></a>
          </div>
          <hr>

          <!-- BEGIN Datatable -->
          <table id="pol" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>Area Code</th>
                <th>Nama Pelabuhan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pelabuhans as $pelabuhan)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $pelabuhan->area_code }}
                  </td>
                  <td>
                    {{ $pelabuhan->nama_pelabuhan }}
                  </td>
                  <td class="text-center"><button onclick="editpelabuhan(this)" value="{{ $pelabuhan->id }}"
                      class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                    <button onclick="deletepelabuhan(this)" value="{{ $pelabuhan->id }}" type="button"
                      class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                  </td>

                </tr>
              @endforeach

            </tbody>
          </table>
          <!-- END Datatable -->
        </div>
      </div>

    </div>
    {{-- <div class="col-6">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">POD (Port of Discharge)</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">

                    <a href="/tambah-shipping" data-bs-toggle="modal" data-bs-target="#modal-load" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="pol" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>POD (Discharge)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <!-- END Datatable -->
            </div>
        </div>

    </div>
    <div class="col-6">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">POD (Port of Discharge)</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">

                    <a href="/tambah-shipping" data-bs-toggle="modal" data-bs-target="#modal-load" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="pol" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>POad</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <!-- END Datatable -->
            </div>
        </div>

    </div> --}}

    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">VENDOR MOBIL</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">

            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-vendor" class="btn btn-success btn-icon">
              <i class="fa fa-plus"></i></a>
          </div>
          {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
          <hr>

          <!-- BEGIN Datatable -->
          <table id="data_vendor" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Vendor Mobil</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($vendors as $vendor)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $vendor->nama_vendor }}
                  </td>
                  <td class="text-center"><button onclick="editVendor(this)" value="{{ $vendor->id }}"
                      class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                    <button onclick="deleteVendor(this)" value="{{ $vendor->id }}" type="button"
                      class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
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
    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">PENGIRIM</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">

            <a href="#" class="btn btn-success btn-icon" data-bs-toggle="modal"
              data-bs-target="#modal-pengirim"> <i class="fa fa-plus"></i></a>
          </div>
          <hr>

          <!-- BEGIN Datatable -->
          <table id="pengirim_tabel" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pengirim</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Rekening</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pengirims as $pengirim)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $pengirim->nama_costumer }}
                  </td>
                  <td>
                    {{ $pengirim->alamat }}
                  </td>
                  <td>
                    {{ $pengirim->email }}
                  </td>
                  <td>
                    {{ $pengirim->no_telp }}
                  </td>
                  <td>
                    {{ $pengirim->rekening }}
                  </td>
                  <td class="text-center"><button onclick="editpengirim(this)" value="{{ $pengirim->id }}"
                      class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                    <button onclick="deletepengirim(this)" value="{{ $pengirim->id }}" type="button"
                      class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                  </td>

                </tr>
              @endforeach

            </tbody>
          </table>
          <!-- END Datatable -->
        </div>
      </div>

    </div>
    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">PENERIMA</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">

            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-penerima"
              class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
          </div>
          <hr>

          <!-- BEGIN Datatable -->
          <table id="penerima_tabel" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Penerima</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>No. Rekening</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($penerimas as $penerima)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $penerima->nama_penerima }}
                  </td>
                  <td>
                    {{ $penerima->alamat_penerima }}
                  </td>
                  <td>
                    {{ $penerima->email_penerima }}
                  </td>
                  <td>
                    {{ $penerima->no_telp_penerima }}
                  </td>
                  <td>
                    {{ $penerima->rekening_penerima }}
                  </td>
                  <td class="text-center"><button onclick="editpenerima(this)" value="{{ $penerima->id }}"
                      class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                    <button onclick="deletepenerima(this)" value="{{ $penerima->id }}" type="button"
                      class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                  </td>

                </tr>
              @endforeach


            </tbody>
          </table>
          <!-- END Datatable -->
        </div>
      </div>

    </div>

    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">REKENING BANK KANTOR</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">

            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-rekening"
              class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
          </div>
          <hr>

          <!-- BEGIN Datatable -->
          <table id="biaya" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>NAMA BANK</th>
                <th>NO. REKENING</th>
                <th>PEMILIK REKENING</th>
                <th class="text-center">Aksi</th>

              </tr>
            </thead>
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
                    class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                  <button onclick="deleterekening(this)" value="{{ $dana->id }}" type="button"
                    class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                </td>


              </tr>
            @endforeach
          </table>
          <!-- END Datatable -->
        </div>
      </div>

    </div>
    {{-- <div class="col-6">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">BIAYA</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-biaya"  class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="biaya" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pekerjaan</th>
                            <th>Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($biayas as $biaya)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$biaya->pekerjaan_biaya}}
                            </td>
                            <td>
                                @rupiah($biaya->biaya_cost)
                            </td>
                            <td class="text-center"><button onclick="editbiaya(this)" value="{{$biaya->id}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deletebiaya(this)" value="{{$biaya->id}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button></td>

                        </tr>

                        @endforeach

                    </tbody>
                </table>
                <!-- END Datatable -->
            </div>
        </div>

    </div> --}}
    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">TYPE CONTAINER</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">
            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-type" class="btn btn-success btn-icon"> <i
                class="fa fa-plus"></i></a>
          </div>
          <hr>

          <!-- BEGIN Datatable -->
          <table id="trucking" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>Type Container</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($types as $type)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $type->type_container }}
                  </td>

                  <td class="text-center"><button onclick="edittype(this)" value="{{ $type->id }}"
                      class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                    <button onclick="deletetype(this)" value="{{ $type->id }}" type="button"
                      class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                  </td>

                </tr>
              @endforeach

            </tbody>
          </table>
          <!-- END Datatable -->
        </div>
      </div>

    </div>
    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">SIZE CONTAINER</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">
            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-container"
              class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
          </div>
          <hr>

          <!-- BEGIN Datatable -->
          <table id="table-container" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>Size Container</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($containers as $container)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>

                  <td>
                    {{ $container->size_container }}
                  </td>

                  <td class="text-center"><button onclick="editcontainer(this)" value="{{ $container->id }}"
                      class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                    <button onclick="deletecontainer(this)" value="{{ $container->id }}" type="button"
                      class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                  </td>

                </tr>
              @endforeach

            </tbody>
          </table>
          <!-- END Datatable -->
        </div>
      </div>

    </div>

    {{-- <div class="col-6">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">KEGIATAN LOAD (Stuffing)</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-load" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="kegiatan-stuffing" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($stuffings as $stuff)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$stuff->kegiatan_stuffing}}
                            </td>
                            <td class="text-center"><button onclick="editstuff(this)" value="{{$stuff->id}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deletestuff(this)" value="{{$stuff->id}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button></td>

                        </tr>

                        @endforeach

                    </tbody>
                </table>
                <!-- END Datatable -->
            </div>
        </div>

    </div> --}}
    <div class="col-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">KEGIATAN ACTIVITY (Stuffing/Stripping)</h3>
        </div>
        <div class="portlet-body">
          <div class="text-end">
            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-discharge"
              class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
          </div>
          <hr>

          <!-- BEGIN Datatable -->
          <table id="kegiatan-stripping" class="table table-bordered table-striped table-hover autosize">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Jenis Kegiatan</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($strippings as $stripp)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $stripp->kegiatan }}
                  </td>
                  <td>
                    {{ $stripp->jenis_kegiatan }}
                  </td>
                  <td class="text-center"><button onclick="editstripp(this)" value="{{ $stripp->id }}"
                      class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                    <button onclick="deletestripp(this)" value="{{ $stripp->id }}" type="button"
                      class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                  </td>

                </tr>
              @endforeach

            </tbody>
          </table>
          <!-- END Datatable -->
        </div>
      </div>

    </div>
    <div class="col-md-6">

      <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
          <h3 class="portlet-title">DATA PPN </h3>
        </div>
        <div class="portlet-body">


          <div class="widget8">
            <div class="widget8-content">
              <div class="avatar avatar-label-success avatar-circle widget8-avatar">
                <div class="avatar-display">
                  <i class="fa fa-percent"></i>
                </div>
              </div>

              <h4 class="widget8-highlight">{{ str_replace('.', ',', $ppn->ppn) }} %</h4>

              <button value="{{ $ppn->id }}" onclick="ppn_modal(this)" type="button"
                class="btn btn-label-info btn-sm btn-icon btn-circle"><i class="fa fa-pencil"></i></button>
            </div>
          </div>

          <!-- BEGIN Datatable -->

          <!-- END Datatable -->
        </div>
      </div>

    </div>
  </div>


  <div class="modal fade" id="modal-company">
    <div class="modal-dialog">
      <form action="#" name="valid_company" id="valid_company">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Shipping-Company</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="email">Nama Company</label>
              <input class="form-control" id="nama_company" name="nama_company" type="text">
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>

      </form>

    </div>
  </div>
  <div class="modal fade" id="modal-company-edit">
    <div class="modal-dialog">
      <form action="#" name="valid_company_edit" id="valid_company_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="old_id_company" id="old_id_company">


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Shipping-Company</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="email">Nama Company</label>
              <input class="form-control" id="nama_company_edit" name="nama_company_edit" type="text">
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


  <div class="modal fade" id="modal-kapal" data-bs-backdrop="static">
    <div class="modal-dialog">
      <form action="#" name="valid_data_kapal" id="valid_data_kapal">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Kapal</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <label class="col-sm-4 col-form-label">Nama Kapal:<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">


                <input type="text" class="form-control" id="nama_kapal" name="nama_kapal">

              </div>
            </div>
            <div class="row">
              <label class="col-sm-4 col-form-label">Code Kapal :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">

                <input type="text" class="form-control" id="code_kapal" name="code_kapal">

              </div>
            </div>
            <div class="row">
              <label class="col-sm-4 col-form-label">Pelayaran :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">

                <select id="pelayaran_kapal_id" name="pelayaran_kapal_id" class="form-select">
                  <option selected disabled>Pilih Pelayaran</option>
                  @foreach ($pelayarans as $pelayaran)
                    <option value="{{ $pelayaran->id }}">
                      {{ $pelayaran->nama_company }}</option>
                  @endforeach
                </select>

              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>

      </form>

    </div>
  </div>
  <div class="modal fade" id="modal-kapal-edit" data-bs-backdrop="static">
    <div class="modal-dialog">
      <form action="#" name="valid_data_kapal_edit" id="valid_data_kapal_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="old_id_kapal" id="old_id_kapal">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Kapal</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <label class="col-sm-4 col-form-label">Nama Kapal:<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">


                <input type="text" class="form-control" id="nama_kapal_edit" name="nama_kapal_edit">

              </div>
            </div>
            <div class="row">
              <label class="col-sm-4 col-form-label">Code Kapal :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">

                <input type="text" class="form-control" id="code_kapal_edit" name="code_kapal_edit">

              </div>
            </div>
            <div class="row">
              <label class="col-sm-4 col-form-label">Pelayaran :<span class="text-danger">*</span></label>
              <div class="col-sm-8 validation-container">

                <select id="pelayaran_kapal_id_edit" name="pelayaran_kapal_id_edit" class="form-select">
                  <option selected disabled>Pilih Pelayaran</option>
                  @foreach ($pelayarans as $pelayaran)
                    <option value="{{ $pelayaran->id }}">
                      {{ $pelayaran->nama_company }}</option>
                  @endforeach
                </select>

              </div>
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


  <div class="modal fade" id="modal_ppn">
    <div class="modal-dialog">
      <form action="#" name="valid_ppn" id="valid_ppn">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data PPN</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="email">Nilai PPN</label>
              <input required class="form-control ppn" id="nilai_ppn" name="nilai_ppn" type="text">
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

  <div class="modal fade" id="modal-vendor">
    <div class="modal-dialog">
      <form action="#" name="valid_vendor" id="valid_vendor">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Vendor Mobil</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="email">Nama Vendor</label>
              <input class="form-control" id="nama_vendor" name="nama_vendor" type="text">
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>

      </form>

    </div>
  </div>
  <div class="modal fade" id="modal-vendor-edit">
    <div class="modal-dialog">
      <form action="#" name="valid_vendor_edit" id="valid_vendor_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="old_id_vendor" id="old_id_vendor">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Vendor Mobil</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="email">Nama Vendor</label>
              <input class="form-control" id="nama_vendor_edit" name="nama_vendor_edit" type="text">
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>

      </form>

    </div>
  </div>

  <div class="modal fade" id="modal-depo">
    <div class="modal-dialog">
      <form action="#" name="valid_depo" id="valid_depo">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Depo</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body d-grid gap-3 px-5">

            <div class="row">

              <label for="company" class="col-sm-4 form-label">Pilih Pelayaran :</label>
              <div class="col-sm-8 validation-container">
                <select required id="pelayaran_id_tambah" name="pelayaran_id_tambah" class="form-select">
                  <option selected disabled>Pilih Pelayaran</option>
                  @foreach ($pelayarans as $shippingcompany)
                    <option value="{{ $shippingcompany->id }}">{{ $shippingcompany->nama_company }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-4 form-label" for="text">Nama Depo :</label>
              <div class="col-sm-8 validation-container">
                <input class="form-control" id="nama_depo" name="nama_depo" type="text">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-depo-edit">
    <div class="modal-dialog">
      <form action="#" name="valid_depo_edit" id="valid_depo_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="old_id_depo" id="old_id_depo">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Depo</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body d-grid gap-3 px-5">

            <div class="row">

              <label for="company" class="col-sm-4 form-label">Pilih Pelayaran :</label>
              <div class="col-sm-8 validation-container">
                <select required id="pelayaran_id_edit" name="pelayaran_id_edit" class="form-select">
                  <option selected disabled>Pilih Pelayaran</option>
                  @foreach ($pelayarans as $shippingcompany)
                    <option value="{{ $shippingcompany->id }}">{{ $shippingcompany->nama_company }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-4 form-label" for="nama_depo">Nama Depo</label>
              <div class="col-sm-8 validation-container">
                <input class="form-control" id="nama_depo_edit" name="nama_depo_edit" type="text">
              </div>
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

  <div class="modal fade" id="modal-port">
    <div class="modal-dialog">
      <form action="#" id="valid_pelabuhan" name="valid_pelabuhan">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Pelabuhan</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="text">Area Code</label>
              <input class="form-control" id="area_code" name="area_code" type="text">
            </div>
            <div>
              <label class="form-label" for="text">Nama Pelabuhan</label>
              <input class="form-control" id="nama_pelabuhan" name="nama_pelabuhan" type="text">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="modal-rekening">
    <div class="modal-dialog">
      <form action="#" id="valid_rekening" name="valid_rekening">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Rekening</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="validation-container">
              <label for="" class="form-label">Masukkan Nama Bank:</label>
              <input id="nama_bank" name="nama_bank" type="text" placeholder="Nama BANK ex. BCA"
                class="form-control" required>
            </div>
            <div class="validation-container">
              <label for="" class="form-label">Masukkan No. Rekening:</label>
              <input id="no_rekening" name="no_rekening" type="text" placeholder="No.Rekening (123xxxxxx)"
                class="form-control" required>
            </div>
            <div class="validation-container">
              <label for="" class="form-label">Masukkan Pemilik Rekening:</label>
              <input id="atas_nama" name="atas_nama" type="text" placeholder="ex. John Doe" class="form-control"
                required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="modal-dana-edit">
    <div class="modal-dialog">
      <form action="#" name="valid_rekening_edit" id="valid_rekening_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="old_id_rekening" id="old_id_rekening">


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
              <input id="nama_bank_edit" name="nama_bank_edit" type="text" placeholder="Nama BANK ex. BCA"
                class="form-control" required>
            </div>

            <div class="validation-container">
              <label for="" class="form-label">Masukkan No. Rekening:</label>
              <input id="no_rekening_edit" name="no_rekening_edit" type="text"
                placeholder="No.Rekening (123xxxxxx)" class="form-control" required>
            </div>

            <div class="validation-container">
              <label for="" class="form-label">Masukkan Pemilik Rekening:</label>
              <input id="atas_nama_edit" name="atas_nama_edit" type="text" placeholder="ex. John Doe"
                class="form-control" required>
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

  <div class="modal fade" id="modal-pelabuhan-edit">
    <div class="modal-dialog">
      <form action="#" name="valid_pelabuhan_edit" id="valid_pelabuhan_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="old_id_pelabuhan" id="old_id_pelabuhan">


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Pelabuhan</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="area_code">Area Code</label>
              <input class="form-control" id="area_code_edit" name="area_code_edit" type="text">
            </div>
            <div>
              <label class="form-label" for="email">Nama Pelabuhan</label>
              <input class="form-control" id="nama_pelabuhan_edit" name="nama_pelabuhan_edit" type="text">
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




  <div class="modal fade" id="modal-pengirim">
    <div class="modal-dialog">
      <form action="#" id="valid_pengirim" name="valid_pengirim">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Pengirim</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="validation-container">
              <label class="form-label" for="text">Nama Pengirim</label>
              <input class="form-control" id="nama_costumer" name="nama_costumer" type="text">
            </div>
            <div class="validation-container">
              <label class="form-label" for="text">Alamat</label>
              <input class="form-control" id="alamat" name="alamat" type="text">
            </div>
            <div class="validation-container">
              <label class="form-label" for="text">Email</label>
              <input class="form-control" id="email" name="email" type="text">
            </div>
            <div class="validation-container">
              <label class="form-label" for="text">No. Telp</label>
              <input class="form-control" id="no_telp" name="no_telp" type="text">
            </div>
            <div class="validation-container">
              <label class="form-label" for="text">No. Rekening (Bank) </label>
              <input class="form-control" id="rekening" name="rekening" type="text">
              <small class="form-text">ex. 123456000 (BRI)</small>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-pengirim-edit">
    <div class="modal-dialog">
      <form action="#" id="valid_pengirim_edit" name="valid_pengirim_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="old_id_pengirim" id="old_id_pengirim">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Pengirim</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="text">Nama Pengirim</label>
              <input class="form-control" id="nama_costumer_edit" name="nama_costumer_edit" type="text">
            </div>
            <div>
              <label class="form-label" for="text">Alamat</label>
              <input class="form-control" id="alamat_edit" name="alamat_edit" type="text">
            </div>
            <div>
              <label class="form-label" for="text">Email</label>
              <input class="form-control" id="email_edit" name="email_edit" type="text">
            </div>
            <div>
              <label class="form-label" for="text">No. Telp</label>
              <input class="form-control" id="no_telp_edit" name="no_telp_edit" type="text">
            </div>
            <div>
              <label class="form-label" for="text">No. Rekening (Bank) </label>
              <input class="form-control" id="rekening_edit" name="rekening_edit" type="text">
              <small class="form-text">ex. 123456000 (BRI)</small>
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


  <div class="modal fade" id="modal-penerima">
    <div class="modal-dialog">
      <form action="#" id="valid_penerima" name="valid_penerima">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Penerima</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="validation-container">
              <label class="form-label" for="text">Nama Penerima</label>
              <input class="form-control" id="nama_penerima" name="nama_penerima" type="text">
            </div>
            <div class="validation-container">
              <label class="form-label" for="text">Alamat</label>
              <input class="form-control" id="alamat_penerima" name="alamat_penerima" type="text">
            </div>
            <div class="validation-container">
              <label class="form-label" for="text">Email</label>
              <input class="form-control" id="email_penerima" name="email_penerima" type="text">
            </div>
            <div class="validation-container">
              <label class="form-label" for="text">No. Telp</label>
              <input class="form-control" id="no_telp_penerima" name="no_telp_penerima" type="text">
            </div>
            <div class="validation-container">
              <label class="form-label" for="text">No. Rekening (Bank) </label>
              <input class="form-control" id="rekening_penerima" name="rekening_penerima" type="text">
              <small class="form-text">ex. 123456000 (BRI)</small>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-penerima-edit">
    <div class="modal-dialog">
      <form action="#" id="valid_penerima_edit" name="valid_penerima_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="old_id_penerima" id="old_id_penerima">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Penerima</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="text">Nama Penerima</label>
              <input class="form-control" id="nama_penerima_edit" name="nama_penerima_edit" type="text">
            </div>
            <div>
              <label class="form-label" for="text">Alamat</label>
              <input class="form-control" id="alamat_penerima_edit" name="alamat_penerima_edit" type="text">
            </div>
            <div>
              <label class="form-label" for="text">Email</label>
              <input class="form-control" id="email_penerima_edit" name="email_penerima_edit" type="text">
            </div>
            <div>
              <label class="form-label" for="text">No. Telp</label>
              <input class="form-control" id="no_telp_penerima_edit" name="no_telp_penerima_edit" type="text">
            </div>
            <div>
              <label class="form-label" for="text">No. Rekening (Bank) </label>
              <input class="form-control" id="rekening_penerima_edit" name="rekening_penerima_edit" type="text">
              <small class="form-text">ex. 123456000 (BRI)</small>
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

  <div class="modal fade" id="modal-biaya">
    <div class="modal-dialog">
      <form action="#" id="valid_biaya" name="valid_biaya">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Biaya</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="text">Pekerjaan</label>
              <input class="form-control" id="pekerjaan_biaya" name="pekerjaan_biaya" type="text">
            </div>
            <div>
              <label class="form-label" for="text">Biaya</label>
              <input class="form-control" id="biaya_cost" name="biaya_cost" type="text">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="modal-biaya-edit">
    <div class="modal-dialog">
      <form action="#" name="valid_biaya_edit" id="valid_biaya_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Biaya</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="area_code">Pekerjaan</label>
              <input class="form-control" id="pekerjaan_biaya_edit" name="pekerjaan_biaya_edit" type="text">
            </div>
            <div>
              <label class="form-label" for="email">Biaya</label>
              <input class="form-control" id="biaya_cost_edit" name="biaya_cost_edit" type="text">
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
  <div class="modal fade" id="modal-type">
    <div class="modal-dialog">
      <form action="#" id="valid_type" name="valid_type">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Type Container</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">

            <div>
              <label class="form-label" for="text">Type COntainer</label>
              <input class="form-control" id="type_container" name="type_container" type="text">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-type-edit">
    <div class="modal-dialog">
      <form action="#" id="valid_type_edit" name="valid_type_edit">

        <input type="hidden" name="old_id_type" id="old_id_type">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Type Container</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="text">Type Container</label>
              <input class="form-control" id="type_container_edit" name="type_container_edit" type="text">
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


  <div class="modal fade" id="modal-container">
    <div class="modal-dialog">
      <form action="#" id="valid_container" name="valid_container">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Container</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">

            <div class="validation-container">
              <label class="form-label" for="text">Size</label>
              <input class="form-control" id="size_container" name="size_container" type="text">
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-container-edit">
    <div class="modal-dialog">
      <form action="#" id="valid_container_edit" name="valid_container_edit">
        <input type="hidden" id="old_id_container" name="old_id_container">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Size Container</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            {{-- <div>
                        <label class="form-label" for="text">Container</label>
                        <input class="form-control" id="jenis_container_edit" name="jenis_container_edit" type="text">
                    </div> --}}
            <div>
              <label class="form-label" for="text">Size</label>
              <input class="form-control" id="size_container_edit" name="size_container_edit" type="text">
            </div>
            {{-- <div>
                        <label class="form-label" for="text">Type</label>
                        <input class="form-control" id="type_container_edit" name="type_container_edit" type="text">
                    </div> --}}
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Edit</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-load">
    <div class="modal-dialog">
      <form action="#" id="valid_stuffing" name="valid_stuffing">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Kegiatan Load (Stuffing)</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="text">Nama Kegiatan</label>
              <input class="form-control" id="kegiatan_stuffing" name="kegiatan_stuffing" type="text">
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-load-edit">
    <div class="modal-dialog">
      <form action="#" id="valid_stuffing_edit" name="valid_stuffing_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Kegiatan Load (Stuffing)</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label class="form-label" for="text">Nama Kegiatan</label>
              <input class="form-control" id="kegiatan_stuffing_edit" name="kegiatan_stuffing_edit"
                type="text">
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



  <div class="modal fade" id="modal-discharge">
    <div class="modal-dialog">
      <form action="#" id="valid_stripping" name="valid_stripping">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Kegiatan (Stripping/Stuffing)</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="validation-container">
              <label class="form-label" for="text">Nama Kegiatan</label>
              <input class="form-control" id="kegiatan" name="kegiatan" type="text">
            </div>
            <div class="form-check validation-container mt-3">
              <input class="form-check-input" type="radio" name="jenis_kegiatan" id="jenis_kegiatan"
                value="Stripping" checked>
              <label class="form-check-label" for="flexRadioDefault1">Stripping </label>
            </div>
            <div class="form-check validation-container mt-3">
              <input class="form-check-input" type="radio" name="jenis_kegiatan" id="jenis_kegiatan"
                value="Stufffing">
              <label class="form-check-label" for="flexRadioDefault1">Stufffing </label>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-discharge-edit">
    <div class="modal-dialog">
      <form action="#" id="valid_stripping_edit" name="valid_stripping_edit">
        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
        <input type="hidden" name="old_id_kegiatan" id="old_id_kegiatan">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Kegiatan</h5>
            <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
              <i class="fa fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="validation-container">
              <label class="form-label" for="text">Nama Kegiatan</label>
              <input class="form-control" id="kegiatan_edit" name="kegiatan_edit" type="text">
            </div>
            <div class="form-check validation-container">
              <input class="form-check-input jenis_kegiatan_edit_stripping" type="radio"
                name="jenis_kegiatan_edit" id="jenis_kegiatan_edit" value="Stripping">
              <label class="form-check-label" for="flexRadioDefault1">Stripping </label>
            </div>
            <div class="form-check validation-container">
              <input class="form-check-input jenis_kegiatan_edit_stuffing" type="radio" name="jenis_kegiatan_edit"
                id="jenis_kegiatan_edit" value="Stuffing">
              <label class="form-check-label" for="flexRadioDefault1">Stufffing </label>
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
@endsection
