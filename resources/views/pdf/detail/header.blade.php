<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Detail Barang</title>

  <link href="{{ asset('assets/css-surat/detail_barang.css') }}" rel="stylesheet" />
</head>

<body>
  <header>

    <img class="header-invoice3" src="{{ asset('assets/images/icon.png') }}" alt="">


    <h1 class="title1">
      PT. AIS LOGISTIK MAKASSAR

    </h1>




    <img class="header-invoice2" src="{{ asset('assets/images/packing.png') }}" alt="">

    <table class="left" width="100%">
      <tr valign="top">
        <td width="">
          Activity
        </td>
        <td width="2%">:</td>
        <td width="">{{ $load->activity }}</td>

        <td width="10%"></td>

        <td width="">
          POL
        </td>
        <td width="2%">:</td>
        <td width="">{{ $load->pol }}</td>
      </tr>

      <tr valign="top">
        <td>
          Date
        </td>
        <td width="2%">:</td>
        <td>{{ \Carbon\Carbon::parse($load->date_activity)->isoFormat('dddd, DD MMMM YYYY') }}</td>
        <td width="10%"></td>

        <td>
          Pelayaran
        </td>
        <td width="2%">:</td>
        <td>{{ $load->select_company }}</td>
      </tr>
      <tr valign="top">
        <td>
          Vessel/Voy
        </td>
        <td width="2%">:</td>
        <td>{{ $load->vessel }}</td>

        <td width="10%"></td>


      </tr>





    </table>

  </header>

</body>

</html>
