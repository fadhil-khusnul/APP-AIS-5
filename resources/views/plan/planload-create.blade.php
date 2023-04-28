@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- BEGIN Portlet -->
            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="header-title">Activity</h3>
                    <i class="header-divider"></i>
                    <div class="header-wrap header-wrap-block justify-content-start">
                        <!-- BEGIN Breadcrumb -->
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="breadcrumb breadcrumb-transparent mb-0">
                            <a href="/planload" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text">Activity</span>
                            </a>
                            <a href="/planload" class="breadcrumb-item">
                                <span class="breadcrumb-text">Job Order Plan</span>
                            </a>
                            <a href="/planload" class="breadcrumb-item">
                                <span class="breadcrumb-text">Load</span>
                            </a>

                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="portlet">

                <div class="portlet-body">

                    <!-- BEGIN Form -->
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="" class="form-label">Date</label>
                            <input type="text" class="form-control" placeholder="Select date" id="datepicker-3">
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Activity</label>
                            <select id="activity" class="form-select">
                                <option selected disabled>Pilih Activity</option>
                                @foreach ($activity as $activity)
                                    <option value="{{ $activity->id }}">{{ $activity->kegiatan_stuffing }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="company" class="form-label">Shipping Company</label>
                            <select id="select2-1">
                                <option selected disabled>Pilih Company</option>
                                @foreach ($shippingcompany as $shippingcompany)
                                    <option value="{{ $shippingcompany->id }}">{{ $shippingcompany->nama_company }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress2" class="form-label">Vessel/Voyage</label>
                            <textarea name="" id="" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">POL</label>
                            <select id="POL-1">
                                <option selected disabled>Pilih POL</option>
                                @foreach ($pol as $pol)
                                    <option value="{{ $pol->id }}">{{ $pol->area_code }} - {{ $pol->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">POT</label>
                            <select id="POT-1">
                                <option selected disabled>Pilih POT</option>
                                @foreach ($pot as $pot)
                                    <option value="{{ $pot->id }}">{{ $pot->area_code }} - {{ $pot->nama_pelabuhan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">POD</label>
                            <select id="POD-1">
                                <option selected disabled>Pilih POD</option>
                                @foreach ($pod as $pod)
                                    <option value="{{ $pod->id }}">{{ $pod->area_code }} -
                                        {{ $pod->nama_pelabuhan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">Pengirim</label>
                            <select id="Pengirim-1">
                                <option selected disabled>Pilih Pengirim</option>
                                @foreach ($pengirim as $pengirim)
                                    <option value="{{ $pengirim->id }}">{{ $pengirim->nama_costumer }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">Penerima</label>
                            <select id="Penerima-1">
                                <option selected disabled>Pilih Penerima</option>
                                @foreach ($penerima as $penerima)
                                    <option value="{{ $penerima->id }}">{{ $penerima->nama_penerima }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <!-- END Form -->
                </div>
            </div>
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>
        <div class="col-md-6">
            <div class="portlet">

                <div class="portlet-body">

                    <!-- BEGIN Form -->
                    <form class="row g-3">

                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Jumlah Kontainer :</b></label>
                        </div>

                        <table class="table mb-0" id="table_container">
                            <thead class="table-success" id="thead_container">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Jenis Kontainer</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="tbody_container">
                                <tr>
                                    <td>1.</td>
                                    <td><select id="kontainer1" class="form-select" onchange="change_container(this)">
                                            <option selected disabled>Pilih Kontainer</option>
                                            @foreach ($kontainer as $kontainer)
                                                <option value="{{ $kontainer->id }}">{{ $kontainer->jenis_container }}</option>
                                            @endforeach
                                        </select></td>
                                    <td>
                                        <label id="size1">Size</label>
                                    </td>
                                    <td>
                                        <label id="type1">Type</label>
                                    </td>
                                    <td><button id="deleterow1" onclick="delete_container(this)" type="button"
                                            class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                                class="fa fa-trash"></i></button></td>

                                </tr>
                            </tbody>
                        </table>
                        <div class="">
                            <button id="add_container" onclick="tambah_kontener()" type="button"
                                class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Proccess</button>
                        </div>
                    </form>
                    <!-- END Form -->
                </div>
            </div>
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>

    <script>
        var tambah = 1;

        function tambah_kontener() {
            let token = $('#csrf').val();

            var table = document.getElementById("tbody_container");
            tambah++;

            $.ajax({
                url: '/getJenisKontainer',
                type: 'post',
                data: {
                    '_token': token
                },
                success: function (response) {
                    var jenis_kontainer = [""];
                    for (i = 0; i < response.length; i++) {
                        jenis_kontainer += ("<option value='" + response[i].id + "'>" + response[i].jenis_container + "</option>");
                    }
                    var select1 = document.createElement("select");
                    select1.innerHTML = '<option selected disabled>Pilih Kontainer</option>' + jenis_kontainer;
                    select1.setAttribute("id", "kontainer" + tambah);
                    select1.setAttribute("class", "form-select");
                    select1.setAttribute("onchange", "change_container(this)");
                    var label1 = document.createElement("label");
                    label1.innerHTML = 'Size';
                    label1.setAttribute("id", "size" + tambah);
                    var label2 = document.createElement("label");
                    label2.innerHTML = 'Type';
                    label2.setAttribute("id", "type" + tambah);
                    var button = document.createElement("button");
                    button.setAttribute("id", "deleterow" + tambah);
                    button.setAttribute("class", "btn btn-label-danger btn-icon btn-circle btn-sm");
                    button.setAttribute("type", "button");
                    button.setAttribute("onclick", "delete_container(this)");
                    var icon = document.createElement("i");
                    icon.setAttribute("class", "fa fa-trash");
                    button.append(icon);
        
                    var row = table.insertRow(-1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
        
                    cell1.innerHTML = "1.";
                    cell2.appendChild(select1);
                    cell3.appendChild(label1);
                    cell4.appendChild(label2);
                    cell5.appendChild(button);
        
                    reindex_container();
                }
            })

        }

        function reindex_container() {
            const ids = document.querySelectorAll("#table_container tr > td:nth-child(1)");
            ids.forEach((e, i) => {
                e.innerHTML = i + 1 + "."
                nomor_tabel_lokasi = i + 1;
            });
        }

        function delete_container(r) {
            var table = r.parentNode.parentNode.rowIndex;
            document.getElementById("table_container").deleteRow(table);
            tambah--;

            var select1 = document.querySelectorAll("#table_container tr td:nth-child(2) select");
            for (var i = 0; i < select1.length; i++) {
                select1[i].id = "kontainer" + (i + 1);
            }

            var label1 = document.querySelectorAll("#table_container tr td:nth-child(3) label");
            for (var i = 0; i < label1.length; i++) {
                label1[i].id = "size" + (i + 1);
            }

            var label2 = document.querySelectorAll("#table_container tr td:nth-child(4) label");
            for (var i = 0; i < label2.length; i++) {
                label2[i].id = "type" + (i + 1);
            }

            var button = document.querySelectorAll("#table_container tr td:nth-child(5) button");
            for (var i = 0; i < button.length; i++) {
                button[i].id = "deleterow" + (i + 1);
            }

            reindex_container();

            if (tambah == 0) {
                tambah_kontener();
            }
        }

        function change_container(ini) {
            let token = $('#csrf').val();
            var urutan = ini.parentNode.parentNode.rowIndex;
            var id_container = ini.value;

            $.ajax({
                url: '/getSizeTypeContainer',
                type: 'post',
                data: {
                    'id_container': id_container,
                    '_token': token
                },
                success: function (response) {
                    document.getElementById('size' + urutan).innerHTML = response[0].size_container
                    document.getElementById('type' + urutan).innerHTML = response[0].type_container
                }
            })
        }
    </script>
@endsection
