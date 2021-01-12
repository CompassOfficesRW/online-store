@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h1>Delete - {{ $customer->name }}</h1>
    </div>
    <div class="row py-4">
        <form action="/customers/{{ $customer->id }}/delete" method="post" class="col">
            @csrf
            <div class="row">
                <pre>Do you confirm to delete customer {{ $customer->name }}?</pre>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-danger mx-2">Delete</button>
                <a href="/customers" class="btn btn-primary mx-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
