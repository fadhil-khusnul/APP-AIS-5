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

                        <table id="tabelinvoice" class="table mb-0 table-bordered table-striped table-hover seratus">
                            <thead class="text-nowrap">
                                <tr>
                                    <th>No</th>
                                    <th></th>
                                    <th>Nomor Invoice</th>
                                    <th>Vessel</th>
                                    <th>Vessel-Code</th>
                                    <th>Shipping Company</th>
                                    <th>Activity</th>
                                    <th>POL</th>
                                    <th>POT</th>
                                    <th>Jumlah Kontainer</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($loads as $planload)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    

                                    <td class="text-center text-nowrap">
                                        <a href="/invoice-load-create/{{ $planload->slug }}"
                                            class="btn btn-primary btn-sm">Buat Invoice <i
                                                class="fa fa-pencil"></i>

                                        </a>

                                    </td>
                                    <td>
                                        {{$planload->vessel}}
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
                                    <td>
                                        {{$planload->pot}}
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
