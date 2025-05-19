<div class="flex items-center p-2 space-x-2 font-semibold">
    @if(request()->routeIs('processqcmodule::embellishment.*'))
    <x-heroicon-o-folder-open class="w-5 h-5" />
    @else
    <x-heroicon-o-folder class="w-5 h-5" />
    @endif
    <h3> Embellishment  </a>
</div>
<ul class="px-5">
    <li>
        <a
            href="{{ route('processqcmodule::embellishment.inline-audit') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::embellishment.inline-audit.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Inline audit
        </a>
    </li>
    <li>
        <a
            href="{{ route('processqcmodule::embellishment.inspection') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::embellishment.inspection.*') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" /> 100% Inspection
        </a>
    </li>
</ul>
