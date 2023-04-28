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
                            <a href="/processload" class="breadcrumb-item">
                                <div class="breadcrumb-icon">
                                    <i class="fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text">Activity</span>
                            </a>
                            <a href="/processload" class="breadcrumb-item">
                                <span class="breadcrumb-text">Job Order Process</span>
                            </a>
                            <a href="/processload" class="breadcrumb-item">
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
                            <select @readonly(true) disabled id="select2-1">
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
                            <textarea disabled readonly name="" id="" class="form-control"></textarea>
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

                        <table class="table mb-0">
                            <thead class="table-success">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>1.</td>
                                    <td><select id="activity" class="form-select">
                                            <option selected disabled>Pilih Size</option>
                                            <option>...</option>
                                        </select></td>
                                    <td><select disabled @readonly(true) id="activity" class="form-select">
                                            <option selected disabled>Pilih Type</option>
                                            <option>...</option>
                                        </select></td>
                                    <td><button class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                                class="fa fa-trash"></i></button></td>

                                </tr>

                            </tbody>

                        </table>
                        <div class="">
                            <button class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>





                    </form>
                    <!-- END Form -->
                </div>
            </div>
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>


        <div class="col-12">
            <!-- BEGIN Portlet -->
            <div class="portlet">
                <div class="portlet-header portlet-header-bordered text-center">
                    <h3 class="portlet-title text-center">#JOB ORDER NUMBER (1111)</h3>

                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="portlet">

                <div class="portlet-body">

                    <!-- BEGIN Form -->
                    <form class="row g-3">

                        <div class="col-md-6">
                            <label for="" class="form-label">Seal</label>
                            <select id="activity" class="form-select">
                                <option selected disabled>Pilih Seal</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Date Activity</label>
                            <input type="text" class="form-control" placeholder="Select date" id="datepicker-3">
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Cargo</label>
                            <input class="form-control" id="touch-cargo" type="text" value="55">
                        </div>

                        <div class="col-md-6">
                            <label for="POL" class="form-label">Lokasi Pickup</label>
                            <select id="pickup-lokasi">
                                <option value="AK" selected disabled>Pilih Lokasi</option>
                                <option value="HI">Hawaii</option>
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Driver</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">No. Polisi</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Remark</label>
                            <textarea name="" id="process-remark" class="form-control"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Biaya Stuffing</label>
                            <input class="form-control" id="touch-stuffing" type="text" value="55">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Biaya Trucking</label>
                            <input class="form-control" id="touch-trucking" type="text" value="55">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Pengongkosan Supir</label>
                            <input class="form-control" id="touch-supir" type="text" value="55">
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
                            <label for="inputState" class="form-label"><b>Biaya Lainnya :</b></label>
                        </div>

                        <table id="table_biaya" class="table mb-0">
                            <thead id="thead_biaya" class="table-success">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Pekerjaan</th>
                                    <th class="text-center">Biaya</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_biaya" class="text-center">
                                <tr>
                                    <td>1.</td>
                                    <td><select id="pekerjaan1" class="form-select">
                                            <option selected disabled>Pilih Pekerjaan</option>
                                            <option>...</option>
                                        </select></td>
                                    <td><label id="harga1">Harga</label></td>
                                    <td><button id="deleterow1" onclick="delete_biaya(this)" type="button" class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                                class="fa fa-trash"></i></button></td>

                                </tr>
                            </tbody>
                        </table>
                        <div class="">
                            <button id="add_biaya" type="button" onclick="tambah_biaya()" class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Penerima</label>
                            <select id="penerima-process">
                                <option value="AK" selected disabled>Pilih Penerima</option>
                                <option value="HI">Hawaii</option>
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                            </select>
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

        function tambah_biaya() {
            var table = document.getElementById("tbody_biaya");
            tambah++;

            var select = document.createElement("select");
            select.innerHTML = '<option selected disabled>Pilih pekerjaan</option><option>...</option>';
            select.setAttribute("id", "pekerjaan" + tambah);
            select.setAttribute("class", "form-select");
            var label = document.createElement("label");
            label.innerHTML = 'Harga';
            label.setAttribute("id", "harga" + tambah);
            var button = document.createElement("button");
            button.setAttribute("id", "deleterow" + tambah);
            button.setAttribute("class", "btn btn-label-danger btn-icon btn-circle btn-sm");
            button.setAttribute("type", "button");
            button.setAttribute("onclick", "delete_biaya(this)");
            var icon = document.createElement("i");
            icon.setAttribute("class", "fa fa-trash");
            button.append(icon);

            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);

            cell1.innerHTML = "1.";
            cell2.appendChild(select);
            cell3.appendChild(label);
            cell4.appendChild(button);

            reindex_biaya();
        }

        function reindex_biaya() {
            const ids = document.querySelectorAll("#table_biaya tr > td:nth-child(1)");
            ids.forEach((e, i) => {
                e.innerHTML = i + 1 + "."
                nomor_tabel_lokasi = i + 1;
            });
        }

        function delete_biaya(r) {
            var table = r.parentNode.parentNode.rowIndex;
            document.getElementById("table_biaya").deleteRow(table);
            tambah--;

            var select = document.querySelectorAll("#table_biaya tr td:nth-child(2) select");
            for (var i = 0; i < select.length; i++) {
                select[i].id = "pekerjaan" + (i + 1);
            }

            var label = document.querySelectorAll("#table_biaya tr td:nth-child(3) label");
            for (var i = 0; i < label.length; i++) {
                label[i].id = "harga" + (i + 1);
            }

            var button = document.querySelectorAll("#table_biaya tr td:nth-child(4) button");
            for (var i = 0; i < button.length; i++) {
                button[i].id = "deleterow" + (i + 1);
            }

            reindex_biaya();

            if (tambah == 0) {
                tambah_biaya();
            }
        }
    </script>
@endsection
