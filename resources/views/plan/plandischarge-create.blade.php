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
                        <a href="/plandischarge" class="breadcrumb-item">
                            <div class="breadcrumb-icon">
                                <i class="fa fa-clone"></i>
                            </div>
                            <span class="breadcrumb-text">Activity</span>
                        </a>
                        <a href="/plandischarge" class="breadcrumb-item">
                            <span class="breadcrumb-text">Job Order Discharge</span>
                        </a>
                        <a href="/plandischarge" class="breadcrumb-item">
                            <span class="breadcrumb-text">Discharge</span>
                        </a>

                    </div>
                    <!-- END Breadcrumb -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
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

                    <div class="col-md-6">
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
                    {{-- <div class="col-md-6">
                        <label for="POL" class="form-label">POT</label>
                        <select id="POT-1">
                            <option value="AK" selected disabled>Pilih POT</option>
                            <option value="HI">Hawaii</option>
                            <option value="CA">California</option>
                            <option value="NV">Nevada</option>
                            <option value="OR">Oregon</option>
                            <option value="WA">Washington</option>
                        </select>
                    </div> --}}
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
    <div class="col-md-12">
        <div class="portlet">

            <div class="portlet-body">

                <!-- BEGIN Form -->
                <form class="row g-3">

                    <div class="col-md-12 text-center">
                        <label for="inputState" class="form-label"><b>Kontainer :</b></label>
                    </div>
                    <div class="table-responsive">

                        <table class="table">
                            <thead class="table-success">
                                <tr>
                                    <th class="text-center" >No</th>
                                    <th class="text-center" >Nomor(Kontainer)</th>
                                    <th class="text-center" >Size(Kontainer)</th>
                                    <th class="text-center" >Type(Kontainer)</th>
                                    <th class="text-center" >Seal(Kontainer)</th>
                                    <th class="text-center" >No. BL(Kontainer)</th>
                                    <th class="text-center" >Cargo(Kontainer)</th>
                                    <th class="text-center" >Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <th scope="row">1</th>
                                    <td><input type="text" class="form-control" value=""></td>
                                    <td><select id="size" class="form-select">
                                        <option selected disabled>Pilih Size</option>
                                        <option>...</option>
                                    </select></td>
                                    <td><select id="type" class="form-select">
                                        <option selected disabled>Pilih Type</option>
                                        <option>...</option>
                                    </select></td>
                                    <td><select id="seal" class="form-select">
                                        <option selected disabled>Pilih Seal</option>
                                        <option>...</option>
                                    </select></td>
                                    <td><input type="text" class="form-control" value="" placeholder=""></td>
                                    <td><input type="text" class="form-control" value=""></td>
                                    <td><button class="btn btn-label-danger btn-icon btn-circle btn-sm"><i class="fa fa-trash"></i></button></td>
                                </tr>


                            </tbody>

                        </table>
                    </div>

                    <div class="">
                        <button class="btn btn-success btn-icon"> <i class="fa fa-plus"></i></button>
                    </div>



                    <div class="col-md-12">
                        <label for="POL" class="form-label">Remark :</label>
                        <textarea class="form-control" name=""></textarea>



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

@endsection


