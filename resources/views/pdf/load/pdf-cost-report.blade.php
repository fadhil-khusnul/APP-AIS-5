<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="{{ public_path('/') }}./assetS/css-surat/report.css" rel="stylesheet" />

  <title>COST DETAIL REPORT</title>
</head>

<body>
  <header>
    <img class="header-online" src="{{ public_path('/') }}./assets/images/online.png" alt="">

  </header>
  <main>
    <h3 class="judul">COST DETAIL REPORT</h3>

    <table width="100%">
      <tr valign="top">
        <td width="">
          ACTIVITY
        </td>
        <td width="2%">:</td>
        <td width="">{{ $report }}</td>

        <td width="10%"></td>

        <td width="">
          Shipping Company (Pelayaran)
        </td>
        <td width="2%">:</td>
        <td width="">{{ $load->select_company }}</td>
      </tr>

      <tr valign="top">
        <td>
          TANGGAL AWAL
        </td>
        <td width="2%">:</td>
        <td>{{ \Carbon\Carbon::parse($min_date)->isoFormat('dddd, DD MMMM YYYY') }}</td>
        <td width="10%"></td>

        <td>
          Vessel/Voyage
        </td>
        <td width="2%">:</td>
        <td>{{ $load->vessel }}</td>
      </tr>
      <tr valign="top">
        <td>
          TANGGAL AKHIR
        </td>
        <td width="2%">:</td>
        <td>{{ \Carbon\Carbon::parse($max_date)->isoFormat('dddd, DD MMMM YYYY') }}</td>

        <td width="10%"></td>

        <td>
          Vessel Code
        </td>
        <td width="2%">:</td>
        <td>{{ $load->vessel_code }}</td>
      </tr>
      <tr valign="top">
        <td>
          POL
        </td>
        <td width="2%">:</td>
        <td>{{ $load->pol }}</td>
      </tr>


      {{-- <tr>
                    <td>
                        Shipping Company (Pelayaran)
                    </td>
                    <td>:</td>
                    <td>{{ $load->select_company }}</td>
                </tr>
                <tr>
                    <td>
                        Vessel/Voyage
                    </td>
                    <td>:</td>
                    <td>{{ $load->vessel }}</td>
                </tr>
                <tr>
                    <td>
                        Vessel Code
                    </td>
                    <td>:</td>
                    <td>{{ $load->vessel_code }}</td>
                </tr> --}}

    </table>

    <div class="table-container">

      <table class="table" width="100%" align="center">
        <thead class="biru">
          <tr valign="top">
            <th width="3%" >NO</th>
            <th width="10%">CONTAINER</th>
            <th>SIZE/TYPE</th>
            <th>ONGKOS SUPIR</th>
            <th>BIAYA TRUCKING</th>
            <th>THC POL</th>
            <th>BIAYA STUFFING</th>
            <th>BIAYA ALIH KAPAL</th>
            <th>BIAYA BATAL MUAT</th>
            <th>BIAYA SEAL</th>
            <th>FREIGHT</th>
            <th>LSS</th>
            <th>THC POD</th>
            <th>LOLO</th>
            <th>DOORING</th>
            <th>DEMURRAGE</th>
            <th>TOTAL BIAYA LAIN</th>
          </tr>
        </thead>
  
  
        <tbody>
          @foreach ($containers as $container)
            <tr valign="top">
              <td>{{ $loop->iteration }}</td>
              @if ($container->status == 'Alih-Kapal')
                <td>{{ $container->nomor_kontainer }} (Alih-Kapal)</td>
              @elseif ($container->status == 'Batal-Muat')
                <td>{{ $container->nomor_kontainer }} (Batal Muat)</td>
              @else
                <td>{{ $container->nomor_kontainer }}</td>
              @endif
              <td>{{ $container->size }}/{{ $container->type }}</td>
              {{-- <td align="center" valign="top">
                                  @foreach ($seals as $seal)
                                      @foreach ($seal as $seal_2)
                                          @if ($container->id == $seal_2['kontainer_id'])
                                              @if ($seal[count($seal) - 1] != $seal[$loop->iteration - 1])
                                                  {{ $seal_2["seal_kontainer"] }}, &ensp;
                                              @else
                                                  {{ $seal_2["seal_kontainer"] }}
                                              @endif
                                          @endif
                                      @endforeach
                                  @endforeach
                              </td> --}}
              <td class="harga">@rupiah2($container->ongkos_supir)</td>
              <td class="harga">@rupiah2($container->biaya_trucking)</td>
              <td class="harga">@rupiah2($container->biaya_thc)</td>
              <td class="harga">@rupiah2($container->biaya_stuffing)</td>
              @if ($container->status == 'Alih-Kapal')
                <td class="harga">@rupiah2($container->alihs->harga_alih_kapal)</td>
              @else
                <td class="harga">0</td>
              @endif
              @if ($container->status == 'Batal-Muat')
                <td class="harga">@rupiah2($container->harga_batal)</td>
              @else
                <td class="harga">0</td>
              @endif
              <td class="harga">@rupiah2($container->biaya_seal)</td>
              <td class="harga">@rupiah2($container->freight)</td>
              <td class="harga">@rupiah2($container->lss)</td>
              <td class="harga">@rupiah2($container->thc_pod)</td>
              <td class="harga">@rupiah2($container->lolo)</td>
              <td class="harga">@rupiah2($container->dooring)</td>
              <td class="harga">@rupiah2($container->demurrage)</td>
              <td class="harga">@rupiah2($container->total_biaya_lain + $container->total_biaya_lain_pod)</td>
  
            </tr>
          @endforeach
  
  
        </tbody>
  
        <tfoot>
          <tr>
            <td colspan="3" align="right">SUB TOTAL :</td>
            <td>@rupiah2($subtotals['ongkos_supir'])</td>
            <td>@rupiah2($subtotals['biaya_trucking'])</td>
            <td>@rupiah2($subtotals['biaya_thc'])</td>
            <td>@rupiah2($subtotals['biaya_stuffing'])</td>
            <td>@rupiah2($sum_alih)</td>
            <td>@rupiah2($subtotals['harga_batal'])</td>
            <td>@rupiah2($subtotals['biaya_seal'])</td>
            <td>@rupiah2($subtotals['freight'])</td>
            <td>@rupiah2($subtotals['lss'])</td>
            <td>@rupiah2($subtotals['thc_pod'])</td>
            <td>@rupiah2($subtotals['lolo'])</td>
            <td>@rupiah2($subtotals['dooring'])</td>
            <td>@rupiah2($subtotals['demurrage'])</td>
            <td>@rupiah2($subtotals['total_biaya_lain'] + $subtotals['total_biaya_lain_pod'])</td>
  
          </tr>
          <tr>
            <td colspan="17">TOTAL : @rupiah($subtotals['ongkos_supir'] + $subtotals['biaya_trucking'] + $subtotals['biaya_thc'] + $subtotals['biaya_stuffing'] + $sum_alih + $subtotals['harga_batal'] + $subtotals['biaya_seal'] + $subtotals['freight'] + $subtotals['lss'] + $subtotals['thc_pod'] + $subtotals['lolo'] + $subtotals['dooring'] + $subtotals['demurrage'] + $subtotals['total_biaya_lain'] + $subtotals['total_biaya_lain_pod']) </td>
          </tr>
  
        </tfoot>
  
  
      </table>
    </div>





  </main>






</body>

</html>
