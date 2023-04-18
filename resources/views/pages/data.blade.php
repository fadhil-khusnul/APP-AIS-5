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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

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

                    </tbody>
                </table>
                <!-- END Datatable -->
            </div>
        </div>

    </div>
    <div class="col-6">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">POL/POD/POT</h3>
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
                            <th>Nama Port</th>
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
                <table id="pengirim" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Alamat</th>
                            <th>text</th>
                            <th>No. Telp</th>
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
                <h3 class="portlet-title">PENERIMA</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-penerima" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="penerima" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Alamat</th>
                            <th>text</th>
                            <th>No. Telp</th>
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

                    </tbody>
                </table>
                <!-- END Datatable -->
            </div>
        </div>

    </div>
    <div class="col-6">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">TRUCKING</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-trucking" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="trucking" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Polisi</th>
                            <th>Nama Driver</th>
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
                <h3 class="portlet-title">CONTAINER</h3>
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
                            <th>CONTAINER</th>
                            <th>Size</th>
                            <th>Type</th>
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

                    </tbody>
                </table>
                <!-- END Datatable -->
            </div>
        </div>

    </div>
    <div class="col-6">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">KEGIATAN DISCHARGE (Stripping)</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">
                    <a href="/tambah-shipping" data-bs-toggle="modal" data-bs-target="#modal-discharge" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="kegiatan-stripping" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
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
</div>


<div class="modal fade" id="modal-company">
    <div class="modal-dialog">
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
                    <input class="form-control" id="email" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-depo">
    <div class="modal-dialog">
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
                    <input class="form-control" id="text" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-port">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Port</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <label class="form-label" for="text">Nama Port</label>
                    <input class="form-control" id="text" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pengirim">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Pengirim</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <label class="form-label" for="text">Nama Customer</label>
                    <input class="form-control" id="text" type="text">
                </div>
                <div>
                    <label class="form-label" for="text">Alamat</label>
                    <input class="form-control" id="text" type="text">
                </div>
                <div>
                    <label class="form-label" for="text">Email</label>
                    <input class="form-control" id="text" type="text">
                </div>
                <div>
                    <label class="form-label" for="text">No. Telp</label>
                    <input class="form-control" id="text" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-penerima">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Penerima</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <label class="form-label" for="text">Nama Customer</label>
                    <input class="form-control" id="text" type="text">
                </div>
                <div>
                    <label class="form-label" for="text">Alamat</label>
                    <input class="form-control" id="text" type="text">
                </div>
                <div>
                    <label class="form-label" for="text">Email</label>
                    <input class="form-control" id="text" type="text">
                </div>
                <div>
                    <label class="form-label" for="text">No. Telp</label>
                    <input class="form-control" id="text" type="text">
                </div>
                <div>
                    <label class="form-label" for="text">No. Rekening (Bank) </label>
                    <input class="form-control" id="text" type="text">
                    <small class="form-text">ex. 123456000 (BRI)</small>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-biaya">
    <div class="modal-dialog">
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
                    <input class="form-control" id="text" type="text">
                </div>
                <div>
                    <label class="form-label" for="text">Biaya</label>
                    <input class="form-control" id="text" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-trucking">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Trucking</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <label class="form-label" for="text">No. Polisi</label>
                    <input class="form-control" id="text" type="text">
                </div>
                <div>
                    <label class="form-label" for="text">Nama Driver</label>
                    <input class="form-control" id="text" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Container</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <label class="form-label" for="text">Size</label>
                    <input class="form-control" id="text" type="text">
                </div>
                <div>
                    <label class="form-label" for="text">Type</label>
                    <input class="form-control" id="text" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-load">
    <div class="modal-dialog">
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
                    <input class="form-control" id="text" type="text">
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-discharge">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Kegiatan Discharge (Stripping)</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <label class="form-label" for="text">Nama Kegiatan</label>
                    <input class="form-control" id="text" type="text">
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
