<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('processqcmodule::assembly/sewing-online.inline-audit.first-bulk.setup') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::assembly/sewing-online.inline-audit.first-bulk.setup') ? 'btn-primary':'btn-ghost' }}">Seup</a>
        </li>
        <li>
          <a
                href="{{ route('processqcmodule::assembly/sewing-online.inline-audit.first-bulk.inspector') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::assembly/sewing-online.inline-audit.first-bulk.inspector') ? 'btn-primary':'btn-ghost' }}">Inspector</a>
        </li>

        <li>
          <a
                href="{{ route('processqcmodule::assembly/sewing-online.inline-audit.first-bulk.report') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::assembly/sewing-online.inline-audit.first-bulk.report') ? 'btn-primary':'btn-ghost' }}">Report</a>
        </li>
    </ul>
  </div>
