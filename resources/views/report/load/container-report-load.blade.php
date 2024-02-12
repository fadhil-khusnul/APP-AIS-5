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

            <table id="containerloadreport" class="align-top table mb-0 table-bordered table-striped table-hover  autosize">
              <thead class="text-nowrap">
                <tr>
                  <th>No</th>
                  <th></th>
                  <th>Tanggal kegiatan</th>
                  <th>Status</th>
                  <th>Nomor Kontainer</th>
                  <th>Size/Type</th>
                  <th>Cargo</th>
                  <th>Vessel (Nama Kapal)</th>
                  <th>Kode Kapal</th>
                  <th>POL</th>
                  <th>POD</th>
                  <th>Pengirim</th>
                  <th>Penerima</th>
                  <th>BL Number</th>
                  <th>Total Cost</th>
                  <th>Cost</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($containers as $container)
                  <tr>
                    <td>
                      {{ $loop->iteration }}
                    </td>
                    <td class="text-center text-nowrap">
                      <a href="/downloadcoload/{{ $container->id }}" class="btn btn-success btn-sm btn-icon"><i
                          class="bi bi-download"></i>

                      </a>


                    </td>
                    <td>{{ \Carbon\Carbon::parse($container->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}</td>

                    <td>
                      {{ $container->status }}
                    </td>
                    <td>
                      {{ $container->nomor_kontainer }}
                    </td>
                    <td>
                      {{ $container->size }}/{{ $container->type }}
                    </td>
                    <td>
                      {{ $container->cargo }}
                    </td>
                    <td>
                      {{ $container->planload->vessel }}
                    </td>
                    <td>
                      {{ $container->planload->vessel_code }}
                    </td>
                    <td>
                      {{ $container->planload->pol }}
                    </td>

                    <td>
                      {{ $container->pod_container }}
                    </td>
                    <td>
                      {{ $container->pengirim }}
                    </td>
                    <td>
                      {{ $container->penerima }}
                    </td>
                    <td>
                      {{ $container->si_pdf_containers->nomor_bl }}
                    </td>

                    @if ($container->harga_alih != null)
                      <td>
                        @rupiah($container->alihs->harga_alih_kapal + $container->ongkos_supir + $container->biaya_trucking + $container->biaya_thc + $container->biaya_stuffing + $container->harga_batal + $container->biaya_seal + $container->freight + $container->lss + $container->thc_pod + $container->lolo + $container->dooring + $container->demurrage + $container->total_biaya_lain + $container->total_biaya_lain_pod)

                      </td>
                    @else
                      <td>
                        @rupiah($container->ongkos_supir + $container->biaya_trucking + $container->biaya_thc + $container->biaya_stuffing + $container->harga_batal + $container->biaya_seal + $container->freight + $container->lss + $container->thc_pod + $container->lolo + $container->dooring + $container->demurrage + $container->total_biaya_lain + $container->total_biaya_lain_pod)

                      </td>
                    @endif
                    <td>
                      {{ $container->ongkos_supir + $container->biaya_trucking + $container->biaya_thc + $container->biaya_stuffing + $container->harga_batal + $container->biaya_seal + $container->freight + $container->lss + $container->thc_pod + $container->lolo + $container->dooring + $container->demurrage + $container->total_biaya_lain + $container->total_biaya_lain_pod }}

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


  <script></script>
@endsection
