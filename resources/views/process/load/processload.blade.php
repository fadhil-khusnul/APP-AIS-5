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

                        <table id="processload" class="align-top table mb-0 table-bordered table-striped table-hover  autosize">
                            <thead class="text-nowrap">
                                <tr>
                                    <th>No</th>
                                    <th>Tangal Kegiatan</th>
                                    <th>Vessel</th>
                                    <th>Vessel-Code</th>
                                    <th>Shipping Company</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Activity</th>
                                    <th>POL</th>
                                    <th>POT</th>
                                    <th>POD</th>
                                    <th>Seal Kontainer</th>
                                    <th>SPK Kontainer</th>
                                    <th>Vendor Mobil</th>
                                    <th>Nama Supir/Nomor Polisi</th>
                                    <th>Biaya Trucking</th>
                                    <th>Ongkos Supir</th>


                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($containers as $container)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}
                                        </td>
                                        <td>
                                            {{$container->planload->vessel}}
                                        </td>
                                        <td>
                                            {{$container->planload->vessel_code}}
                                        </td>
                                        <td>
                                            {{$container->planload->select_company}}
                                        </td>
                                        <td>
                                            {{$container->pengirim}}
                                        </td>
                                        <td>
                                            {{$container->penerima}}
                                        </td>
                                        <td>
                                            {{$container->planload->activity}}
                                        </td>
                                        <td>
                                            {{$container->planload->pol}}
                                        </td>
                                        <td>
                                            {{$container->planload->pot}}
                                        </td>
                                        <td>
                                            {{$container->planload->pod}}
                                        </td>

                                        <td>
                                            <ol type="1">

                                                @foreach ($sealcontainers as $seal)
                                                @if ($container->id == $seal->kontainer_id)
                                                    <li>{{$seal->seal_kontainer}}</li>
                                                @endif
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td>
                                            <ol type="1">

                                                @foreach ($sealcontainers as $seal)
                                                @if ($container->id == $seal->kontainer_id)
                                                    <li>{{$seal->seal_kontainer}}</li>
                                                @endif
                                                @endforeach
                                            </ol>
                                        </td>

                                        <td>
                                            @if ($container->nomor_polisi != null)
                                            {{$container->mobils->vendors->nama_vendor}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($container->nomor_polisi != null)

                                            {{$container->mobils->nama_supir}}/{{$container->mobils->nomor_polisi}}
                                            @endif
                                        </td>

                                        <td>@rupiah($container->biaya_trucking)</td>
                                        <td>@rupiah($container->ongkos_supir)</td>





                                        {{-- <td align="top" valign="top">
                                            @if (count($batalmuat) != 0)
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


                                        </td> --}}

                                        <td class="align-middle text-nowrap">
                                            @if ($container->status == 'Process-Load')
                                            <i class="marker marker-dot text-success"></i>
                                                {{ $container->status }}
                                            @endif
                                            @if ($container->status == 'Alih-Kapal')
                                            <i class="marker marker-dot text-primary"></i>
                                                {{ $container->status }}
                                            @endif
                                            @if ($container->status == 'Batal-Muat')
                                            <i class="marker marker-dot text-dark"></i>
                                                {{ $container->status }}
                                            @endif
                                            @if ($container->status == 'Realisasi')
                                            <i class="marker marker-dot text-danger"></i>
                                                {{ $container->status }}
                                            @endif
                                            @if ($container->status == null)
                                            <i class="marker marker-dot text-warning"></i>
                                                Plan
                                            @endif
                                        </td>
                                        <td class="text-center text-nowrap">

                                            <a href="/processload-create/{{ $container->planload->slug }}"
                                                class="btn btn-success rounded-pill">Process Load <i
                                                    class="fa fa-pencil"></i>

                                            </a>

                                            @if ($container->status == "Alih-Kapal")
                                            <button type="button" id="btn_detail" name="btn_detail"
                                                    class="btn btn-label-primary rounded-pill"
                                                    value="{{ $container->id }}" onclick="detail_update(this)">Detail
                                                    Alih Kapal <i class="fa fa-eye"></i></button>
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

    <div class="modal fade" id="modal_detail_kontainer">
        <div class="modal-dialog modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">DETAIL ALIH KAPAL KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body px-4 py-4">

                        <table width="100%">
                            <tr>
                                <td width ="35%">
                                    Dari Kapal (vessel/code)
                                </td>
                                <td width="5%">
                                    :
                                </td>
                                <td id="kapal_lama">

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ke Kapal (vessel/code)
                                </td>
                                <td>
                                    :
                                </td>
                                <td id="kapal_baru">

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Harga Alih Kapal
                                </td>
                                <td>
                                    :
                                </td>
                                <td id="harga_alih">

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pelayaran Alih Kapal
                                </td>
                                <td>
                                    :
                                </td>
                                <td id="pelayaran_alih">

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    POT Alih Kapal
                                </td>
                                <td>
                                    :
                                </td>
                                <td id="pot_alih">

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    POD Alih Kapal
                                </td>
                                <td>
                                    :
                                </td>
                                <td id="pod_alih">

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Keterangan Alih Kapal
                                </td>
                                <td>
                                    :
                                </td>
                                <td id="keterangan_alih">

                                </td>
                            </tr>
                        </table>






                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>


        </div>
    </div>

    <script>
function detail_update(e) {
    let id = e.value;
    console.log(id);
    var swal = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success btn-wide mx-1",
            denyButton: "btn btn-secondary btn-wide mx-1",
            cancelButton: "btn btn-danger btn-wide mx-1",
        },
        buttonsStyling: false,
    });

    $.ajax({
        url: "/detail-alihkapal/" + id,
        type: "GET",
        success: function (response) {

            $('#modal_detail_kontainer').modal('show');


            $('#kapal_lama').html(response.kapal[0].vessel +" / "+ response.kapal[0].vessel_code)
            $('#kapal_baru').html(response.alih[0].vesseL_alih +" / "+ response.alih[0].code_vesseL_alih)
            $('#harga_alih').html("Rp. "+tandaPemisahTitik(response.alih[0].harga_alih_kapal))
            $('#pelayaran_alih').html(response.alih[0].pelayaran_alih)

            if (response.alih[0].pot_alih == null) {

                $('#pot_alih').html("-")
            }
            else{

                $('#pot_alih').html(response.alih[0].pot_alih)
            }
            $('#pod_alih').html(response.alih[0].pod_alih)
            $('#keterangan_alih').html(response.alih[0].keterangan_alih_kapal)

        }
    });
}

function tandaPemisahTitik(b) {
    var _minus = false;
    if (b < 0) _minus = true;
    b = b.toString();
    b = b.replace(".", "");
    b = b.replace("-", "");
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
            c = b.substr(i - 1, 1) + "." + c;
        } else {
            c = b.substr(i - 1, 1) + c;
        }
    }
    if (_minus) c = "-" + c;
    return c;
}
    </script>
@endsection
