<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        {{-- https://laravel.com/docs/8.x/helpers#method-mix --}}
        <script>

            var globalData = {

                baseURL: '{{  url( '' ) }}'

            };

        </script>
        <script src="{{ asset( mix( '/js/app.js' ) ) }}" defer></script>

    </head>

    <body class="font-sans antialiased {{ $bodyClass }}">

        <div class="min-h-screen bg-gray-100">

            <div id="v_app_header" class="v-app-header">
    
            </div>

            <!-- Page Heading -->
            <header class="main bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-16">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

        </div>

        @stack( 'scripts' )

    </body>

</html>
