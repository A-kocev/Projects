<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/3a818acd01.js" crossorigin="anonymous"></script>
     
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100   sm:flex  ">

        <div class=" lg:w-1/5 md:w-1/3 sm:w-2/5 h-100vh bg-primary-white">
            @include('layouts.navigation')

        </div>
        <div class="lg:w-4/5 md:w-2/3 sm:w-3/5 bg-primary-white shadow">
              <!-- Page Heading -->
                 @if (isset($header))
                <header class="bg-white  shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                    <!-- Page Content -->
                <main>
                {{ $slot }}
               </main>

                 @endif

            @yield('content')
        
        </div>
        
        </div>
      
    </body>
</html>
