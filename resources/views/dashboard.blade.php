<x-app-layout>

    <div class="">
        <div class="alert">
            <h3 class="text-2xl font-bold text-primary px-3 py-1 rounded-full">Setup</h3>
        </div>
        <div class="flex gap-5 p-7 ">

            <div class="space-y-3">
                <div class="overflow-hidden p-5 rounded-full border border-black">
                    <img src="{{asset('menu/client.png')}}"></div>
                <a href="/setup/buyer" class="btn-block btn btn-primary w-full">start</a>
            </div>

            <div class="space-y-3">
                <div class="overflow-hidden p-5 rounded-full border border-black">
                    <img src="{{asset('menu/clothes.png')}}"></div>
                <a href="/setup/apparel" class="btn-block btn btn-primary w-full">start</a>
            </div>

            <div class="space-y-3">
                <div class="overflow-hidden p-5 rounded-full border border-black">
                    <img src="{{asset('menu/paint.png')}}"></div>
                <a href="/setup/style" class="btn-block btn btn-primary w-full">start</a>
            </div>

{{--            <div class="space-y-3">--}}
{{--                <div class="overflow-hidden p-5 rounded-full border border-black">--}}
{{--                    <img src="{{asset('menu/details.png')}}"></div>--}}
{{--                <a href="/setup/profile" class="btn-block btn btn-primary w-full">start</a>--}}
{{--            </div>--}}

        </div>
    </div>
</x-app-layout>
