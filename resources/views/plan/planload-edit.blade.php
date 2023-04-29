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
        <form class="row row-cols-lg-12 g-3" id="valid_planload" name="valid_planload">
            <div class=" col-md-6">
                <div class="portlet">

                    <div class="portlet-body row">
                        <!-- BEGIN Form -->

                            <div class="col-md-6 validation-container">
                                <label for="" class="form-label">Date</label>
                                <input type="text" class="form-control" placeholder="Select date" id="tanggal_planload"
                                    name="tanggal_planload" value="{{ old('tanggal_planload', $planload->tanggal_planload) }}">
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="" class="form-label">Activity</label>
                                <select id="activity" name="activity" class="form-select">
                                    <option selected disabled>Pilih Activity</option>
                                    @foreach ($activity as $activity)
                                        <option value="{{ $activity->kegiatan_stuffing }}" @if ($activity->kegiatan_stuffing == $planload->activity) selected @endif>{{ $activity->kegiatan_stuffing }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 validation-container">
                                <label for="company" class="form-label">Shipping Company</label>
                                <select id="select_company" name="select_company" class="form-select">
                                    <option selected disabled>Pilih Company</option>
                                    @foreach ($shippingcompany as $shippingcompany)
                                        <option value="{{ $shippingcompany->nama_company }}" @if ($shippingcompany->nama_company == $planload->select_company) selected @endif>{{ $shippingcompany->nama_company }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="inputAddress2" class="form-label">Vessel/Voyage</label>
                                <textarea name="vessel" id="vessel" class="form-control" >{{ old('vessel', $planload->vessel) }}</textarea>
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="POL" class="form-label">POL</label>
                                <select id="POL_1" name="POL_1" class="form-select">
                                    <option selected disabled>Pilih POL</option>
                                    @foreach ($pol as $pol)
                                        <option value="{{ $pol->nama_pelabuhan }}" @if ($pol->nama_pelabuhan == $planload->pol) selected @endif>{{ $pol->area_code }} - {{ $pol->nama_pelabuhan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="POL" class="form-label">POT</label>
                                <select id="POT_1" name="POT_1" class="form-select">
                                    <option selected disabled>Pilih POT</option>
                                    @foreach ($pot as $pot)
                                        <option value="{{ $pot->nama_pelabuhan }}" @if ($pot->nama_pelabuhan == $planload->pot) selected @endif>{{ $pot->area_code }} - {{ $pot->nama_pelabuhan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="POL" class="form-label">POD</label>
                                <select id="POD_1" name="POD_1" class="form-select">
                                    <option selected disabled>Pilih POD</option>
                                    @foreach ($pod as $pod)
                                        <option value="{{ $pod->nama_pelabuhan }}" @if ($pod->nama_pelabuhan == $planload->pod) selected @endif>{{ $pod->area_code }} -
                                            {{ $pod->nama_pelabuhan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="POL" class="form-label">Pengirim</label>
                                <select id="Pengirim_1" name="Pengirim_1" class="form-select">
                                    <option selected disabled>Pilih Pengirim</option>
                                    @foreach ($pengirim as $pengirim)
                                        <option value="{{ $pengirim->nama_costumer }}" @if ($pengirim->nama_costumer == $planload->pengirim) selected @endif>{{ $pengirim->nama_costumer }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 validation-container">
                                <label for="POL" class="form-label">Penerima</label>
                                <select id="Penerima_1" name="Penerima_1" class="form-select">
                                    <option selected disabled>Pilih Penerima</option>
                                    @foreach ($penerima as $penerima)
                                        <option value="{{ $penerima->nama_penerima }}" @if ($penerima->nama_penerima == $planload->penerima) selected @endif>{{ $penerima->nama_penerima }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <!-- END Form -->

                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
            <div class="col-md-6 ">
                <div class="portlet">

                    <div class="portlet-body">
                        {{-- <form action="#" class="row g-3" id="valid_planload" name="valid_planload"></form> --}}

                        <!-- BEGIN Form -->


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
                                @foreach ($containers as $container)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <div class="validation-container">
                                            <select id="kontainer[{{$loop->iteration}}]" name="kontainer" class="form-select"
                                                onchange="change_container(this)" required>
                                                <option selected disabled>Pilih Kontainer</option>
                                                @foreach ($kontainers as $kontainer)
                                                    <option value="{{$kontainer->id}}" @if ($kontainer->id == $container->kontainer) selected @endif>
                                                        {{ $kontainer->jenis_container }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <label id="size[{{$loop->iteration}}]">{{ old('size', $container->size) }}</label>
                                    </td>
                                    <td>
                                        <label id="type[{{$loop->iteration}}]">{{ old('type', $container->type) }}</label>
                                    </td>
                                    <td><button id="deleterow{{$loop->iteration}}" onclick="delete_container(this)" type="button"
                                            class="btn btn-label-danger btn-icon btn-circle btn-sm"><i
                                                class="fa fa-trash"></i></button></td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-5 mb-5">
                            <button id="add_container" onclick="edit_kontener()" type="button"
                                class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></button>
                        </div>

                        <div class="col-12 mb-5 validation-container">
                            <label for="inputAddress2" class="form-label">Nama Barang :</label>
                            <textarea name="nama_barang" id="nama_barang" class="form-control">{{ old('nama_barang', $planload->nama_barang) }}</textarea>
                        </div>

                        <div class="col-12 text-end">
                            {{-- <button onclick="CreateJobPlanload()" class="btn btn-primary">Proccess</button> --}}
                            <button type="submit" onclick="UpdateteJobPlanload()"
                                class="btn btn-primary">Proccess</button>
                        </div>
                        <!-- END Form -->
                    </div>
                </div>
                <!-- BEGIN Portlet -->

                <!-- END Portlet -->
            </div>
        </form>


    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/planload.js"></script>
@endsection
