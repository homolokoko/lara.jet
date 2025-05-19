<div class="flex items-center p-2 space-x-2 font-semibold">
    @if(request()->routeIs('processqcmodule::cutting.*'))
    <x-heroicon-o-folder-open class="w-5 h-5" />
    @else
    <x-heroicon-o-folder class="w-5 h-5" />
    @endif
    <h3> Cutting  </a>
</div>
<ul class="px-5">
    <li>
        <a
            href="{{ route('processqcmodule::cutting.inline-audit') }}"
            class=" btn btn-xs {{ request()->routeIs('processqcmodule::cutting.inline-audit.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Inline audit
        </a>
    </li>
    <li>
        <a
            href="{{ route('processqcmodule::cutting.endline-inspection') }}"
            class=" btn btn-xs {{ request()->routeIs('processqcmodule::cutting.endline-inspection.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Endline 100% Inspection
        </a>
    </li>
    <li>
        <a
            href="{{ route('processqcmodule::cutting.testing') }}"
            class=" btn btn-xs {{ request()->routeIs('processqcmodule::cutting.testing.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Testing
        </a>
    </li>
</ul>
