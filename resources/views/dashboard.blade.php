<x-app-layout>

    <div class="">
        <div class="alert">
            <h3 class="px-3 py-1 text-2xl font-bold rounded-full text-primary">Setup</h3>
        </div>
        <div class="flex gap-5 p-7 ">

            <div class="space-y-3">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                <a href="/management/buyer" class="w-full btn-block btn btn-primary">start</a>
            </div>

            <div class="space-y-3">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/clothes.png')}}"></div>
                <a href="/management/apparel" class="w-full btn-block btn btn-primary">start</a>
            </div>

            <div class="space-y-3">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/paint.png')}}"></div>
                <a href="/management/style" class="w-full btn-block btn btn-primary">start</a>
            </div>

{{--            <div class="space-y-3">--}}
{{--                <div class="p-5 overflow-hidden border border-black rounded-full">--}}
{{--                    <img src="{{asset('menu/details.png')}}"></div>--}}
{{--                <a href="/setup/profile" class="w-full btn-block btn btn-primary">start</a>--}}
{{--            </div>--}}

        </div>


        <div class="alert">
            <h3 class="px-3 py-1 text-2xl font-bold rounded-full text-primary">management</h3>
        </div>
        <div class="grid grid-cols-6 gap-5 p-7 ">

            <a  href="/management/staff"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                    <button class="w-full btn btn-primary">Attenden&Score</button>
            </a>
            <a  href="{{route('management.staff')}}"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                    <button class="w-full btn btn-primary">Staff Management</button>
            </a>
            <a  href="{{route('management.course')}}"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                    <button class="w-full btn btn-primary">Course Management</button>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                    <button class="w-full btn btn-primary">Setup Management</button>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                    <button class="w-full btn btn-primary">User Management</button>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                    <button class="w-full btn btn-primary">Report Management</button>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                    <button class="w-full btn btn-primary">Special Staff Payment</button>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                    <button class="w-full btn btn-primary">General Staff Payment</button>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                    <button class="w-full btn btn-primary">Income</button>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden border border-black rounded-full">
                    <img src="{{asset('menu/client.png')}}"></div>
                    <button class="w-full btn btn-primary">Outcome</button>
            </a>
        </div>

    </div>
</x-app-layout>
