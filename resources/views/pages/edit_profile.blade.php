@extends('layouts.main')

@section('content')
    <div class="row">

        <div class="col-md-8" style="margin-left: auto; margin-right:auto;">

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">Edit User</h3>
                </div>
                <div class="portlet-body">

                    <form class="row d-grid gap-3" id="valid_profil_edit" name="valid_profil_edit">

                        <input type="hidden" name="remember_token" id="remember_token" value="{{ $users->remember_token }}">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">


                        <div class="col-md-8" style="margin-left:auto; margin-right:auto;">
                            <div class="validation-container">
                                <div style="margin-left: auto; margin-right:auto; text-align:center" class="justify-content-center col-6">
                                    <label style="text-align: center" class="text-label">Profile Picture:</label>
                                    <input type="file" class="filepond" name="img" id="img"
                                        data-max-file-size="2MB" accept="image/png, image/jpeg, image/gif" />
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan Nama User :</label>
                                <input value="{{ $users->name }}" id="name" name="name" type="text" placeholder="Nama User" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan Email :</label>
                                <input value="{{ $users->email }}" id="email" name="email" type="email" placeholder="Email" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan No. Telp :</label>
                                <input value="{{ $users->no_telp }}" id="no_telp" name="no_telp" type="numeric" placeholder="No. Telp" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Masukkan Username :</label>
                                <input value="{{ $users->username }}" id="username" name="username" type="text" placeholder="Username" class="form-control"
                                    required>
                            </div>
                        </div>

                     
                        <div class="col-md-12">
                            <div class="validation-container">
                                <label for="" class="form-label">Pilih Role :</label>
                                <select name="role" id="role" class="form-control">
                                    <option @if ($users->role == "super_user") selected @endif value="super_user" class="form-control">Super User</option>
                                    <option @if ($users->role == "admin") selected @endif value="admin" class="form-control">Admin</option>
                                    <option @if ($users->role == "operasional") selected @endif value="operasional" class="form-control">Operasional</option>
                                </select>
                                
                            </div>
                        </div>
                        


                        <div class="text-end">
                            <button onclick="editpassword(this)" value="{{ $users->id }}"
                                class="btn btn-label-primary btn-icon btn-circle btn-sm"><i
                                    class="fa fa-lock"></i></button>

                            <button type="submit" class="btn btn-success"> Edit User </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- END Portlet -->
            <!-- BEGIN Portlet -->

            <!-- END Portlet -->
        </div>
      

    </div>

    <div class="modal fade" id="modal-password-edit">
        <div class="modal-dialog">
            <form action="#" name="valid_password_edit" id="valid_password_edit">
                <input type="hidden" name="new_id" id="new_id">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Password User</h5> <h5 id="username_title" class="modal-title"></h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body d-grid gap-3 px-5">

                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="">Nama User :</label>
                        <div class="col-sm-8 validation-container">
                            <input readonly id="nama_user_edit" name="nama_user_edit" type="text" placeholder="Tanggal Deposit" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label"for="area_code">Role :</label>
                        <div class="col-sm-8 validation-container">

                            <select name="role_edit" id="role_edit" class="form-control">
                                <option value="super_user" class="form-control">Super User</option>
                                <option value="admin" class="form-control">Admin</option>
                                <option value="operasional" class="form-control">Operasional</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label" for="email">Masukkan Password Baru :</label>
                        <div class="col-sm-8 validation-container">
                                <input class="form-control" id="password_edit" name="password_edit" type="password">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Reset</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

            </form>

        </div>
    </div>

    
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>

    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src='https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js'>
    </script>

    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src='https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js'></script>

    <script type="text/javascript" src="{{ asset('/') }}./js/pemisah_titik.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./js/user.js"></script>
@endsection