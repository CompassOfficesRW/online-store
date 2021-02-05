@extends('layouts.app')
@section('content')
<link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
<link href="{{ asset('css/products/table-custom.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script type="text/javascript" defer>
$(document).ready(function(){
    $.ajaxSetup({
      headers:{
        'X-CSRF-Token' : $("input[name=_token]").val()
      }
    });

    $('[data-toggle="tooltip"]').tooltip();
    //var actions = $("table td:last-child").html();
    var actions =       '<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>'+
                        '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>'+
                        '<a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>';
    // Append table with add row form on add new button click
    $(".add-new").click(function(){
        $(this).attr("disabled", "disabled");
        var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
                `<td hidden name="id"><input type="text" class="form-control" name="id" id="id"></td>
                <td name="fromqty"><input @error('fromqty') is-invalid @enderror type="text" class="form-control" name="fromqty" id="fromqty" value="1"></td>
                <td name="toqty"><input @error('toqty') is-invalid @enderror type="text" class="form-control" name="toqty" id="toqty" value="999"></td>
                <td name="salesprice"><input @error('salesprice') is-invalid @enderror type="text" class="form-control" name="salesprice" id="salesprice" value="0"></td>`+
            '<td>' + actions + '</td>' +
        '</tr>';
        $("table").append(row);
        $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
    // Add row on add button click
    $(document).on("click", ".add", function(){
        var empty = false;
        var input = $(this).parents("tr").find('input[type="text"]');
        var json = {};
        input.each(function(){
            if( (!$(this).val()
            ||  $(this).val() == 0)
            &&  $(this).attr('name') != 'id'){
                $(this).addClass("error");
                $(this).parents("td").append('<p>error</p>');
                empty = true;
            } else{
                $(this).removeClass("error");
                // create json message
                console.log($(this).attr('name'));
                json[$(this).attr('name')] = $(this).val();
            }
        });
        if(!empty)
        {
            if(json['id'] != "")
            {
                var url ='{{ route('prices.update', ['price_id'=>':id'])}}';
                url = url.replace(':id', json['id']);
                // update
                $.ajax({
                    type: "post",
                    url: url,
                    data: json,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data){
                        var errors = data.responseJSON;
                        empty = true;
                    }
                });
            }
            else {
                // create
                $.ajax({
                    type: "post",
                    url: '{{ route('prices.create', ['batch_id'=>$batch->id])}}',
                    data: json,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data){
                        var errors = data.responseJSON;
                        empty = true;
                    }
                });
            }
        }
        $(this).parents("tr").find(".error").first().focus();
        if(!empty){
            input.each(function(){
                $(this).parent("td").html($(this).val());
            });
            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-new").removeAttr("disabled");
        }
    });
    // Edit row on edit button click
    $(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
            $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '" name="' + $(this).attr('name') + '">');
        });
        $(this).parents("tr").find(".add, .edit").toggle();
        $(".add-new").attr("disabled", "disabled");
    });
    // Delete row on delete button click
    $(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
        $(".add-new").removeAttr("disabled");
    });
});
</script>
<div class="container">
    <div class="row">
        <h1>Prices - {{ $product->name }} - {{ $batch->name }}</h1>
    </div>
    <div class="row">
        @csrf
        <div class="form-group">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Prices</h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                </div>
            </div>
            <table class="table-striped table" name="batch">
                <thead>
                    <tr>
                        <th scope='col' hidden>ID</th>
                        <th scope="col">From qty</th>
                        <th scope="col">To qty</th>
                        <th scope="col">Sales price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($prices as $price)
                    <tr>
                        <td hidden name="id">{{ $price->id }}</td>
                        <td name="fromqty">{{ $price->fromqty }}</td>
                        <td name="toqty">{{ $price->toqty }}</td>
                        <td name="salesprice">{{ $price->salesprice }}</td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    @endforeach
                    <!-- <tr>
                        <td>John Doe</td>
                        <td>Administration</td>
                        <td>(171) 555-2222</td>
                        <td>
							<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
