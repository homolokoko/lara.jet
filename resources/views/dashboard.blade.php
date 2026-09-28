<x-app-layout>

    <div class="">

        <div class="alert">
            <h3 class="px-3 py-1 text-2xl font-bold rounded-full tracking-widest uppercase text-primary">Management</h3>
        </div>
        <div class="grid grid-cols-6 gap-5 p-7 ">

            <a  href="{{route('management.attendent')}}"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/attendance.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">Attenden&Score</p>
            </a>
            <a  href="{{route('management.staff')}}"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/teamwork.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">Staff Management</p>
            </a>
            <a  href="{{route('management.student')}}"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/students.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">Student Management</p>
            </a>
            <a  href="{{route('management.course')}}"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/training.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">Course Management</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/file.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">Setup Management</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/team.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">User Management</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/seo-report.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">Report Management</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/credit-card-premium.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">Special Staff Payment</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/credit-card.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">General Staff Payment</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/fund.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">Income</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/outcome.png')}}">
                </div><p class="font-bold uppercase tracking-wider text-xs">Outcome</p>
            </a>
        </div>

    </div>
</x-app-layout>
