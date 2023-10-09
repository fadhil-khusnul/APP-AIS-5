@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-12">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">{{ $title }}</h3>
                </div>
                <div class="portlet-body">

                    <hr>

                    <!-- BEGIN Datatable -->
                    <div class="table-responsive">

                        <table id="processdischarge" class="table mb-0 table-bordered table-striped table-hover autosize">
                            <thead class="align-top text-nowrap">
                                <tr>
                                    <th>No</th>
                                    <th></th>
                                    <th>Status</th>
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

                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plandischarges as $plandischarge)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <a href="/realisasidischarge-create/{{ $plandischarge->slug }}"
                                                class="btn btn-danger btn-sm">Realisasi <i
                                                    class="fa fa-pencil"></i>

                                            </a>

                                    
                                        </td>
                                        <td class="align-middle text-nowrap">
                                            @if ($plandischarge->status == 'Process')
                                            <i class="marker marker-dot text-success"></i>
                                                {{ $plandischarge->status }}
                                            @endif
                                            @if ($plandischarge->status == 'Realisasi')
                                            <i class="marker marker-dot text-danger"></i>
                                                {{ $plandischarge->status }}
                                            @endif
                                        </td>
                                       
                                        <td>{{ \Carbon\Carbon::parse($plandischarge->tanggal_tiba)->isoFormat('dddd, DD MMMM YYYY') }}
                                        </td>

                                        <td>
                                            {{$plandischarge->vessel}}
                                        </td>
                                        <td>
                                            {{$plandischarge->nomor_do}}
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

                                      






                                       


                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <!-- END Datatable -->
                </div>
            </div>

            <!-- END Portlet -->
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>

    </div>
@endsection
