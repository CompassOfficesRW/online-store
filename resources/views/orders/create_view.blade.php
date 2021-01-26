@extends('layouts.app')
@section('content')
    <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="/customers/create" class="btn btn-primary mx-2">New customer</a>
                <select class="selectpicker" data-live-search="true" title="Choose one of the following...">
                    @foreach($customers as $customer)
                        <option data-tokens="{{ $customer->mobile }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
@endsection
