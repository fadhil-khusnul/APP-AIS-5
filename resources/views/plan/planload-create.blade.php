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
                                <option>...</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="company" class="form-label">Shipping Company</label>
                            <select id="select2-1">
                                <option value="AK" selected disabled>Pilih Company</option>
                                <option value="HI">Hawaii</option>
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress2" class="form-label">Vessel/Voyage</label>
                            <textarea name="" id="" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">POL</label>
                            <select id="POL-1">
                                <option value="AK" selected disabled>Pilih POL</option>
                                <option value="HI">Hawaii</option>
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">POT</label>
                            <select id="POT-1">
                                <option value="AK" selected disabled>Pilih POT</option>
                                <option value="HI">Hawaii</option>
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">POD</label>
                            <select id="POD-1">
                                <option value="AK" selected disabled>Pilih POD</option>
                                <option value="HI">Hawaii</option>
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">Pengirim</label>
                            <select id="Pengirim-1">
                                <option value="AK" selected disabled>Pilih Pengirim</option>
                                <option value="HI">Hawaii</option>
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="POL" class="form-label">Penerima</label>
                            <select id="Penerima-1">
                                <option value="AK" selected disabled>Pilih Penerima</option>
                                <option value="HI">Hawaii</option>
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
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
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="tbody_container">
                                <tr>
                                    <td>1.</td>
                                    <td><select id="size1" class="form-select">
                                            <option selected disabled>Pilih Size</option>
                                            <option>...</option>
                                        </select></td>
                                    <td><select id="type1" class="form-select">
                                            <option selected disabled>Pilih Type</option>
                                            <option>...</option>
                                        </select></td>
                                    <td><button id="deleterow1" onclick="delete_container(this)" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
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
            var table = document.getElementById("tbody_container");
            tambah++;

            var select1 = document.createElement("select");
            select1.innerHTML = '<option selected disabled>Pilih Size</option><option>...</option>';
            select1.setAttribute("id", "size" + tambah);
            select1.setAttribute("class", "form-select");
            var select2 = document.createElement("select");
            select2.innerHTML = '<option selected disabled>Pilih Type</option><option>...</option>';
            select2.setAttribute("id", "type" + tambah);
            select2.setAttribute("class", "form-select");
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

            cell1.innerHTML = "1.";
            cell2.appendChild(select1);
            cell3.appendChild(select2);
            cell4.appendChild(button);

            reindex_container();
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
                select1[i].id = "size" + (i + 1);
            }

            var select2 = document.querySelectorAll("#table_container tr td:nth-child(3) select");
            for (var i = 0; i < select2.length; i++) {
                select2[i].id = "type" + (i + 1);
            }

            var button = document.querySelectorAll("#table_container tr td:nth-child(4) button");
            for (var i = 0; i < button.length; i++) {
                button[i].id = "deleterow" + (i + 1);
            }

            reindex_container();

            if (tambah == 0) {
                tambah_kontener();
            }
        }
    </script>
@endsection
