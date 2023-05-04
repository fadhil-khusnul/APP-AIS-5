@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-12">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">{{ $title }}</h3>
                </div>
                <div class="portlet-body">
                    {{-- <div class="text-end">

                    <a href="planload/create" class="btn btn-success"> <i class="fa fa-plus"></i> Buat Job (Load)</a>
                </div> --}}
                    {{-- <p><strong>Fixed header</strong> can be initialised on a Datatable by using the <code>fixedheader</code> option in the Datatable options object.</p> --}}
                    <hr>

                    <!-- BEGIN Datatable -->
                    <div class="table-responsive">

                        <table id="planload" class="text-nowrap table mb-0 table-bordered table-striped table-hover autosize">
                            <thead>
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


                                    <th class="align-top">Kontainer (SIZE - TYPE - CARGO - SEAL - NOMOR KONTAINER - DATE)</th>
                                    <th class="align-top">Remark-Kontainer (NOMOR KONTAINER - DRIVER - NO. POLISI - REMARK)</th>
                                    <th class="align-top">Biaya-Kontainer (NOMOR KONTAINER - BIAYA STUFFING - BIAYA TRUCKING - ONGKOS SUPIR - THC)</th>
                                    <th class="align-top">Biaya Lain Kontainer (NOMOR KONTAINER - BIAYA - KETERANGAN)</th>


                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($planloads as $planload)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
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
                                            {{$planload->pol}}
                                        </td>
                                        <td>
                                            {{$planload->pot}}
                                        </td>
                                        <td>
                                            {{$planload->pod}}
                                        </td>

                                        <td align="top" valign="top">
                                            <ol type="1">
                                                @foreach ($containers as $container)
                                                    @if ($planload->id == $container->job_id)
                                                        <li>
                                                            {{ $container->size }} - {{$container->type}} - {{ $container->cargo }} - @if ($container->seal != null) {{$container->seal}} @else ? @endif -
                                                            @if ($container->nomor_kontainer != null) {{$container->nomor_kontainer}} @else ? @endif
                                                            - @if ($container->date_activity != null) {{$container->date_activity}} @else ? @endif
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ol>

                                        </td>
                                        <td align="top" valign="top">
                                            @if ($planload->status == 'Process-Load')
                                                <ol start="1">
                                                    @foreach ($containers as $container)
                                                        @if ($planload->id == $container->job_id)
                                                            <li>
                                                                {{ $container->nomor_kontainer }} - {{$container->driver}} - {{$container->nomor_polisi}} - {{$container->remark}}
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ol>
                                            @else
                                                -
                                            @endif


                                        </td>
                                        <td align="top" valign="top">
                                            @if ($planload->status == 'Process-Load')
                                                <ol start="1">
                                                    @foreach ($containers as $container)
                                                        @if ($planload->id == $container->job_id)
                                                            <li>
                                                                {{ $container->nomor_kontainer }} - {{$container->biaya_stuffing}} - {{$container->biaya_trucking}} - {{$container->ongkos_supir}} - {{$container->biaya_thc}}
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ol>
                                            @else
                                                -
                                            @endif


                                        </td>
                                        <td align="top" valign="top">
                                            @if ($planload->status == 'Process-Load')
                                                <ol start="1">
                                                    @foreach ($biayas as $biaya)
                                                        @if ($planload->id == $biaya->job_id)
                                                            <li>
                                                                {{ $biaya->pilih_kontainer }} - {{$biaya->harga_biaya}} - {{$biaya->keterangan}}
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ol>
                                            @else
                                                -
                                            @endif


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
                                        <td class="text-center text-nowrap">
                                            @if ($planload->status == 'Plan-Load')
                                            <a href="/processload-create/{{ $planload->slug }}"
                                                class="btn btn-label-success rounded-pill">Process Load <i
                                                    class="fa fa-pencil"></i>

                                            </a>
                                            @else
                                            <button disabled @readonly(true)
                                                class="btn btn-label-secondary rounded-pill">Process Load <i
                                                    class="fa fa-pencil"></i>

                                            </button>


                                            @endif
                                        </td>

                                        {{-- <button onclick="deletePlanload(this)" value="{{$planload->slug}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                    class="fa fa-trash"></i></button></td> --}}

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
