@extends('pages.login')

@section('login')

<div class="modal-login is-open">
    <div class="modal-container-login">
        <div class="modal-left-login">
            <img class="online-login" src="{{ asset('/') }}./assets/images/online.png">

           
            <form id="valid_otp" name="valid_otp">


                <p style="font-size: 14px" class="modal-desc-login" id="text-email">{{ $title }} dikirim ke {{ $email }}.</p>

                <div class="input-block-login validation-container">
                    <label for="email" class="input-label-login">Masukkan Kode OTP</label>
                    <input class="form-control" type="text" name="kode_otp" id="kode_otp" placeholder="Kode OTP">
                    <input type="hidden" name="email" id="email" value="{{ $email }}">
                    <input type="hidden" name="csrf" id="csrf" value="{{ Session::token() }}">

                </div>

                <div class="code">

                    <p style="font-size: 12px; margin-bottom: 10px" class="modal-desc-login">Silakan Masukkan Kode OTP &ensp;
                        <h1 style="font-size: 12px" class="modal-desc-login" id="time"> </h1>
                    </p>
                    
                </div>
                <a id="link_resend" style="font-size: 12px; display:block; text-align:center" class="modal-desc-login link" href="#" onclick="resend_code()">
                    Resend Code OTP <i class="bi bi-arrow-clockwise"></i>
                </a>
                
                <div class="text-center">
                    <button type="submit"class="btn btn-success" id="btnnext">Next</button>

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


<script type="text/javascript" src="{{ asset('/') }}./js/otp/otp.js"></script>
<script type="text/javascript">
    if(window.performance.navigation.type == 1) {
        location.href = "/auth/reset-password"
    }
</script>

@endsection
