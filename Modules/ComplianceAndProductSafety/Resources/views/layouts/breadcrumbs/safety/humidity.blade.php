<div class="text-sm breadcrumbs">
    <ul>
        <li>
            <a
                href="{{ route('complianceandproductsafety::safety.humidity.setup') }}"
                class=" btn btn-xs {{ request()->routeIs('complianceandproductsafety::safety.humidity.setup') ? 'btn-primary':'btn-ghost' }}"> Setup </a>
        </li>
        <li>
          <a
                href="{{ route('complianceandproductsafety::safety.humidity.report') }}"
                class=" btn btn-xs {{ request()->routeIs('complianceandproductsafety::safety.humidity.report') ? 'btn-primary':'btn-ghost' }}"> Report </a>
        </li>
        <li>
            <a
                href="{{ route('complianceandproductsafety::safety.humidity.inspector') }}"
                class=" btn btn-xs {{ request()->routeIs('complianceandproductsafety::safety.humidity.inspector') ? 'btn-primary':'btn-ghost' }}"> Inspector </a>
        </li>
    </ul>
  </div>
