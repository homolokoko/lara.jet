<ul class="menu">
    <li><a class="{{ request()->routeIs('testdependency::qr-code.*') ? ' btn-primary':'btn-ghost' }}" href="{{route('testdependency::qr-code')}}"><img class="w-10 h-10" src="{{ url('menu/laptop.png') }}"></a></li>
    <li><a class="{{ request()->routeIs('testdependency::web-cam.*') ? ' btn-primary':'btn-ghost' }}" href="{{route('testdependency::web-cam')}}"><img class="w-10 h-10" src="{{ url('menu/camera.png') }}"></a></li>
</ul>
