@extends('testdependency::base')
@section('content')
    @include('testdependency::layouts.breadcrumbs.qr-code')
    @livewire('testdependency::qr-code.grid-list', key('testdependency::qr-code.grid-list'))
@endsection
