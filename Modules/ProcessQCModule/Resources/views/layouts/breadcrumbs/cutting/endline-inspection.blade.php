<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('processqcmodule::cutting.endline-inspection.endline-cutting') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::cutting.endline-inspection.endline-cutting') ? 'btn-primary':'btn-ghost' }}">Endline Cutting</a>
        </li>
        <li>
          <a
                href="{{ route('processqcmodule::cutting.endline-inspection.fabric-inspection') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::cutting.endline-inspection.fabric-inspection') ? 'btn-primary':'btn-ghost' }}">Fabric Inspection</a>
        </li>
    </ul>
  </div>
