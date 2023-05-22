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

                                    <th class="align-top"> (JUMLAH) X SIZE - TYPE - CARGO KONTAINER :</th>
                                    <th class="align-top">SEAL KONTAINER (SIZE - TYPE - CARGO - SEAL - DATE - NOMOR KONTAINER) :</th>
                                    <th class="align-top">REMARK KONTAINER (NOMOR KONTAINER - DRIVER - NO. POLISI - REMARK) :</th>
                                    <th class="align-top">BIAYA KONTAINER (NOMOR KONTAINER - BIAYA RELOKASI - JAMINAN KONTAINER) :</th>
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

                                        <td align="top" valign="top">
                                            <ol type="1">
                                                @foreach ($containers_group as $container)
                                                    @if ($plandischarge->id == $container->job_id)
                                                        <li>
                                                            ({{ $container->jumlah_kontainer }}) x {{ $container->size }} - {{$container->type}} - {{ $container->cargo }}
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ol>

                                        </td>
                                        <td align="top" valign="top">
                                            <ol type="1">
                                                @foreach ($containers as $container)
                                                    @if ($plandischarge->id == $container->job_id)
                                                        <li>
                                                            {{ $container->size }} - {{$container->type}} - {{ $container->cargo }} - @if ($container->seal != null) {{$container->seal}} @else ? @endif -
                                                            @if ($container->date_activity != null) {{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }} @else ? @endif
                                                            - @if ($container->nomor_kontainer != null) {{$container->nomor_kontainer}} @else ? @endif
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ol>

                                        </td>
                                        <td align="top" valign="top">
                                            @if ($plandischarge->status == 'Process-Discharge')
                                                <ol start="1">
                                                    @foreach ($containers as $container)
                                                        @if ($plandischarge->id == $container->job_id)
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
                                            @if ($plandischarge->status == 'Process-Discharge')
                                                <ol start="1">
                                                    @foreach ($containers as $container)
                                                        @if ($plandischarge->id == $container->job_id)
                                                            <li>
                                                                {{ $container->nomor_kontainer }} - @rupiah($container->biaya_relokasi) - @rupiah($container->jaminan_kontainer)
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ol>
                                            @else
                                                -
                                            @endif

                                        </td>






                                        <td class="align-middle text-nowrap">
                                            @if ($plandischarge->status == 'Process-Discharge')
                                            <i class="marker marker-dot text-success"></i>
                                                {{ $plandischarge->status }}
                                            @endif
                                            @if ($plandischarge->status == 'Realisasi')
                                            <i class="marker marker-dot text-danger"></i>
                                                {{ $plandischarge->status }}
                                            @endif
                                        </td>
                                        <td class="text-center text-nowrap">
                                            @if ($plandischarge->status == 'Realisasi')
                                            <button disabled class="btn btn-label-secondary rounded-pill">
                                             Realisasi Discharge <i class="fa fa-pencil"></i>
                                            </button>

                                            @else
                                            <a href="/realisasidischarge-create/{{ $plandischarge->slug }}"
                                                class="btn btn-label-danger rounded-pill">Realisasi Discharge <i
                                                    class="fa fa-pencil"></i>

                                            </a>

                                            @endif
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
