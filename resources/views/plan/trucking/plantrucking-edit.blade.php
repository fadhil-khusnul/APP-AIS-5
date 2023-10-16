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
                        {{-- <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}"> --}}
                        <div class="breadcrumb breadcrumb-transparent mb-0">
                            <a href="/truckingplan" class="breadcrumb-item text-primary">
                                <div class="breadcrumb-icon">
                                    <i class="fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text">Activity</span>
                            </a>
                            <a href="/truckingplan" class="breadcrumb-item text-primary">
                                <span class="breadcrumb-text">Trucking</span>
                            </a>
                            <a href="/truckingplan" class="breadcrumb-item text-warning">
                                <span class="breadcrumb-text">Plan</span>
                            </a>

                        </div>
                        <!-- END Breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
        <form class="row row-cols-lg-12 g-3" id="valid_planload" name="valid_planload">
            <div class=" col-md-4">
                <div class="portlet">

                    <div class="portlet-body row">
                        <!-- BEGIN Form -->

                        <div class=" row mb-3">

                            <label for="inputAddress2" class="col-sm-4 col-form-label">Vessel/Voyage</label>
                            <div class="col-sm-8 validation-container">
                                <input name="vessel" id="vessel" class="form-control" value="{{ old("vessel", $planload->vessel) }}">
                            </div>
                        </div>
                        <div class=" row mb-3">

                            <label for="inputAddress2" class="col-sm-4 col-form-label">Vessel Code</label>
                            <div class="col-sm-8 validation-container">
                                <input name="vessel_code" id="vessel_code" class="form-control" value="{{ old("vessel_code", $planload->vessel_code) }}">
                            </div>
                        </div>

                        <div class=" row mb-3">

                            <label for="company" class="col-sm-4 col-form-label">Shipping Company</label>
                            <div class="col-sm-8 validation-container">
                                <select id="select_company" name="select_company" class="form-select">
                                    <option selected disabled>Pilih Company</option>
                                    @foreach ($shippingcompany as $shippingcompany)
                                        <option value="{{ $shippingcompany->nama_company }}"
                                            @if ($shippingcompany->nama_company == $planload->select_company) selected @endif>
                                            {{ $shippingcompany->nama_company }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" row mb-3">

                            <label for="POL" class="col-sm-4 col-form-label">Pengirim</label>
                            <div class="col-sm-8 validation-container">
                                <select id="Pengirim_1" name="Pengirim_1" class="form-select">
                                    <option selected disabled value="0">Pilih Pengirim</option>
                                    @foreach ($pengirim as $pengirim)
                                    <option value="{{ $pengirim->nama_costumer }}"
                                        @if ($pengirim->nama_costumer == $planload->pengirim) selected @endif>{{ $pengirim->nama_costumer }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class=" row mb-3">

                            <label for="POL" class="col-sm-4 col-form-label">Penerima</label>
                            <div class="col-sm-8 validation-container">
                                <select id="penerima_1" name="penerima_1" class="form-select">
                                    <option selected disabled value="0">Pilih Penerima</option>
                                    @foreach ($penerima as $penerima)
                                        <option value="{{ $penerima->nama_penerima }}"
                                            @if ($penerima->nama_penerima == $planload->penerima) selected @endif>
                                            {{ $penerima->nama_penerima }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Activity</label>
                            <div class="col-sm-8 validation-container">
                                <select id="activity" name="activity" class="form-select">
                                    <option selected disabled value="0">Pilih Activity</option>
                                    @foreach ($activities as $activity)
                                        <option value="{{ $activity->kegiatan }}"
                                            @if ($activity->kegiatan == $planload->activity) selected @endif>{{ $activity->kegiatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" row mb-3">
                            <label for="inputAddress2" class="col-sm-4 col-form-label">EMKL :</label>
                            <div class="col-sm-8 validation-container">
                                <input name="emkl" id="emkl" value="{{ old("emkl", $planload->emkl) }}" class="form-control align-center">
                            </div>
                        </div>



                    </div>

                    <div class="col-12 text-center">

                        <div class="form-check">
                            <input class="form-check-input float-none" type="checkbox" id="check"
                                name="check">
                            <label class="form-check-label" for="agreement">Checklis Jika Ada yang ingin
                                diubah</label>
                        </div>
                        
                    </div>

                    <div class="col-12 text-center mb-2">

                        <button disabled type="submit" id="submit" onclick="CreateTrucking()"
                            class="btn btn-success">Simpan <i class="fa fa-save"></i></button>
                    </div>


                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
            <div class="col-md-8 ">
                <div class="portlet">

                    <div class="portlet-body">
                        {{-- <form action="#" class="row g-3" id="valid_planload" name="valid_planload"></form> --}}

                        <!-- BEGIN Form -->
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Detail Kontainer :</b></label>
                        </div>

                        <table class="table mb-0" id="table_container">
                            <thead class="table-warning" id="thead_container">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center"></th>
                                    <th class="text-center">Order Dari</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Activity</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="tbody_container">

                                @foreach ($containers as $container)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <button id="deleterow{{ $loop->iteration }}" value="{{ $container->id }}"
                                            onclick="delete_kontainerDB(this)" type="button"
                                            class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                                class="fa fa-trash"></i></button>
                                        <button id="editrow{{ $loop->iteration }}" value="{{ $container->id }}"
                                            onclick="modal_edit(this)" type="button"
                                            class="btn btn-label-primary btn-icon btn-circle btn-sm"><i
                                                class="fa fa-pencil"></i></button>
                                    </td>

                                    <td>{{ $container->order_dari }}</td>
                                    <td>{{ $container->size }}</td>
                                    <td>{{ $container->type }}</td>
                                    <td>{{ $container->activity }}</td>
                                  
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="mt-5 mb-5 text-center">
                            <button id="add_container" onclick="modal_tambah()" type="button"
                                class="btn btn-success btn-icon"><i class="fa fa-plus"></i></button>

                            @if (count($containers) > 1)
                            <button style="margin-left: 10px" value="{{ $planload->slug }}" type="button"
                                onclick="process_page(this)" class="btn btn-success">ke Process <i
                                    class="fa fa-arrow-right"></i></button>
                            @endif
                        </div>



                        
                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
        </form>


    </div>

    <div class="modal fade" id="modal_tambah" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <form action="#" class="modal-dialog-scrollable" name="valid_job_tambah" id="valid_job_tambah">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="job_id" id="job_id" value="{{ $planload->id }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">TAMBAH KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Order Dari:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input data-bs-toggle="tooltip" type="text" class="form-control"
                                    id="order_dari_tambah" name="order_dari_tambah"
                                    required placeholder="(Nama Pemberi Orderan)">
                            </div>
                        </div>

                        <div class="row">

                            <label class="col-sm-4 col-form-label">Size :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="size_tambah" name="size_tambah" class="form-select"
                                    @readonly(true)>
                                    <option selected disabled>Pilih Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}">
                                            {{ $size->size_container }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Type :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="type_tambah" name="type_tambah" class="form-select"
                                    @readonly(true) required>
                                    <option selected disabled>Pilih Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}">
                                            {{ $type->type_container }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Activity :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select id="activity_tambah" name="activity_tambah" class="form-select">
                                    <option selected disabled value="0">Pilih Activity</option>
                                    @foreach ($activities as $activity)
                                        <option value="{{ $activity->kegiatan}}">{{ $activity->kegiatan }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                    
            



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>



    <div class="modal fade" id="modal_edit" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <form action="#" class="modal-dialog-scrollable" name="valid_job_edit" id="valid_job_edit">
                <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                <input type="hidden" name="new_id_edit" id="new_id_edit" >

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDIT KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Order Dari:<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input data-bs-toggle="tooltip" type="text" class="form-control"
                                    id="order_dari_edit" name="order_dari_edit"
                                    required placeholder="(Nama Pemberi Orderan)">
                            </div>
                        </div>

                        <div class="row">

                            <label class="col-sm-4 col-form-label">Size :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="size_edit" name="size_edit" class="form-select"
                                    @readonly(true)>
                                    <option selected disabled>Pilih Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size_container }}">
                                            {{ $size->size_container }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Type :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="type_edit" name="type_edit" class="form-select"
                                    @readonly(true) required>
                                    <option selected disabled>Pilih Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type_container }}">
                                            {{ $type->type_container }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="row">

                            <label for="" class="col-sm-4 col-form-label">Activity :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select id="activity_edit" name="activity_edit" class="form-select">
                                    <option selected disabled value="0">Pilih Activity</option>
                                    @foreach ($activities as $activity)
                                        <option value="{{ $activity->kegiatan}}">{{ $activity->kegiatan }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                    
            



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>



    
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            let tanggal_tiba = $("#tanggal_tiba").val();
            tanggal_tiba = moment(tanggal_tiba, "YYYY-MM-DD").format("dddd, DD-MMMM-YYYY")
            $("#tanggal_tiba").val(tanggal_tiba);

            let total_hari = $("#total_hari").val();
            total_hari = moment(total_hari, "YYYY-MM-DD").format("dddd, DD-MMMM-YYYY")
            $("#total_hari").val(total_hari);

            var checkboxes = $("#check"),
                submitButt = $("#submit");

            checkboxes.click(function() {
                submitButt.attr("disabled", !checkboxes.is(":checked"));
            });



        });

        $('.modal>.modal-dialog').draggable({
            cursor: 'move',
            handle: '.modal-header, .modal-footer'
        });
        $('.modal>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');
        $('.modal>.modal-dialog>.modal-content>.modal-footer').css('cursor', 'move');
    </script>

    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>

    <script type="text/javascript" src="{{ asset('/') }}./js/trucking-plan.js"></script>
@endsection
