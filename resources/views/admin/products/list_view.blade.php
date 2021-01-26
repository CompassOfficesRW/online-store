@extends('layouts.app')
@section('content')
<link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <h1>Products overview</h1>
    </div>
    <div class="row py-4">
        <a href="create" class="btn btn-primary">New <i class="fas fa-sparkles"></i></a>
    </div>
    <div class="row">
        <div class="col">
            <table class="table-striped">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <base href="products/"/>
                        <a href="{{$product->id}}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                        <a href="{{$product->id}}/edit" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        <a href="{{$product->id}}/delete" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
