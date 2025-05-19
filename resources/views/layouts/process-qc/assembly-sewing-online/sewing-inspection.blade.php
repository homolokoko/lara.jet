<div class="flex items-center p-2 space-x-2 text-sm font-semibold">
    @if(request()->routeIs('processqcmodule::assembly/sewing-online.sewing-inspection.*'))
    <x-heroicon-o-folder-open class="w-5 h-5" />
    @else
    <x-heroicon-o-folder class="w-5 h-5" />
    @endif
    <h3> sewing 100% inspection  </a>
</div>
<ul class="ml-5">
    <li>
        <a
            href="{{ route('processqcmodule::assembly/sewing-online.sewing-inspection.endline') }}"
            class=" btn btn-xs btn-ghost {{ request()->routeIs('processqcmodule::assembly/sewing-online.sewing-inspection.endline') ? 'btn-link':'btn-ghost' }}">
            <x-heroicon-o-play class="w-5 h-5" />Endline
        </a>
    </li>
</ul>
