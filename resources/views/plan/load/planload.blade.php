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
                    {{-- <div class="col-6">
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

                    </div> --}}
                    <div style="margin-left: auto; margin-right:0px;" class="margin-atas text-end">
                        <a href="planload/create" class="btn btn-success"> <i class="fa fa-plus"></i> Buat Plan (Load)</a>
                    </div>


                </div>


                {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
                <hr>

                <!-- BEGIN Datatable -->
                <table id="planload" class="table table-responsive table-bordered table-striped table-hover autosize">
                    <thead class="align-top">
                        <tr>
                            <th>No</th>
                            <th>Status</th>
                            <th>Aksi</th>

                            <th>Vessel</th>
                            <th>Vessel-Code</th>
                            <th>Shipping Company</th>
                            <th>Pemilik Barang</th>
                            <th>Activity</th>
                            <th>POL</th>
                            
                            <th class="align-top">Jumlah Kontainer</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($planloads as $planload)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td class="align-middle text-nowrap">
                                @if ($planload->status == 'Process-Load')
                                <i class="marker marker-dot text-success"></i>
                                    {{ $planload->status }}
                                @endif
                                @if ($planload->status == 'Plan-Load')
                                <i class="marker marker-dot text-warning"></i>
                                    {{ $planload->status }}
                                @endif
                            </td>

                            <td class="text-center">
                                @if ($planload->status == 'Plan-Load')
                                <a href="/planload-edit/{{$planload->slug}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></a>

                                @else
                                <button disabled @readonly(true) class="btn btn-label-secondary btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                @endif

                                {{-- <button onclick="deletePlanload(this)" value="{{$planload->slug}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                class="fa fa-trash"></i></button> --}}
                            </td>
                            <td>
                                {{$planload->vessel}}
                            </td>
                            <td>
                                {{$planload->vessel_code}}
                            </td>
                            <td>
                                {{$planload->select_company}}
                            </td>
                            <td>
                                {{$planload->pengirim}}
                            </td>
                            <td>
                                {{$planload->activity}}
                            </td>
                           
                            <td>
                                {{$planload->pod}}
                            </td>
                            <td align="top" valign="top">
                                <b>
                                    {{$containers->where("job_id", $planload->id)->count()}} Kontainer
                                </b>

                            </td>

                                {{-- <td align="top" valign="top">
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

                                </td> --}}
                               

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
