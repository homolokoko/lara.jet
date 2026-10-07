<x-app-layout>

    <div class="">

        <div class="alert">
            <h3 class="px-3 py-1 text-2xl font-bold tracking-widest uppercase rounded-full text-primary">Management</h3>
        </div>
        <div class="grid grid-cols-2 gap-5 sm:grid-cols-4 md:grid-cols-6 p-7 ">

            <a  href="{{route('management.attendent')}}"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/attendance.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">Attenden&Score</p>
            </a>
            <a  href="{{route('management.staff')}}"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/teamwork.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">Staff Management</p>
            </a>
            <a  href="{{route('management.student')}}"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/students.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">Student Management</p>
            </a>
            <a  href="{{route('management.course')}}"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/training.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">Course Management</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/file.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">Setup Management</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/team.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">User Management</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/seo-report.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">Report Management</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/credit-card-premium.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">Special Staff Payment</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/credit-card.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">General Staff Payment</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/fund.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">Income</p>
            </a>
            <a  href="#" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/outcome.png')}}">
                </div><p class="text-xs font-bold tracking-wider uppercase">Outcome</p>
            </a>
            <a  href="{{route('management.tuition')}}" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/tuition.png')}}">
                </div><button class="text-xs font-bold tracking-wider uppercase">Tuition</button>
            </a>
            <a  href="{{route('management.tuition-fee')}}" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/fee.png')}}">
                </div><button class="text-xs font-bold tracking-wider uppercase">Fee</button>
            </a>
            <a  href="{{route('management.score-bulletin')}}" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/results.png')}}">
                </div><button class="text-xs font-bold tracking-wider uppercase">Bullet Marks</button>
            </a>
            <a  href="{{route('management.certificate-scoring')}}" disabled="true"
                class="flex flex-col items-center p-3 space-y-3 rounded-lg bg-base-50">
                <div class="p-5 overflow-hidden rounded-xl">
                    <img class="w-24" src="{{asset('menu/paper-document.png')}}">
                </div><button class="text-xs font-bold tracking-wider uppercase">Grading Certification</button>
            </a>
        </div>

    </div>
</x-app-layout>
