<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/') }}./assets/build/styles/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}./assets/build/styles/login.css">
    <link href="{{ asset('/') }}./assets/images/icon.png" rel="shortcut icon" type="image/x-icon">



    <title>Login AIS-ONLINE</title>
</head>

<body>
    
    <div class="container"></div>
    <div class="modal is-open">
        <div class="modal-container">
            <div class="modal-left">
                <img class="online" src="{{ asset('/') }}./assets/images/online.png">
               
                <h1 class="modal-title">Login</h1>

                <p class="modal-desc">Website AIS Logistik Makassar.</p>
                <div class="input-block">
                    <label for="email" class="input-label">Username</label>
                    <input type="email" name="username" id="username" placeholder="Username">
                </div>
                <div class="input-block">
                    <label for="password" class="input-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="modal-buttons">
                    <a href="/" class="input-button">Login</a>
                </div>
            </div>
            <div class="modal-right">
                <img src="{{ asset('/') }}./assets/images/trucks.jpg">
                
            </div>
            <button class="icon-button close-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                    <path
                        d="M 25 3 C 12.86158 3 3 12.86158 3 25 C 3 37.13842 12.86158 47 25 47 C 37.13842 47 47 37.13842 47 25 C 47 12.86158 37.13842 3 25 3 z M 25 5 C 36.05754 5 45 13.94246 45 25 C 45 36.05754 36.05754 45 25 45 C 13.94246 45 5 36.05754 5 25 C 5 13.94246 13.94246 5 25 5 z M 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.980469 15.990234 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 z">
                    </path>
                </svg>
            </button>
            
        </div>
        <button class="modal-button">Login</button>
    </div>


    <script type="text/javascript" src="{{ asset('/') }}./js/login.js"></script>


</body>

</html>
