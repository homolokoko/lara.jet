<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('processqcmodule::cutting.inline-audit.inline-cutting') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::cutting.inline-audit.inline-cutting') ? 'btn-primary':'btn-ghost' }}">Inline Cutting</a>
        </li>
        <li>
          <a
                href="{{ route('processqcmodule::cutting.inline-audit.fabric-audit') }}"
                class="btn btn-xs {{ request()->routeIs('processqcmodule::cutting.inline-audit.fabric-audit') ? 'btn-primary':'btn-ghost' }}">Fabric Audit</a>
        </li>
    </ul>
  </div>
