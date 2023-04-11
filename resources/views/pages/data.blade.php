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

                    <a href="/tambah-shipping" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
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

                    <a href="/tambah-shipping" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
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
                <h3 class="portlet-title">POL/POD</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">

                    <a href="/tambah-shipping" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="pol" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama POL/POD</th>
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
                <h3 class="portlet-title">PENGIRIM</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">

                    <a href="/tambah-shipping" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="pengirim" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama PENGIRIM</th>
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

                    <a href="/tambah-shipping" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="penerima" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama PENERIMA</th>
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

                    <a href="/tambah-shipping" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="biaya" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>BIAYA</th>
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

                    <a href="/tambah-shipping" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="trucking" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>TRUCKING</th>
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
                    <a href="/tambah-shipping" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
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
                <h3 class="portlet-title">KEGIATAN</h3>
            </div>
            <div class="portlet-body">
                <div class="text-end">
                    <a href="/tambah-shipping" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></a>
                </div>
                <hr>

                <!-- BEGIN Datatable -->
                <table id="kegiatan" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>STUFFING</th>
                            <th>STRIPPING</th>
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

@endsection
