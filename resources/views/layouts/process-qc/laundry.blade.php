<div class="flex items-center p-2 space-x-2 font-semibold">
    @if(request()->routeIs('processqcmodule::laundry.*'))
    <x-heroicon-o-folder-open class="w-5 h-5" />
    @else
    <x-heroicon-o-folder class="w-5 h-5" />
    @endif
    <h3> Laundry  </a>
</div>
<ul class="px-5">
    <li>
        <a
            href="{{ route('processqcmodule::laundry.inline-audit') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::laundry.inline-audit.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />inline audit
        </a>
    </li>
    <li>
        <a
            href="{{ route('processqcmodule::laundry.sewing-inspection') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::laundry.sewing-inspection.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Sewing 100% Inspection
        </a>
    </li>
    <li>
        <a
            href="{{ route('processqcmodule::laundry.finish-inspection') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::laundry.finish-inspection.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Finish 100% Inspection
        </a>
    </li>
    <li>
        <a
            href="{{ route('processqcmodule::laundry.endline-audit') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::laundry.endline-audit.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Endline Audit
        </a>
    </li>
</ul>
