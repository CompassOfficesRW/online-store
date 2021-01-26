@extends('layouts.app')
@section('content')
    <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="/customers/create" class="btn btn-primary mx-2">New customer</a>
                <select class="selectpicker" data-live-search="true">
  <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
  <option data-tokens="mustard">Burger, Shake and a Smile</option>
  <option data-tokens="frosting">Sugar, Spice and all things nice</option>
</select>


            </div>
        </div>
    </div>
@endsection
