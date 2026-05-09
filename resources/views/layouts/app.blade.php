<!DOCTYPE html>
<html x-data="{
    theme:'',
    init(){
        this.theme = localStorage.getItem('modify-theme-content');
    }
}" @modify-theme-content="theme=event.detail" :data-theme="theme"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('snapchat.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="dist/css/tabulator.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Fonts -->

    <!-- Styles -->
    @livewireStyles

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}} -->
</head>

<header class="border">

    <div x-data="{show_nav:false}">
        <div x-show="show_nav" class="w-1/4 h-full py-5 overflow-auto shadow-lg side">
            @include('layouts.side')
        </div>
    </div>
</header>

<body class="font-sans antialiased">

    <div class="w-screen h-screen">
        <!-- Page Content -->
        <div class="flex w-full h-full divide-x">
            <div class="flex flex-col w-full divide-y main">
                <div class="flex justify-between w-full p-5 shadow-lg nav">
                    <div class="flex">
                        <img src="{{ asset('snapchat.png') }}" alt="" class="w-8 h-8">
                        <a href="{{ route('dashboard') }}" class="text-xl font-bold">TQMS Process Module</a>
                    </div>
                    <h3 class="font-sans text-xl font-bold">{{@$title}}</h3>
                    <div x-data="{
                            picked:'',
                            dropdown:false,
                            themes:[
                                {value:'',text:'light'},
                                {value:'dark',text:'dark'},
                                {value:'cupcake',text:'cupcake'},
                                {value:'bumblebee',text:'bumblebee'},
                                {value:'emerald',text:'emerald'},
                                {value:'corporate',text:'corporate'},
                                {value:'synthwave',text:'synthwave'},
                                {value:'retro',text:'retro'},
                                {value:'cyberpunk',text:'cyberpunk'},
                                {value:'valentine',text:'valentine'},
                                {value:'halloween',text:'halloween'},
                                {value:'garden',text:'garden'},
                                {value:'forest',text:'forest'},
                                {value:'aqua',text:'aqua'},
                                {value:'lofi',text:'lofi'},
                                {value:'pastel',text:'pastel'},
                                {value:'fantasy',text:'fantasy'},
                                {value:'wireframe',text:'wireframe'},
                                {value:'black',text:'black'},
                                {value:'luxury',text:'luxury'},
                                {value:'dracula',text:'dracula'},
                                {value:'cmyk',text:'cmyk'}
                            ],
                            selectedTheme(val){
                                this.picked = val;
                                $dispatch('modify-theme-content',val);
                                localStorage.setItem('modify-theme-content', val);
                            },
                            init(){
                                this.picked = localStorage.getItem('modify-theme-content');
                            }
                        }" class="dropdown">
                        <button class="btn btn-ghost btn-sm" @click="dropdown=!dropdown" class="btn">Choose
                            Theme</button>
                        <ul tabindex="0" x-show="dropdown"
                            class="p-2 overflow-auto text-black max-h-96 dropdown-content rounded-box bg-secondary">
                            <template x-for="theme in themes">
                                <li><button x-text="theme.text" class="flex justify-between w-full btn btn-ghost btn-sm"
                                        :class="{'btn-active':picked===theme.value}"
                                        @click="selectedTheme(theme.value)"></button></li>
                            </template>
                        </ul>
                    </div>


                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-jet-dropdown-link>
                    </form>
                </div>
                <div class="w-full h-full p-5 overflow-auto shadow-lg content">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
<footer>
    @include('layouts.links.header')
</footer>

</html>