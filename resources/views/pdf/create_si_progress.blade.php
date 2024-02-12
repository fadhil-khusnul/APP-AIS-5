<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $vessel }}</title>
  <link href="{{ public_path('/') }}./assetS/css-surat/pdf.css" rel="stylesheet" />

</head>

<body>
  <header class="">
    <img class="header-si" src="{{ public_path('/') }}./assets/images/icon.png" alt="">
    <h1 class="title1">
      PT. AIS LOGISTIK MAKASSAR

    </h1>

    <img class="header-shipping" src="{{ public_path('/') }}./assets/images/shipping.png" alt="">


    <table class="left-si" width="100%">
      <tr valign="top">
        <td width="10%">
          Shipper
        </td>
        <td width="2%">:</td>
        <td width="">{{ $shipper }}</td>

        <td width="10%"></td>

        <td width="10%">
          Consigne
        </td>
        <td width="2%">:</td>
        <td width="">{{ $consigne }}</td>
      </tr>

      <tr valign="top">
        <td>
          Pelayaran
        </td>
        <td width="2%">:</td>
        <td>{{ $load->select_company }}</td>

        <td width="10%"></td>

        <td>
          KM/Voy
        </td>
        <td width="2%">:</td>
        <td>{{ $load->vessel }}</td>
      </tr>
      <tr valign="top">
        <td>
          POL
        </td>
        <td width="2%">:</td>
        <td>{{ $load->pol }}</td>

        <td width="10%"></td>

        <td>
          POD
        </td>
        <td width="2%">:</td>
        <td>{{ $pod_container }}</td>


      </tr>





    </table>
  </header>

  <footer style="width: 100%">

    <div class="footer-1">
      Perumahan Green River View Vinca Residence Barombong <br>
      <link style="color: blue"><u style="color: blue">aislogisticmakassar@gmail.com </u>
      <link>
    </div>
  </footer>


  <main>
    <div class="tabel_container">
      <table class="table_si" width="100%">
        <thead>
          <tr>
            <th width="3%">NO</th>
            <th>KONTAINER</th>
            <th>SIZE/TYPE</th>
            <th>SEAL</th>
            <th width="40%">COMMIDITY</th>

          </tr>
        </thead>

        <tbody>
          @foreach ($containers as $container)
            <tr>
              <td align="center">{{ $loop->iteration }}.</td>

              <td align="center" valign="top">{{ $container['nomor_kontainer'] }}</td>
              <td align="center" valign="top">{{ $container['size'] }}/{{ $container['type'] }}</td>
              <td align="center" valign="top">
                @foreach ($container['seal'] as $seal)
                  @if ($loop->iteration < count($container['seal']))
                    {{ $seal->seal_kontainer }}, &ensp;
                  @else
                    {{ $seal->seal_kontainer }}
                  @endif
                @endforeach
              </td>
              <td align="center" valign="top">{{ $container['cargo'] }}</td>

            </tr>
          @endforeach
        </tbody>

        <tfoot>
          <tr>
            <td colspan="4" align="right" valign="top">TOTAL (Jumlah x Size/Type)</td>
            <td align="left" valign="top" class="td_top">
              <ol type="A">
                @foreach ($quantity as $quantities)
                  <li>
                    {{ $quantities }}
                  </li>
                @endforeach
              </ol>
            </td>
          </tr>

      
        </tfoot>



      </table>
    </div>




  </main>


</body>

</html>
