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

                        <table id="invoicedischarge" class="align-top table mb-0 table-bordered table-striped table-hover seratus">
                            <thead class="text-nowrap">
                                <tr>
                                    <th>No</th>
                                    <th></th>
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
                                @foreach ($loads as $planload)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <a href="/invoice-discharge-create/{{ $planload->slug }}"
                                                class="btn btn-primary btn-sm">Buat Invoice <i
                                                    class="fa fa-pencil"></i>
    
                                            </a>
    
                                        </td>

                                        <td>{{ \Carbon\Carbon::parse($planload->tanggal_tiba)->isoFormat('dddd, DD MMMM YYYY') }}
                                        </td>
                                        <td>
                                            {{$planload->nomor_do}}
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
                                            {{$planload->penerima}}
                                        </td>
                                        <td>
                                            {{$planload->activity}}
                                        </td>
                                        <td>
                                            {{$planload->pol}}
                                        </td>
                                      
                                        <td>
                                            {{$planload->pod}}
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
