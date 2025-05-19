<ul>


  <!-- -------------------------- Leather ------------------------ -->
  <li>
    <h3 class="text-lg font-bold p-3 {{ request()->routeIs('leather::*') ? 'bg-indigo-900':'' }}"> Leather </h3>
    <ul class="px-5">
        <li>
            <a
                href="{{ route('leather::leather-audit.page') }}"
                class=" btn btn-xs btn-ghost {{ request()->routeIs('leather::leather-audit.page') ? 'btn-link':'btn-ghost' }}">
                <x-heroicon-o-play class="w-5 h-5" />Leather audit
            </a>
        </li>
    </ul>
  </li>

    <!-- ----------------------- Accessory ------------------------ -->
    <li>
        <h3 class="text-lg font-bold p-3 {{ request()->routeIs('accessory::*') ? 'bg-indigo-900':'' }}"> Accessory </h3>
        <ul class="px-3">
            <li>
                <a
                    href="{{ route('accessory::sewing-trim') }}"
                    class=" btn btn-xs btn-ghost {{ request()->routeIs('accessory::sewing-trim.*') ? 'btn-link':'btn-ghost' }}">
                    <x-heroicon-o-play class="w-5 h-5" />Sewing
                </a>
            </li>
            <li>
                <a
                    href="{{ route('accessory::hardware') }}"
                    class=" btn btn-xs btn-ghost {{ request()->routeIs('accessory::hardware.*') ? 'btn-link':'btn-ghost' }}">
                    <x-heroicon-o-play class="w-5 h-5" />Hardware
                </a>
            </li>
            <li>
                <a
                    href="{{ route('accessory::packing-material') }}"
                    class=" btn btn-xs btn-ghost {{ request()->routeIs('accessory::packing-material.*') ? 'btn-link':'btn-ghost' }}">
                    <x-heroicon-o-play class="w-5 h-5" />Packing Material
                </a>
            </li>
        </ul>
    </li>
    <!-- ----------------------- Process QC module ------------------------ -->
    <li>
        <h3 class="text-lg font-bold p-3 {{ request()->routeIs('processqcmodule::*') ? 'bg-indigo-900':'' }}"> Process QC module </h3>
        <ul class="">
            <li>@include('layouts.process-qc.cutting')</li>
            <li>@include('layouts.process-qc.embellishment')</li>
            <li>@include('layouts.process-qc.pre-assembly-sewing-offline')</li>
            <li>@include('layouts.process-qc.assembly-sewing-online')</li>
            <li>@include('layouts.process-qc.finishing')</li>
            <li>@include('layouts.process-qc.laundry')</li>
            <li>@include('layouts.process-qc.packaging')</li>
        </ul>
    </li>



    <!-- ------------------------------------- Compliance's Checklist and Product Safety -------------------------------  -->
    <li>
        <h3 class="text-lg font-bold p-3 {{ request()->routeIs('complianceandproductsafety::*') ? 'bg-indigo-900':'' }}">Compliance's Checklist and Product Safety</h3>
        <ul class="px-5">
            <li><a href="{{ route('complianceandproductsafety::safety.humidity') }}" class="btn btn-xs {{ request()->routeIs('complianceandproductsafety::safety.humidity.*') ? 'btn-link':'btn-ghost' }}"> <x-heroicon-o-play class="w-5 h-5" /> Humidity  </a></li>
            <li><a href="{{ route('complianceandproductsafety::safety.pull-test') }}" class="btn btn-xs {{ request()->routeIs('complianceandproductsafety::safety.pull-test.*') ? 'btn-link':'btn-ghost' }}"> <x-heroicon-o-play class="w-5 h-5" /> Pull Test  </a></li>
            <li><a href="{{ route('complianceandproductsafety::safety.button-testing') }}" class="btn btn-xs {{ request()->routeIs('complianceandproductsafety::safety.button-testing.*') ? 'btn-link':'btn-ghost' }}"> <x-heroicon-o-play class="w-5 h-5" /> Button Testing  </a></li>
            <li><a href="{{ route('complianceandproductsafety::safety.fusing-machine') }}" class="btn btn-xs {{ request()->routeIs('complianceandproductsafety::safety.fusing-machine.*') ? 'btn-link':'btn-ghost' }}"> <x-heroicon-o-play class="w-5 h-5" /> Fusing Machine  </a></li>
            <li><a href="{{ route('complianceandproductsafety::safety.heat-seal-machine') }}" class="btn btn-xs {{ request()->routeIs('complianceandproductsafety::safety.heat-seal-machine.*') ? 'btn-link':'btn-ghost' }}"> <x-heroicon-o-play class="w-5 h-5" /> Heat Seal Machine  </a></li>
            <li><a href="{{ route('complianceandproductsafety::safety.checklist-of-compliance') }}" class="btn btn-xs {{ request()->routeIs('complianceandproductsafety::safety.checklist-of-compliance.*') ? 'btn-link':'btn-ghost' }}"> <x-heroicon-o-play class="w-5 h-5" /> Compliance's CheckList  </a></li>
            <li><a href="{{ route('complianceandproductsafety::safety.needle-detector-calibration') }}" class="btn btn-xs {{ request()->routeIs('complianceandproductsafety::safety.needle-detector-calibration.*') ? 'btn-success':'btn-ghost' }}"> <x-heroicon-o-play class="w-5 h-5" /> Needle Detector Calibration  </a></li>
        </ul>
    </li>

</ul>
