<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.setup') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.setup') ? 'btn-primary':'btn-ghost' }}">Seup</a>
        </li>
        <li>
          <a
                href="{{ route('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.inspector') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.inspector') ? 'btn-primary':'btn-ghost' }}">Inspector</a>
        </li>

        <li>
          <a
                href="{{ route('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.report') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::assembly/sewing-online.endline-audit.inline-inspection.report') ? 'btn-primary':'btn-ghost' }}">Report</a>
        </li>
    </ul>
  </div>
