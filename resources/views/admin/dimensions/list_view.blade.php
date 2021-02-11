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
                    '<td hidden><input type="text" class="form-control" name="id" id="id"></td>' +
                    '<td><input type="text" class="form-control" name="name" id="name"></td>' +
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
                var url ='{{ route('dimensions.update', ['dim_id'=>':id'])}}';
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
                    url: '{{ route('dimensions.create', ['batch_id'=>$batch->id])}}',
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
        var id = $(this).parents("tr").find('td[name="id"]');
        var url ='{{ route('dimensions.delete', ['dim_id'=>':id'])}}';
        url = url.replace(':id', id.html());
        var $tr = $(this).closest('tr');
        // delete
        $.ajax({
            type: "post",
            url: url,
            data: '',
            success: function(data) {
                console.log(data);
                // success = true;
                $tr.find('td').fadeOut(1000,function(){
                    $tr.remove();
                });
            },
            error: function(data){
                var errors = data.responseJSON;
                console.log(errors);
            }
        });
    });
});
</script>
<div class="container">
    <div class="row">
        <h1>Dimensions - {{ $product->name }} - {{ $batch->name }}</h1>
    </div>
    <div class="row">
        @csrf
        <div class="form-group">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Dimensions</h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                </div>
            </div>
            <table class="table-striped table" name="batch">
                <thead>
                    <tr>
                        <th scope='col' hidden>ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($dimensions as $dimension)
                    <tr>
                        <td hidden name="id">{{ $dimension->id }}</td>
                        <td name="name">{{ $dimension->name }}</td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            @if ($dimension->id != "")
                                <a href="/dimensions/{{$batch->id}}/values/{{$dimension->id}}" class="dimensionvalue" title="Dimension values" data-toggle="tooltip"><i class="material-icons">arrow_circle_up</i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
