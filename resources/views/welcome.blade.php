<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Social Network</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{URL::to('css/app.css')}}">

        <!-- Styles -->
        <style>
            html, body {
                font-family: 'Nunito', sans-serif;
                background-color: #4717f6;
                color: #636b6f;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 70px;
                color: #FFFFFF;
            }

            .title > h1{
                margin-bottom:0;
            }

            .content p{
                color:#FFFFFF;
                font-size:30px;
            }

            #created-by{
                color:#FFFFFF;
                font-size:14px;
            }

            .btn-register{
                max-width:200px;
                width:100%;
                padding: 5px 80px;
                background-color:transparent;
                border: 2px solid #FFF;
                color: #FFF;
                border-radius: 10px;
                font-size: 16px;
                text-decoration: none;
            }
            
            .links > a {
                color: #FFFFFF;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 40px;
            }

            .m-t-md {
                margin-top: 40px;
            }

            @media (max-width: 768px){
                .title {
                    font-size: 20px;
                }
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title">
                    <h1>Social Network</h1>
                </div>
                <p class="description">Ven y disfruta de nuestra increible app</p>
                @if (Route::has('register'))
                    <a class="btn-register m-b-md" href="{{ route('register') }}">Registrarse</a>
                @endif
                <div class="links m-t-md">
                    <a href="https://github.com/AdrianAVA9/Social-Network">Ver codigo fuente GitHub</a>
                </div>
                <p id="created-by">Creado por: <strong>Adrián Antonio Vega Acevedo</strong></p>
            </div>
        </div>
    </body>
</html>
