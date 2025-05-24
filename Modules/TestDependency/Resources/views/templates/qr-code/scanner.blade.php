@extends('testdependency::base')
@section('content')
    @include('testdependency::layouts.breadcrumbs.qr-code')
    <livewire:testdependency::qr-code.scanner wire:key="testdependency::qr-code.scanner" />
@endsection
