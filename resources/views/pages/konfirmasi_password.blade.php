@extends('pages.login')

@section('login')

<div class="modal-login is-open">
    <div class="modal-container-login">
        <div class="modal-left-login">
            <img class="online-login" src="{{ asset('/') }}./assets/images/online.png">

           
            <form id="valid_password" name="valid_password">
                <p style="font-size: 14px" class="modal-desc-login" id="text-konfirmasi"></p>

                <div class="input-block-login validation-container">
                    <label for="" class="input-label-login">Masukkan Password Baru</label>
                    <input class="form-control" type="password" name="password_baru" id="password_baru" placeholder="Password">
                    <input type="hidden" name="csrf" id="csrf" value="{{ Session::token() }}">

                </div>
                <div class="input-block-login validation-container">
                    <label for="" class="input-label-login">Konfirmasi Password </label>
                    <input class="form-control" type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi Password">

                </div>

                <div class="text-center">
                    <button type="submit"class="btn btn-success" id="btnnext_password">Submit</button>

                </div>

            </form>
            
        </div>
        <div class="modal-right-login">
            <img src="{{ asset('/') }}./assets/images/trucks.webp">
            
        </div>
       
        
    </div>
    <button class="modal-button-login">Login</button>
</div>

<script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery.js"></script>
<script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/jquery-ui.js"></script>


<script type="text/javascript" src="{{ asset('/') }}./js/otp/konfirmasi_password.js"></script>
<script type="text/javascript">

    if(window.performance.navigation.type == 1) {
        location.href = "/auth/reset-password"
    }
</script>

@endsection
