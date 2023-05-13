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
                        <a href="plandischarge/create" class="btn btn-success"> <i class="fa fa-plus"></i> Buat Plan (Discharge)</a>
                    </div>


                </div>


                {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
                <hr>

                <!-- BEGIN Datatable -->
                <table id="planload" class="table table-responsive table-bordered table-striped table-hover autosize">
                    <thead class="align-top text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>Vessel</th>
                            <th>Vessel-Code</th>
                            <th>Shipping Company</th>
                            <th>Pengirim</th>
                            <th>Activity</th>
                            <th>POL</th>
                            <th>POT</th>
                            <th>POD</th>
                            <th class="align-top">JUMLAH X (SIZE - TYPE - CARGO CONTAINER)</th>

                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plandischarges as $plandischarge)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$plandischarge->vessel}}
                            </td>
                            <td>
                                {{$plandischarge->vessel_code}}
                            </td>
                            <td>
                                {{$plandischarge->select_company}}
                            </td>
                            <td>
                                {{$plandischarge->pengirim}}
                            </td>
                            <td>
                                {{$plandischarge->activity}}
                            </td>
                            <td>
                                {{$plandischarge->pol}}
                            </td>
                            <td>
                                {{$plandischarge->pot}}
                            </td>
                            <td>
                                {{$plandischarge->pod}}
                            </td>
                            <td align="top" valign="top">
                                <ol type="1">
                                    @foreach ($containers as $container)
                                        @if ($plandischarge->id == $container->job_id)
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
                                        @if ($plandischarge->id == $container->job_id)
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
                                        @if ($plandischarge->id == $container->job_id)
                                            <li>
                                                {{$container->type}}
                                            </li>
                                        @endif
                                    @endforeach
                                    </ol>

                                </td> --}}
                                <td class="align-middle text-nowrap">
                                    @if ($plandischarge->status == 'Process-Load')
                                    <i class="marker marker-dot text-success"></i>
                                        {{ $plandischarge->status }}
                                    @endif
                                    @if ($plandischarge->status == 'Plan-Load')
                                    <i class="marker marker-dot text-warning"></i>
                                        {{ $plandischarge->status }}
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if ($plandischarge->status == 'Plan-Load')
                                    <a href="/planload-edit/{{$plandischarge->slug}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></a>

                                    @else
                                    <button disabled @readonly(true) class="btn btn-label-secondary btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></button>

                                    @endif

                                    {{-- <button onclick="deletePlanload(this)" value="{{$plandischarge->slug}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
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
