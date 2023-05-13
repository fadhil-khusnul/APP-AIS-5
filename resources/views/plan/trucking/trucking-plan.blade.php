\@extends('layouts.main')

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
                            <option selected disabled>Filter Pelayaran</option>
                            @foreach ($select_company as $select_company)
                                <option value="{{$select_company->pelayaran}}">{{$select_company->pelayaran}}</option>

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
                        <a href="truckingplan/create" class="btn btn-success"> <i class="fa fa-plus"></i> Buat Plan (Trucking <i class="fa fa-truck"></i> )</a>
                    </div>


                </div>


                {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
                <hr>

                <!-- BEGIN Datatable -->
                <table id="planload" class="table table-responsive table-bordered table-striped table-hover autosize">
                    <thead class="align-top text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>Pelayaran</th>
                            <th>Vessel</th>
                            <th>Vessel-Code</th>
                            <th>Activity</th>
                            <th>EMKL</th>
                            <th class="align-top">JUMLAH X (SIZE - TYPE - CARGO CONTAINER)</th>

                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($truckings as $trucking)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$trucking->pelayaran}}
                            </td>
                            <td>
                                {{$trucking->vessel}}
                            </td>
                            <td>
                                {{$trucking->vessel_code}}
                            </td>

                            <td>
                                {{$trucking->activity}}
                            </td>
                            <td>
                                {{$trucking->emkl}}
                            </td>

                            <td align="top" valign="top">
                                <ol type="1">
                                    @foreach ($containers as $container)
                                        @if ($trucking->id == $container->job_id)
                                        <li>
                                            {{$container->jumlah_kontainer}} X ({{$container->size}} - {{$container->type}} - {{$container->cargo}})
                                        </li>
                                        @endif
                                    @endforeach
                                </ol>

                            </td>
                                {{-- <td align="top" valign="top">
                                    <ol start="1">
                                    @foreach ($containers as $container)
                                        @if ($trucking->id == $container->job_id)
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
                                        @if ($trucking->id == $container->job_id)
                                            <li>
                                                {{$container->type}}
                                            </li>
                                        @endif
                                    @endforeach
                                    </ol>

                                </td> --}}
                                <td class="align-middle text-nowrap">
                                    @if ($trucking->status == 'Process-Load')
                                    <i class="marker marker-dot text-success"></i>
                                        {{ $trucking->status }}
                                    @endif
                                    @if ($trucking->status == 'Plan-Load')
                                    <i class="marker marker-dot text-warning"></i>
                                        {{ $trucking->status }}
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if ($trucking->status == 'Plan-Load')
                                    <a href="/planload-edit/{{$trucking->slug}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></a>

                                    @else
                                    <button disabled @readonly(true) class="btn btn-label-secondary btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                    @endif

                                    {{-- <button onclick="deletePlanload(this)" value="{{$trucking->slug}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
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