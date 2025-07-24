<!DOCTYPE html>
<html data-theme="" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('snapchat.png') }}">

        <title>Contruction Machinary - @yield('title')</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- Fonts -->

        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <!-- {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}} -->
    </head>
    <body class="font-sans antialiased">

        <div class="w-screen h-screen">
            <!-- Page Content -->
            <div class="flex w-full h-full divide-x">
                <div class="w-1/4 h-full py-5 overflow-auto shadow-lg side">
                  <livewire:constructionmachinary::category key="constructionmachinary::category" />
                </div>
                <div class="flex flex-col w-3/4 divide-y main">
                  <div class="flex flex-auto w-full p-5 shadow-lg nav">
                    <img src="{{ asset('snapchat.png') }}" alt="" class="w-8 h-8">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold">TQMS Process Module</a>
                  </div>
                  <div class="w-full h-full p-5 overflow-auto shadow-lg content">
                    @yield('content')
                  </div>
                </div>
            </div>
        </div>
        @livewireScripts
        <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
</html>

