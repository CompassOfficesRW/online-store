@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Customer Edit</h1>
        </div>
        <div class="row">
            <form action="/customers/{{ $customer->id }}/edit" method="post" class="col">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif
                <input type="text" name="id" value="{{ $customer-> id }}" hidden>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name', $customer->name) }}" readonly>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mediatype">Media type</label>
                    <select class="form-control @error('mediatype') is-invalid @enderror" name="mediatype" id="country" value="{{ old('mediatype',$customer->mediatype) }}">
                        @foreach ( $mediatypes as $mediatype)
                            <option value="{{ $mediatype }}">{{ \App\Enums\CustMediaType::getDescription($mediatype) }}</option>
                        @endforeach
                    </select>
                    @error('mediatype')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Mobile" value="{{ old('mobile',$customer->mobile) }}">
                    @error('mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mediaid">Media ID</label>
                    <input type="text" class="form-control @error('mediaid') is-invalid @enderror" id="mediaid" name="mediaid" placeholder="Media ID" value="{{ old('mediaid', $customer->mediaid) }}">
                    @error('mediaid')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
