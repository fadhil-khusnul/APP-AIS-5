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

                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Jumlah Container</label>
						<input class="form-control" id="jumlah_container" type="text" value="0">
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Size 20'</label>
						<input class="form-control" id="size-20" type="text" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Size 21'</label>
						<input class="form-control" id="size-21" type="text" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Size 40'</label>
						<input class="form-control" id="size-40" type="text" value="0">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Size 45'</label>
						<input class="form-control" id="size-45" type="text" value="0">
                    </div>

                    <div class="col-md-6">
                        <label for="POL" class="form-label">Jenis Kontainer</label>
                        <select id="jenis-container">
                            <option value="AK" selected disabled>Pilih Jenis Kontainer</option>
                            <option value="HI">Hawaii</option>
                            <option value="CA">California</option>
                            <option value="NV">Nevada</option>
                            <option value="OR">Oregon</option>
                            <option value="WA">Washington</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="POL" class="form-label">Remark</label>
                        <input type="text" class="form-control">



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


