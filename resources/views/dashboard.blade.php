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
    </div>
</x-app-layout>
