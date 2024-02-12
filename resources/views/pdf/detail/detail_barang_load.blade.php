<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Detail Barang</title>

  <link href="{{ public_path('/') }}./assets/css-surat/detail_barang.css" rel="stylesheet" />

</head>

<body>
  <header>

    <img class="header-invoice3" src="{{ public_path('/') }}./assets/images/icon.png" alt="">


    <h1 class="title1">
      PT. AIS LOGISTIK MAKASSAR

    </h1>




    <img class="header-invoice2" src="{{ public_path('/') }}./assets/images/packing.png" alt="">


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

  <footer style="width: 100%">
    {{-- <div class="footer-2" style="float: right; padding-right:80px">
      Paraf________________
    </div> --}}
    <div class="footer-1">
      Perumahan Green River View Vinca Residence Barombong <br> 
      <link style="color: blue"><u style="color: blue">aislogisticmakassar@gmail.com </u>
      <link>
    </div>
  </footer>


  <main>

    <div class="tabel_container">
      <table class="bank" width="100%">
        <thead>
          <tr>
            <th width="3%">NO</th>
            <th>PENGIRIM</th>
            <th>SIZE/TYPE</th>
            <th>KONTAINER</th>
            <th>POD</th>
            <th width="40%">Deskripsi</th>
    
          </tr>
        </thead>
    
        <tbody>
          @foreach ($containers as $container)
            <tr>
              <td align="center">{{ $loop->iteration }}.</td>
              <td>{{ $container['pengirim'] }}</td>
              <td>{{ $container['size'] }}/{{ $container['type'] }}</td>
              <td>{{ $container['nomor_kontainer'] }}</td>
              <td>{{ $container['pod_container'] }}</td>
              <td class="td_top">
                <ol type="1.">
                  @foreach ($details as $detail)
                    @if ($detail->kontainer_id == $container['id'])
                      <li>
                        {{ $detail->detail_barang }}
                      </li>
                    @endif
                  @endforeach
                </ol>
              </td>
    
            </tr>
          @endforeach
        </tbody>
    
    
    
      </table>
    </div>
  </main>
  

  
 
 
  {{-- <main>









    <div class="page-break"></div>



    <table class="bank" width="100%" style="margin-top: 50px !important">
      <thead>
        <tr>
          <th colspan="5">COMMENT :</th>
        </tr>

      </thead>

      <tbody>

        @foreach ($containers as $rekening)
          <tr>
            <td align="center" width="5%">{{ $loop->iteration }}</td>
            <td colspan="4"></td>
          </tr>
        @endforeach


      </tbody>
    </table>
  </main> --}}

  





</body>

</html>
