@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-12">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">{{ $title }}</h3>
                </div>
                <div class="portlet-body">


                    <!-- BEGIN Datatable -->
                    <div class="table-responsive">

                        <table id="summaryloadreport" class="align-top table mb-0 table-bordered table-striped table-hover  autosize">
                            <thead class="text-nowrap">
                                <tr>
                                    <th>No</th>
                                    <th></th>
                                    <th>Tanggal</th>
                                    <th>Vessel</th>
                                    <th>Vessel-Code</th>
                                    <th>Shipping Company</th>
                                    <th>Activity</th>
                                    <th>POL</th>
                                    <th class="align-top"> Jumlah Kontainer :</th>
                                   
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($loads as $planload)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <a href="/downloadcload/{{ $planload->slug }}" target="_blank"
                                                class="btn btn-success btn-sm btn-icon "><i
                                                    class="bi bi-download"></i>

                                            </a>


                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($planload->tanggal)->isoFormat('dddd, DD-MMMM-YYYY') }}
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
                                            {{$planload->activity}}
                                        </td>
                                        <td>
                                            {{$planload->pol}}
                                        </td>
                                        <td align="top" valign="top">
                                            <b>
                                                {{$containers->where("job_id", $planload->id)->count()}} Kontainer
                                            </b>

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
