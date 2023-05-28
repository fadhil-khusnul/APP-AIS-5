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

                    <div style="margin-left: auto; margin-right:0px;" class="margin-atas text-end">
                        <a href="plandischarge/create" class="btn btn-success"> <i class="fa fa-plus"></i> Buat Plan (Discharge)</a>
                    </div>


                </div>


            {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
                <hr>

                <!-- BEGIN Datatable -->
                <table id="plandischarge" class="table table-responsive table-bordered table-striped table-hover autosize">
                    <thead class="align-top text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Tiba</th>
                            <th>Nomor DO</th>
                            <th>Vessel</th>
                            <th>Vessel-Code</th>
                            <th>Shipping Company</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>Activity</th>
                            <th>POL</th>
                            <th>POD</th>
                            <th class="align-top">JUMLAH X (SIZE - TYPE - CARGO CONTAINER)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plandischarges as $plandischarge)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($plandischarge->tanggal_tiba)->isoFormat('dddd, DD MMMM YYYY') }}
                            </td>


                            <td>
                                {{$plandischarge->nomor_do}}
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
                                {{$plandischarge->penerima}}
                            </td>
                            <td>
                                {{$plandischarge->activity}}
                            </td>
                            <td>
                                {{$plandischarge->pol}}
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


                            <td class="text-center">
                                @if ($plandischarge->status == 'Plan-Discharge')
                                <a href="/plandischarge-edit/{{$plandischarge->slug}}" class="btn btn-label-info btn-icon btn-circle btn-sm"><i class="fa fa-pencil"></i></a>

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
