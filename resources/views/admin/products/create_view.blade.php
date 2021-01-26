@extends('layouts.app')
@section('content')
<link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <h1>Product create</h1>
    </div>
    <div class="row">
        <form action="/products/create" method="post" class="col">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Please fix the following errors
                </div>
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name', '') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <input type="button" name="batch-new" value="New" class='btn btn-primary'>
                <table class="table-striped" name="batch">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id='batch-tbody'>
                        <tr>
                            <input type="hidden" name="data[batch][id]" value="1">
                            <td><input type="text" name="data[batch][name]" value="" ></td>
                            <td>
                                <a href="#" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                <a href="#" class="btn btn-primary" name="batch-add-price">Add price</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('a[name="batch-add-price"]').bind("click", function(e){
        e.preventDefault();
        console.log('add price');
        $('#batch-tbody')
            .append($('<tr>')
                .append($('<td>')
                    .append($('<input>')
                        .attr({'type':'text','name':'data[batch][name]'})
                    )
                )
                .append($('<td>')
                    .append($('<a>')
                        .attr({'href':'#','class':"btn btn-danger"})
                        .append($('<i>')
                            .attr({'class':"far fa-trash-alt"})
                        )
                    )
                    .append($('<a>')
                        .attr({'href':'#','class':"btn btn-primary",'name':"batch-add-price"})
                        .text('Add price').bind("click", function(e){
                            e.preventDefault();
                        })
                    )
                )
            )
    });
</script>
@endsection
