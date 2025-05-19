<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('processqcmodule::laundry.inline-audit.inline-afterwash') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::laundry.inline-audit.inline-afterwash') ? 'btn-primary':'btn-ghost' }}">Inline Afterwash</a>
        </li>
        <li>
          <a
                href="{{ route('processqcmodule::laundry.inline-audit.measurement-audit') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::laundry.inline-audit.measurement-audit') ? 'btn-primary':'btn-ghost' }}">Measurement Audit</a>
        </li>
    </ul>
  </div>
