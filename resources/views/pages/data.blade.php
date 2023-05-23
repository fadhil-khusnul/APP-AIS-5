@extends('layouts.main')

@section('content')

<div class="row">

    <div class="col-6">
        <!-- BEGIN Portlet -->
        {{-- <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">Datatable fixed header extension</h3>
            </div>
            <div class="portlet-body">
                <p class="mb-0">When displaying tables with a particularly large amount of data shown on each page, it can be useful to have the table's header and/or footer fixed to the top or bottom of the scrolling window. This lets your users quickly determine what each column refers to rather than needing to scroll back to the top of the table.</p>
            </div>
        </div> --}}
        <!-- END Portlet -->
        <!-- BEGIN Portlet -->
        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">SHIPPING COMPANY</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-company" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
                <hr>

                <!-- BEGIN Datatable -->
                <table id="shipping" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Company (PT)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$company->nama_company}}
                            </td>
                            <td class="text-center"><button onclick="editCompany(this)" value="{{$company->id}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deleteCompany(this)" value="{{$company->id}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button></td>

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

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-depo" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="depo" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama DEPO</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($depos as $depo)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$depo->nama_depo}}
                            </td>
                            <td class="text-center"><button onclick="editDepo(this)" value="{{$depo->id}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deleteDepo(this)" value="{{$depo->id}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button></td>

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

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-port" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
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
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$pelabuhan->area_code}}
                            </td>
                            <td>
                                {{$pelabuhan->nama_pelabuhan}}
                            </td>
                            <td class="text-center"><button onclick="editpelabuhan(this)" value="{{$pelabuhan->id}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deletepelabuhan(this)" value="{{$pelabuhan->id}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button></td>

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
                <h3 class="portlet-title">PENGIRIM</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">

                    <a href="#" class="btn btn-success btn-icon" data-bs-toggle="modal" data-bs-target="#modal-pengirim"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="pengirim_tabel" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Costumer</th>
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
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$pengirim->nama_costumer}}
                            </td>
                            <td>
                                {{$pengirim->alamat}}
                            </td>
                            <td>
                                {{$pengirim->email}}
                            </td>
                            <td>
                                {{$pengirim->no_telp}}
                            </td>
                            <td>
                                {{$pengirim->rekening}}
                            </td>
                            <td class="text-center"><button onclick="editpengirim(this)" value="{{$pengirim->id}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deletepengirim(this)" value="{{$pengirim->id}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button></td>

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

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-penerima" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="penerima_tabel" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
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
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$penerima->nama_penerima}}
                            </td>
                            <td>
                                {{$penerima->alamat_penerima}}
                            </td>
                            <td>
                                {{$penerima->email_penerima}}
                            </td>
                            <td>
                                {{$penerima->no_telp_penerima}}
                            </td>
                            <td>
                                {{$penerima->rekening_penerima}}
                            </td>
                            <td class="text-center"><button onclick="editpenerima(this)" value="{{$penerima->id}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deletepenerima(this)" value="{{$penerima->id}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button></td>

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

    </div>
    <div class="col-6">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">TYPE CONTAINER</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-type" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
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
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$type->type_container}}
                            </td>

                            <td class="text-center"><button onclick="edittype(this)" value="{{$type->id}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deletetype(this)" value="{{$type->id}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button></td>

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
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-container" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
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
                                {{$loop->iteration}}
                            </td>

                            <td>
                                {{$container->size_container}}
                            </td>

                            <td class="text-center"><button onclick="editcontainer(this)" value="{{$container->id}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deletecontainer(this)" value="{{$container->id}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button></td>

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
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-discharge" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
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
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$stripp->kegiatan}}
                            </td>
                            <td>
                                {{$stripp->jenis_kegiatan}}
                            </td>
                            <td class="text-center"><button onclick="editstripp(this)" value="{{$stripp->id}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deletestripp(this)" value="{{$stripp->id}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button></td>

                        </tr>

                        @endforeach

                    </tbody>
                </table>
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
                <div class="modal-body">
                    <div>
                        <label class="form-label" for="text">Nama Depo</label>
                        <input class="form-control" id="nama_depo" name="nama_depo" type="text">
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Depo</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <label class="form-label" for="nama_depo">Nama Depo</label>
                    <input class="form-control" id="nama_depo_edit" name="nama_depo_edit" type="text">
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
        <form action="#" id="valid_pelabuhan" name="valid_pelabuhan" >
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

<div class="modal fade" id="modal-pelabuhan-edit">
    <div class="modal-dialog">
        <form action="#" name="valid_pelabuhan_edit" id="valid_pelabuhan_edit">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


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

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pengirim</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="form-label" for="text">Nama Costumer</label>
                        <input class="form-control" id="nama_costumer" name="nama_costumer" type="text">
                    </div>
                    <div>
                        <label class="form-label" for="text">Alamat</label>
                        <input class="form-control" id="alamat" name="alamat" type="text">
                    </div>
                    <div>
                        <label class="form-label" for="text">Email</label>
                        <input class="form-control" id="email" name="email" type="text">
                    </div>
                    <div>
                        <label class="form-label" for="text">No. Telp</label>
                        <input class="form-control" id="no_telp" name="no_telp" type="text">
                    </div>
                    <div>
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

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pengirim</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="form-label" for="text">Nama Costumer</label>
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

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Penerima</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="form-label" for="text">Nama Costumer</label>
                        <input class="form-control" id="nama_penerima" name="nama_penerima" type="text">
                    </div>
                    <div>
                        <label class="form-label" for="text">Alamat</label>
                        <input class="form-control" id="alamat_penerima" name="alamat_penerima" type="text">
                    </div>
                    <div>
                        <label class="form-label" for="text">Email</label>
                        <input class="form-control" id="email_penerima" name="email_penerima" type="text">
                    </div>
                    <div>
                        <label class="form-label" for="text">No. Telp</label>
                        <input class="form-control" id="no_telp_penerima" name="no_telp_penerima" type="text">
                    </div>
                    <div>
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

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Penerima</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="form-label" for="text">Nama Costumer</label>
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
                        <input class="form-control" id="kegiatan_stuffing_edit" name="kegiatan_stuffing_edit" type="text">
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
                        <input class="form-check-input" type="radio" name="jenis_kegiatan" id="jenis_kegiatan" value="Stripping" checked>
                        <label class="form-check-label" for="flexRadioDefault1">Stripping </label>
                    </div>
                    <div class="form-check validation-container mt-3">
                        <input class="form-check-input" type="radio" name="jenis_kegiatan" id="jenis_kegiatan" value="Stufffing">
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
                        <input class="form-check-input jenis_kegiatan_edit_stripping" type="radio" name="jenis_kegiatan_edit" id="jenis_kegiatan_edit" value="Stripping">
                        <label class="form-check-label" for="flexRadioDefault1">Stripping </label>
                    </div>
                    <div class="form-check validation-container">
                        <input class="form-check-input jenis_kegiatan_edit_stuffing" type="radio" name="jenis_kegiatan_edit" id="jenis_kegiatan_edit" value="Stuffing">
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
