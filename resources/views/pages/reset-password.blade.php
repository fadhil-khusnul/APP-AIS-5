@extends('pages.login')

@section('login')

<div class="modal-login is-open">
    <div class="modal-container-login">
        <div class="modal-left-login">
            <img class="online-login" src="{{ asset('/') }}./assets/images/online.png">

           
           

            <p class="modal-desc-login">{{ $title }}.</p>

            <form name="valid_email" id="valid_email">

                <div class="input-block-login validation-container">
                    <label for="email" class="input-label">Email</label>
                    <input type="hidden" name="csrf" id="csrf" value="{{ Session::token() }}">

                    <input class="form-control" type="email" name="email" id="email" placeholder="Masukkan Email">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success" id="btnnext">Next</button>
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




@endsection
