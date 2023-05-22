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
                        <a href="truckingplan/create" class="btn btn-success"> <i class="fa fa-plus"></i> Buat Plan (Trucking <i class="fa fa-truck"></i> )</a>
                    </div>


                </div>


                <hr>

                <!-- BEGIN Datatable -->
                <table id="plantrucking" class="table table-responsive table-bordered table-striped table-hover autosize">
                    <thead class="align-top text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Plan</th>
                            <th>Vessel</th>
                            <th>Vessel-Code</th>
                            <th>Shipping Company</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>EMKL</th>
                            <th>Activity</th>
                            <th class="align-top">JUMLAH X (SIZE - TYPE - CARGO CONTAINER)</th>

                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($truckings as $trucking)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($trucking->tanggal)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                            <td>
                                {{$trucking->vessel}}
                            </td>
                            <td>
                                {{$trucking->vessel_code}}
                            </td>

                            <td>
                                {{$trucking->select_company}}
                            </td>
                            <td>
                                {{$trucking->pengirim}}
                            </td>
                            <td>
                                {{$trucking->penerima}}
                            </td>
                            <td>
                                {{$trucking->emkl}}
                            </td>
                            <td>
                                {{$trucking->activity}}
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

                            <td class="text-center">
                                <a href="/plantrucking-edit/{{$trucking->slug}}" class="btn btn-label-primary rounded-pill">Edit Plan <i class="fa fa-pencil"></i></a>
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
