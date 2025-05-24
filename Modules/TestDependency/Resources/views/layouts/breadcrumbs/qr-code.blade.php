<div class="text-sm breadcrumbs">
    <ul>
        <li>
          <a
                href="{{ route('testdependency::qr-code.scanner') }}"
                class="btn btn-xs {{ request()->routeIs('testdependency::qr-code.scanner') ? 'btn-primary':'btn-ghost' }}">QR scanner</a>
        </li>
        <li>
          <a
                href="{{ route('testdependency::qr-code.grid-list') }}"
                class="btn btn-xs {{ request()->routeIs('testdependency::qr-code.grid-list') ? 'btn-primary':'btn-ghost' }}">Grid List</a>
        </li>
        <li>
            <a
                href="{{ route('testdependency::qr-code.table-list') }}"
                class="btn btn-xs {{ request()->routeIs('testdependency::qr-code.table-list') ? 'btn-primary':'btn-ghost' }}">Table List</a>
        </li>
    </ul>
  </div>
