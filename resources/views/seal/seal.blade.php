@extends('layouts.main')

@section('content')

<div class="row">

    <div class="col-md-4">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">{{$title}}</h3>
            </div>
            <div class="portlet-body">

                <form class="row g-3">
                    <div class="col-md-12">
                        <label for="" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode-seal">
                    </div>
                    <div class="col-md-12">
                        <label for="" class="form-label">Tahun</label>
                        <input type="text" class="form-control" id="tahun-seal">
                    </div>


                    <div class="text-end">
                        <button class="btn btn-success"> <i class="fa fa-plus"></i> Buat Seal</button>
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
                <h3 class="portlet-title">{{$title}}</h3>
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
                            <th>Tahun</th>
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

</div>

@endsection
