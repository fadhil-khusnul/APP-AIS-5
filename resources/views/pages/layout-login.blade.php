@extends('pages.login')

@section('login')

<div class="modal-login is-open">
    <div class="modal-container-login">
        <div class="modal-left-login">
            <img class="online-login" src="{{ asset('/') }}./assets/images/online.png">

           
           
            <h1 class="modal-title-login">Login</h1>

            <p class="modal-desc-login"> Website AIS Logistik Makassar.</p>
            <div class="input-block-login">
                <label for="email" class="input-label-login">Username</label>
                <input type="email" name="username" id="username" placeholder="Username">
            </div>
            <div class="input-block-login">
                <label for="password" class="input-label-login">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="modal-buttons-login">
                <a href="/" class="input-button-login">Login</a>
                <a  type="button" class="login-with-google-btn" href="{{ '/auth/redirect'}}">Login with Google</a>

            </div>
            <a style="font-size: 12px;" class="modal-desc-login" href="{{ 'auth/reset-password' }}">
                <p class="modal-desc-login">Forgot Password ?</p>
            </a>
                    

            
        </div>
        <div class="modal-right-login">
            <img src="{{ asset('/') }}./assets/images/trucks.jpg">
            
        </div>
        
        
    </div>
    <button class="modal-button-login">Login</button>
</div>

@endsection
