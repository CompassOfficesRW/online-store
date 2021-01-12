@extends('layouts.app')
@section('content')
    <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
    <div class="container">
        <div class="row">
            <h1>Customer overview</h1>
        </div>
        <div class="row py-4">
            <a href="create" class="btn btn-primary">New <i class="fas fa-sparkles"></i></a>
        </div>
        <div class="row">
            <div class="col">
                <table class="table-striped">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Media type</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Media ID</th>
                        <th scope="col">Action</th>
                    </tr>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ \App\Enums\CustMediaType::getDescription(intval($customer->mediatype)) }}</td>
                        <td>{{ $customer->mobile }}</td>
                        <td>{{ $customer->mediaid }}</td>
                        <td>
                            <base href="customers/"/>
                            <a href="{{$customer->id}}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                            <a href="{{$customer->id}}/edit" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <a href="{{$customer->id}}/delete" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection
