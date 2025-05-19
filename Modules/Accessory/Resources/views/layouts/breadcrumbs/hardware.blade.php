<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('accessory::hardware.testing') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::hardware.testing') ? 'btn-primary':'btn-ghost' }}">Testing</a>
        </li>
        <li>
          <a
                href="{{ route('accessory::hardware.audit') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::hardware.audit') ? 'btn-priry':'btn-ghost' }}">Audit</a>
        </li>
        <li>
            <a
                href="{{ route('accessory::hardware.approval') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::hardware.approval') ? 'btn-primry':'btn-ghost' }}">Approval</a>
        </li>
        <li>
            <a
                href="{{ route('accessory::hardware.inspection') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::hardware.inspection') ? 'btn-prry':'btn-ghost' }}">100% Inspection</a>
        </li>
    </ul>
  </div>
