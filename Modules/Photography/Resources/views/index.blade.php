@extends('photography::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('photography.name') !!}
    </p>
@endsection
