<div class="flex items-center p-2 space-x-2 font-semibold">
    @if(request()->routeIs('proceesqcmodule::pre-assembly-sewing-offline.*'))
    <x-heroicon-o-folder-open class="w-5 h-5" />
    @else
    <x-heroicon-o-folder class="w-5 h-5" />
    @endif
    <h3> Pre-assembly / Sewing Offline  </a>
</div>
<ul class="px-5">
    <li>
        <a
            href="{{ route('proceesqcmodule::pre-assembly-sewing-offline.inline-audit') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('proceesqcmodule::pre-assembly-sewing-offline.inline-audit.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Inline audit
        </a>
    </li>
    <li>
        <a
            href="{{ route('proceesqcmodule::pre-assembly-sewing-offline.sewing-inspection') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('proceesqcmodule::pre-assembly-sewing-offline.sewing-inspection.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Sewing 100% Inspection
        </a>
    </li>
</ul>
