@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-12">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">{{ $title }}</h3>
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


                    </div>
                    <hr>

                    <!-- BEGIN Datatable -->
                    <div class="table-responsive">

                        <table id="realisasiload" class="table mb-0 table-bordered table-striped table-hover autosize">
                            <thead class="text-nowrap">
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


                                    <th class="align-top"> (JUMLAH) X SIZE - TYPE - CARGO KONTAINER :</th>
                                    <th class="align-top">SEAL KONTAINER (SIZE - TYPE - CARGO - SEAL - DATE - NOMOR KONTAINER) :</th>
                                    <th class="align-top">REMARK KONTAINER (NOMOR KONTAINER - DRIVER - NO. POLISI - REMARK) :</th>
                                    <th class="align-top">BIAYA KONTAINER (NOMOR KONTAINER - BIAYA STUFFING - BIAYA TRUCKING - ONGKOS SUPIR - THC) :</th>
                                    <th class="align-top">BIAYA LAIN KONTAINER (NOMOR KONTAINER - BIAYA - KETERANGAN) :</th>
                                    <th class="align-top">BIAYA ALIH KAPAL (NOMOR KONTAINER - BIAYA ALIH KAPAL - KETERANGAN) :</th>
                                    <th class="align-top">BIAYA BATAL MUAT (NOMOR KONTAINER - BIAYA BATAL MUAT - KETERANGAN) :</th>
                                    <th>Status</th>



                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($planloads as $planload)
                                    {{-- @if ($planload->status == "Process-Load" || $planload->status == "Realisasi" ) --}}
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
                                                @foreach ($containers_group as $container)
                                                    @if ($planload->id == $container->job_id)
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
                                                    @if ($planload->id == $container->job_id)
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
                                                <ol start="1">
                                                    @foreach ($containers as $container)
                                                        @if ($planload->id == $container->job_id)
                                                            <li>
                                                                {{ $container->nomor_kontainer }} - {{$container->driver}} - {{$container->nomor_polisi}} - {{$container->remark}}
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ol>



                                        </td>
                                        <td align="top" valign="top">
                                                <ol start="1">
                                                    @foreach ($containers as $container)
                                                        @if ($planload->id == $container->job_id)
                                                            <li>
                                                                {{ $container->nomor_kontainer }} - @rupiah($container->biaya_stuffing) - @rupiah($container->biaya_trucking) - @rupiah($container->ongkos_supir) - @rupiah($container->biaya_thc)
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ol>


                                        </td>
                                        <td align="top" valign="top">
                                            @if (count($biayas) > 0)
                                                <ol start="1">
                                                    @foreach ($biayas as $biaya)
                                                        @if ($planload->id == $biaya->job_id)
                                                            <li>
                                                                {{$biaya->kontainer_biaya}} - @rupiah($biaya->harga_biaya) - {{$biaya->keterangan}}
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ol>
                                            @else
                                                (-)
                                            @endif


                                        </td>

                                        <td align="top" valign="top">
                                            @if (count($alihkapal) > 0)
                                                <ol start="1">
                                                    @foreach ($alihkapal as $alih)
                                                        @if ($planload->id == $alih->job_id)
                                                            <li>
                                                                {{ $alih->kontainer_alih }} - @rupiah($alih->harga_alih_kapal) - {{$alih->keterangan_alih_kapal}}
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ol>
                                            @else
                                                (-)
                                            @endif


                                        </td>

                                        <td align="top" valign="top">
                                            @if (count($batalmuat) > 0)
                                                <ol start="1">
                                                    @foreach ($batalmuat as $batal)
                                                        @if ($planload->id == $batal->job_id)
                                                            <li>
                                                                {{ $batal->kontainer_batal }} - @rupiah($batal->harga_batal_muat) - {{$batal->keterangan_batal_muat}}
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ol>
                                            @else
                                                (-)
                                            @endif


                                        </td>
                                        <td class="align-middle text-nowrap">
                                            @if ($planload->status == 'Process-Load')
                                            <i class="marker marker-dot text-success"></i>
                                                {{ $planload->status }}
                                            @endif
                                            @if ($planload->status == 'Realisasi')
                                            <i class="marker marker-dot text-danger"></i>
                                                {{ $planload->status }}
                                            @endif
                                        </td>



                                        <td class="text-center text-nowrap">
                                            @if ($planload->status == 'Process-Load')
                                            <a href="/realisasi-load-create/{{ $planload->slug }}"
                                                class="btn btn-label-danger rounded-pill">Realisasi Load <i
                                                    class="fa fa-pencil"></i>

                                            </a>
                                            @else
                                            <a href="/realisasi-tambah-kontainer/{{ $planload->slug }}"
                                                class="btn btn-label-primary rounded-pill">Tambah Kontainer <i
                                                    class="fa fa-plus"></i>
                                            </a>

                                            <a href="/invoice-load/{{ $planload->slug }}"
                                                class="btn btn-label-success rounded-pill">Buat Invoice <i
                                                    class="fa fa-book"></i>
                                            </a>


                                            @endif
                                        </td>

                                        {{-- <button onclick="deletePlanload(this)" value="{{$planload->slug}}" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                    class="fa fa-trash"></i></button></td> --}}

                                    </tr>
                                    {{-- @endif --}}

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