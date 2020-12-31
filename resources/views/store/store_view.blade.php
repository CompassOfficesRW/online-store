@extends('layouts.app')
@section('content')
    @foreach ($products as $product)
        <p>{{ $product->name }}</p>
        <img src="/storage/images/{{$product->image}}">
    @endforeach
@endsection
