<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('accessory::sewing-trim.testing') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::sewing-trim.testing') ? 'btn-primary':'btn-ghost' }}">Testing</a>
        </li>
        <li>
          <a
                href="{{ route('accessory::sewing-trim.audit') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::sewing-trim.audit') ? 'btn-primary':'btn-ghost' }}">Audit</a>
        </li>
        <li>
            <a
                href="{{ route('accessory::sewing-trim.approval') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::sewing-trim.approval') ? 'btn-primary':'btn-ghost' }}">Approval</a>
        </li>
        <li>
            <a
                href="{{ route('accessory::sewing-trim.inspection') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::sewing-trim.inspection') ? 'btn-primary':'btn-ghost' }}">100% Inspection</a>
        </li>
    </ul>
  </div>
