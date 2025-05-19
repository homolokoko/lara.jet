<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('accessory::packing-material.testing') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::packing-material.testing') ? 'btn-primary':'btn-ghost' }}">Testing</a>
        </li>
        <li>
          <a
                href="{{ route('accessory::packing-material.audit') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::packing-material.audit') ? 'btn-primary':'btn-ghost' }}">Audit</a>
        </li>
        <li>
            <a
                href="{{ route('accessory::packing-material.approval') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::packing-material.approval') ? 'btn-primary':'btn-ghost' }}">Approval</a>
        </li>
        <li>
            <a
                href="{{ route('accessory::packing-material.inspection') }}"
                class="btn btn-xs {{ request()->routeIs('accessory::packing-material.inspection') ? 'btn-primary':'btn-ghost' }}">100% Inspection</a>
        </li>
    </ul>
  </div>
