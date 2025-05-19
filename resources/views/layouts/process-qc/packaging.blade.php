<div class="flex items-center p-2 space-x-2 font-semibold">
    @if(request()->routeIs('processqcmodule::packaging.*'))
    <x-heroicon-o-folder-open class="w-5 h-5" />
    @else
    <x-heroicon-o-folder class="w-5 h-5" />
    @endif
    <h3> Packaging  </a>
</div>
<ul class="px-5">
    <li>
        <a
            href="{{ route('processqcmodule::packaging.inline-audit') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::packaging.inline-audit.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Inline Audit
        </a>
    </li>
    <li>
        <a
            href="{{ route('processqcmodule::packaging.sewing-inspection') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::packaging.sewing-inspection.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Sewing 100% Inspection
        </a>
    </li>
    <li>
        <a
            href="{{ route('processqcmodule::packaging.endline-audit') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::packaging.endline-audit.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Endline Audit
        </a>
    </li>
    <li>
        <a
            href="{{ route('processqcmodule::packaging.carton-audit') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::packaging.carton-audit.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Carton Audit
        </a>
    </li>
</ul>
