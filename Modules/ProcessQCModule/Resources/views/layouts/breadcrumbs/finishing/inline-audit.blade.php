<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('processqcmodule::finishing.inline-audit.inline') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::finishing.inline-audit.inline') ? 'btn-primary':'btn-ghost' }}">Inline</a>
        </li>
        <li>
          <a
                href="{{ route('processqcmodule::finishing.inline-audit.measurement-audit') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::finishing.inline-audit.measurement-audit') ? 'btn-primary':'btn-ghost' }}">Measurement Audit</a>
        </li>
    </ul>
  </div>
