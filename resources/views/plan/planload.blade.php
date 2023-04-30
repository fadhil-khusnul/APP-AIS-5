@extends('layouts.main')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="portlet">
            <div class="portlet-header portlet-header-bordered g-8">

                <h3 class="portlet-title">{{$title}}</h3>


            </div>
            <div class="portlet-body">


                <div class="row row-cols-lg-auto px-5 g-5">
                    <div class="col-6">
                        <select class="form-select" id="filter_company">
                            <option selected disabled>Filter Shipping Company</option>
                            @foreach ($select_company as $select_company)
                                <option value="{{$select_company->select_company}}">{{$select_company->select_company}}</option>

                            @endforeach

                        </select>

                    </div>
                    <div class="col-6">
                        <select class="form-select" id="filter_vessel">
                            <option selected disabled>Filter Vessel</option>
                            @foreach ($vessel as $vessel)
                                <option value="{{$vessel->vessel}}">{{$vessel->vessel}}</option>

                            @endforeach

                        </select>

                    </div>
                    <div style="margin-left: auto; margin-right:0px;" class="margin-atas text-end">
                        <a href="planload/create" class="btn btn-success"> <i class="fa fa-plus"></i> Buat Job (Load)</a>
                    </div>


                </div>


                {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
                <hr>

                <!-- BEGIN Datatable -->
                <table id="planload" class="table table-responsive table-bordered table-striped table-hover autosize">
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
                            <th>Nama Barang</th>
                            <th>Jenis Kontainer</th>
                            <th>Size Container</th>
                            <th>Type Container</th>
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

                                <td align="top" valign="top">
                                    <ol type="1">
                                        @foreach ($containers as $container)
                                            @if ($planload->id == $container->job_id)
                                            <li>
                                                {{$container->kontainers->jenis_container}}
                                            </li>
                                            @endif
                                        @endforeach
                                    </ol>

                                </td>
                                <td align="top" valign="top">
                                    <ol start="1">
                                    @foreach ($containers as $container)
                                        @if ($planload->id == $container->job_id)
                                                <li>
                                                    {{$container->size}}
                                                </li>
                                        @endif
                                    @endforeach
                                    </ol>

                                </td>
                                <td align="top" valign="top">
                                    <ol start="1">
                                    @foreach ($containers as $container)
                                        @if ($planload->id == $container->job_id)
                                            <li>
                                                {{$container->type}}
                                            </li>
                                        @endif
                                    @endforeach
                                    </ol>

                                </td>
                            <td class="text-center"><a href="/planload-edit/{{$planload->slug}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></a>

                                {{-- <button onclick="deletePlanload(this)" value="{{$planload->slug}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button> --}}
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

</div>

@endsection
