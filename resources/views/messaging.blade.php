<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="manifest" href="{{ secure_asset('manifest.json') }}">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
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

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
            </div>
        </div>
        <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js" defer></script>
        <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
        <!-- <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js" defer></script> -->
        <!-- Add Firebase products that you want to use -->
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js" defer></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js" defer></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-messaging.js" defer></script>
        <script src="{{ secure_asset('js/firebase/7.24.0/initialization.js') }}" defer></script>
    </body>
</html>
