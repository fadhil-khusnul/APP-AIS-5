@extends('layouts.main')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered g-8">

                <h3 class="portlet-title">{{$title}}</h3>


            </div>
            <div class="portlet-body">
                <div class="row row-cols-lg-auto g-3 align-items-center">
                    <div class="col-md-4">

                        <select class="form-select" id="Pengirim-1">
                            <option selected disabled>Filter Shipping Company</option>
                            @foreach ($planloads as $planload)
                                <option value="{{$planload->select_company}}">{{$planload->select_company}}</option>

                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="Penerima-1">
                            <option selected disabled>Filter Vessel</option>
                            @foreach ($planloads as $planload)
                                <option value="{{$planload->vessel}}">{{$planload->vessel}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="col-12 text-end">

                        <a href="planload/create" class="btn btn-success"> <i class="fa fa-plus"></i> Buat Job (Load)</a>
                    </div>

                </div>








                {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
                <hr>

                <!-- BEGIN Datatable -->
                <table id="planload" class="table table-bordered table-striped table-hover autosize">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Activity</th>
                            <th>Shipping Company</th>
                            <th>Vessel</th>
                            <th>POL</th>
                            <th>POT</th>
                            <th>POD</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>Jumlah Container</th>
                            <th>Size Container</th>
                            <th>Jenis Container</th>
                            <th>Remark</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($planloads as $planload)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$planload->tanggal_planload}}
                            </td>
                            <td>
                                {{$planload->activity}}
                            </td>
                            <td>
                                {{$planload->select_company}}
                            </td>
                            <td>
                                {{$planload->vessel}}
                            </td>
                            <td>
                                {{$planload->pol}}
                            </td>
                            <td>
                                {{$planload->pot}}
                            </td>
                            <td>
                                {{$planload->pod}}
                            </td>
                            <td>
                                {{$planload->pengirim}}
                            </td>
                            <td>
                                {{$planload->penerima}}
                            </td>
                            <td>
                                {{$planload->nama_barang}}
                            </td>
                            <td>
                                {{$planload->nama_barang}}
                            </td>
                            <td>
                                {{$planload->nama_barang}}
                            </td>
                            <td>
                                {{$planload->nama_barang}}
                            </td>
                            <td class="text-center"><button onclick="editPlanload(this)" value="{{$planload->slug}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                <button onclick="deletePlanload(this)" value="{{$planload->slug}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
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

</div>

@endsection
