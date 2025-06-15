<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('processqcmodule::assembly/sewing-online.inline-defect.setup') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::assembly/sewing-online.inline-defect.setup') ? 'btn-primary':'btn-ghost' }}">Setup</a>
        </li>
        <li>
          <a
                href="{{ route('processqcmodule::assembly/sewing-online.inline-defect.report') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::assembly/sewing-online.inline-defect.report') ? 'btn-primary':'btn-ghost' }}">Report</a>
        </li>

        <li>
          <a
                href="{{ route('processqcmodule::assembly/sewing-online.inline-defect.inspector') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::assembly/sewing-online.inline-defect.inspector') ? 'btn-primary':'btn-ghost' }}">Inspection</a>
        </li>
    </ul>
  </div>
