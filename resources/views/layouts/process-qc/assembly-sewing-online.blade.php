<div class="flex items-center p-2 space-x-2 font-semibold">
    @if(request()->routeIs('processqcmodule::assembly/sewing-online.*'))
    <x-heroicon-o-folder-open class="w-5 h-5" />
    @else
    <x-heroicon-o-folder class="w-5 h-5" />
    @endif
    <h3>  Assembly / Sewing Online  </h3>
</div>
<ul class="px-3">
    <li>@include('layouts.process-qc.assembly-sewing-online.inline-audit')</li>
    <li>@include('layouts.process-qc.assembly-sewing-online.sewing-inspection')</li>
    <li>@include('layouts.process-qc.assembly-sewing-online.endline-audit')</li>
</ul>
