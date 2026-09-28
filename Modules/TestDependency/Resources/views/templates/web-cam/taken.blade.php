@extends('testdependency::base')
@section('content')
{{--    @include('testdependency::layouts.breadcrumbs.qr-code')--}}
    <livewire:testdependency::web-cam.taken wire:key="testdependency::web-cam.taken" />
@endsection
