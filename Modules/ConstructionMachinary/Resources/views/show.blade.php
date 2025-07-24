@extends('constructionmachinary::layouts.master')

@section('title','Into Page')

@section('content')

    <div x-data="{category:@js($category)}">

        <h1 x-text="JSON.stringify(category)"></h1>

    </div>


@endsection
