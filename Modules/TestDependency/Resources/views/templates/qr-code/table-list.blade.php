@extends('testdependency::base')
@section('content')
    @include('testdependency::layouts.breadcrumbs.qr-code')
    <livewire:testdependency::qr-code.table-list wire:key="testdependency::qr-code.table-list" />
@endsection
