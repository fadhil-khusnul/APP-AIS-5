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
                        <input type="hidden" name="old_slug" id="old_slug" value="{{$planload->slug}}">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">

                        <div class="breadcrumb breadcrumb-transparent mb-0">
                            <a href="/plandischarge" class="breadcrumb-item text-primary">
                                <div class="breadcrumb-icon">
                                    <i class="fa fa-clone"></i>
                                </div>
                                <span class="breadcrumb-text">Activity</span>
                            </a>
                            <a href="/plandischarge" class="breadcrumb-item text-primary">
                                <span class="breadcrumb-text">Discharge</span>
                            </a>
                            <a href="/plandischarge" class="breadcrumb-item text-warning">
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
                        <div class="row mb-3">

                            <label for="inputAddress2" class="col-sm-4 form-label">Nomor DO</label>
                            <div class="col-md-8 validation-container">
                                <input required name="nomor_do" id="nomor_do" class="form-control" value="{{old('nomor_do', $planload->nomor_do)}}">
                            </div>
                        </div>

                            <div class="row mb-3">
                                <label for="inputAddress2" class="col-sm-4 form-label">Tanggal Tiba Kapal</label>
                                <div class="col-sm-8 validation-container">
                                        <input required name="tanggal_tiba" id="tanggal_tiba" class="form-control" value="{{old('tanggal_tiba', $planload->tanggal_tiba)}}">
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label for="inputAddress2" class="col-sm-4 form-label">Vessel/Voyage</label>
                                <div class="col-sm-8 validation-container">
                                    <input required name="vessel" id="vessel" class="form-control" value="{{ old('vessel', $planload->vessel) }}" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputAddress2" class="col-sm-4 form-label">Vessel Code</label>
                                <div class="col-sm-8 validation-container">
                                    <input required name="vessel_code" id="vessel_code" class="form-control" value="{{ old('vessel_code', $planload->vessel_code) }}" >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="company" class="col-sm-4 form-label">Shipping Company</label>
                                <div class="col-sm-8 validation-container">
                                    <select required id="select_company" name="select_company" class="form-select">
                                        <option selected disabled>Pilih Company</option>
                                        @foreach ($shippingcompany as $shippingcompany)
                                            <option value="{{ $shippingcompany->nama_company }}" @if ($shippingcompany->nama_company == $planload->select_company) selected @endif>{{ $shippingcompany->nama_company }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label for="POL" class="col-sm-4 form-label">Pengirim</label>
                                <div class="col-sm-8 validation-container">
                                    <select required id="Pengirim_1" name="Pengirim_1" class="form-select">
                                        <option selected disabled>Pilih Pengirim</option>
                                        @foreach ($pengirim as $pengirim)
                                            <option value="{{ $pengirim->nama_costumer }}" @if ($pengirim->nama_costumer == $planload->pengirim) selected @endif>{{ $pengirim->nama_costumer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="POL" class="col-sm-4 form-label">Penerima</label>
                                <div class="col-sm-8 validation-container">
                                    <select required id="Penerima_1" name="Penerima_1" class="form-select">
                                        <option selected disabled>Pilih Penerima</option>
                                        @foreach ($penerima as $penerima)
                                            <option value="{{ $penerima->nama_penerima }}" @if ($penerima->nama_penerima == $planload->penerima) selected @endif>{{ $penerima->nama_penerima }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-4 form-label">Activity</label>
                                <div class="col-sm-8 validation-container">
                                    <select required id="activity" name="activity" class="form-select">
                                        <option selected disabled>Pilih Activity</option>
                                        @foreach ($activity as $activity)
                                            <option value="{{ $activity->kegiatan }}" @if ($activity->kegiatan == $planload->activity) selected @endif>{{ $activity->kegiatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="POL" class="col-sm-4 form-label">POL</label>
                                <div class="col-sm-8 validation-container">
                                    <select required id="POL_1" name="POL_1" class="form-select">
                                        <option selected disabled>Pilih POL</option>
                                        @foreach ($pol as $pol)
                                            <option value="{{ $pol->nama_pelabuhan }}" @if ($pol->nama_pelabuhan == $planload->pol) selected @endif>{{ $pol->area_code }} - {{ $pol->nama_pelabuhan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="POL" class="col-sm-4 form-label">POD</label>
                                <div class="col-sm-8 validation-container">
                                    <select required id="POD_1" name="POD_1" class="form-select">
                                        <option selected disabled>Pilih POD</option>
                                        @foreach ($pod as $pod)
                                            <option value="{{ $pod->nama_pelabuhan }}" @if ($pod->nama_pelabuhan == $planload->pod) selected @endif>{{ $pod->area_code }} -
                                                {{ $pod->nama_pelabuhan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <!-- BEGIN Form Check -->
                                <div class="form-check">
                                    <input class="form-check-input float-none" type="checkbox" id="check" name="check">
                                    <label class="form-check-label" for="agreement">Checklis Jika Ada yang ingin diubah</label>
                                </div>
                                <!-- END Form Check -->
                            </div>

                            <div class="col-12 text-center">
                                {{-- <button onclick="CreateJobPlanload()" class="btn btn-primary">Proccess</button> --}}
                                <button disabled type="submit" id="submit"  onclick="UpdateteJobPlanDischarge()"
                                    class="btn btn-success">Simpan <i class="fa fa-save"></i></button>
                            </div>



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


                        <div class="col-md-12 text-center">
                            <label for="inputState" class="form-label"><b>Detail Kontainer :</b></label>
                        </div>

                        <table class="table mb-0" id="table_container">
                            <thead class="table-warning" id="thead_container">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Aksi</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Nomor Kontainer</th>
                                    <th class="text-center">Seal Kontainer</th>
                                    <th class="text-center">Nama Barang (CARGO)</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="tbody_container">
                                @foreach ($containers as $container)

                                <tr>
                                    <td>{{$loop->iteration}}</td>

                                    <td>
                                    <button id="deleterow{{$loop->iteration}}" value="{{ $container->id }}" onclick="delete_container(this)" type="button"
                                        class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                            class="fa fa-trash"></i></button>
                                    <button id="editrow{{$loop->iteration}}" value="{{ $container->id }}" onclick="modal_edit(this)" type="button"
                                        class="btn btn-label-primary btn-icon btn-circle btn-sm"><i
                                            class="fa fa-pencil"></i></button>
                                    </td>

                                    <td>{{$container->size}}</td>
                                    <td>{{$container->type}}</td>
                                    <td>{{$container->nomor_kontainer}}</td>
                                    <td>
                                        @if ($sealsc->count() == 1)
                                            @foreach ($sealsc as $seal)
                                            @if ($seal->kontainer_id_discharge == $container->id)
                                                    {{ $seal->seal_kontainer }}

                                            @endif
                                            @endforeach
                                        @else
                                        <ol type="1.">

                                            @foreach ($sealsc as $seal)
                                                @if ($seal->kontainer_id_discharge == $container->id)
                                                    <li id="seal[{{ $container->id }}]">
                                                        {{ $seal->seal_kontainer }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ol>
                                        @endif
                                    </td>
                                    <td>{{$container->cargo}}</td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-5 mb-5 text-center">
                            <button id="add_container" onclick="modal_tambah()" type="button"
                                class="btn btn-label-success">Tambah Kontainer <i class="fa fa-plus"></i></button>
                            @if (count($containers) > 1)
                            <button style="margin-left: 10px" value="{{ $planload->slug }}" type="button" onclick="process_page(this)"
                            class="btn btn-success">ke Process <i class="fa fa-arrow-right"></i></button>
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

                            <label for="" class="col-sm-4 col-form-label">Type :<span class="text-danger">*</span></label>
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
                            <label for="" class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input data-bs-toggle="tooltip" type="text" class="form-control nomor_kontainer"
                                    id="nomor_kontainer_tambah" minlength="11" name="nomor_kontainer_tambah"
                                    onblur="blur_no_container(this)" required placeholder="XXXX0000000"
                                 >
                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Barang (Cargo) :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="cargo_tambah"
                                    name="cargo_tambah" required>
                            </div>


                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Seal-Container :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="seal_tambah" multiple="multiple" name="seal_tambah"
                                    class="form-select seals" placeholde="Silahkan Pilih Seal" required>
                                    @foreach ($seals as $seal)
                                        <option value="{{ $seal->kode_seal }}">
                                            {{ $seal->kode_seal }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Seal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_seal_tambah" name="biaya_seal_tambah" placeholder="Biaya Seal..."
                                        required>

                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah Kontainer</button>
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
                <input type="hidden" name="new_id_edit" id="new_id_edit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDIT KONTAINER</h5>
                        <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body d-grid gap-3 px-5">
                   
                      
                        <div class="row">

                            <label class="col-sm-4 col-form-label">Size :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select required data-bs-toggle="tooltip" id="size_edit" name="size_edit" class="form-select"
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

                            <label for="" class="col-sm-4 col-form-label">Type :<span class="text-danger">*</span></label>
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
                            <label for="" class="col-sm-4 col-form-label">Nomor Kontainer :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <input data-bs-toggle="tooltip" type="text" class="form-control nomor_kontainer"
                                    id="nomor_kontainer_edit" minlength="11" name="nomor_kontainer_edit"
                                    onblur="blur_no_container(this)" required placeholder="XXXX0000000"
                                 >
                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Barang (Cargo) :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <input data-bs-toggle="tooltip" type="text" class="form-control" id="cargo_edit"
                                    name="cargo_edit" required>
                            </div>


                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Seal-Container :<span class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">

                                <select data-bs-toggle="tooltip" id="seal_edit" multiple="multiple" name="seal_edit"
                                    class="form-select seals" placeholde="Silahkan Pilih Seal" required>
                                    @foreach ($seals_edit as $seal)
                                        <option value="{{ $seal->kode_seal }}">
                                            {{ $seal->kode_seal }}</option>
                                    @endforeach
                                </select>
                               

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="">Biaya Seal :<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8 validation-container">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" for="">Rp.</span>

                                    <input data-bs-toggle="tooltip"
                                        type="text" class="form-control currency-rupiah"
                                        id="biaya_seal_edit" name="biaya_seal_edit" placeholder="Biaya Seal..."
                                        required>

                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit Kontainer</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            let tanggal_tiba = $("#tanggal_tiba").val();
            tanggal_tiba = moment(tanggal_tiba, "YYYY-MM-DD").format("dddd, DD-MMMM-YYYY")
            $("#tanggal_tiba").val(tanggal_tiba);

            var checkboxes = $("#check"),
                submitButt = $("#submit");

            checkboxes.click(function() {
                submitButt.attr("disabled", !checkboxes.is(":checked"));
            });
            


        });


    </script>
    <script type="text/javascript" src="{{ asset('/') }}./js/discharge-plan.js"></script>
@endsection
