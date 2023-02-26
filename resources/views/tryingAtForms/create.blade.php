<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 Add/Remove Multiple Input Fields Example</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
        }
    </style>
</head>
<body>


// الصفحة هاي فقط للتجارب عليها
<div class="container">
    <form action="{{ url('store-input-fields') }}" id="dynamic-form" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        <table class="table table-bordered" name="addMoreTopic[0][topic]" class="form-control" id="dynamic-topic"/>
        <thead>
        <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
        </thead><button type="button" name="add" id="dynamic-add-topic" class="btn btn-outline-primary">Add Topic</button></thead>

        <tr>
            <th>Topic</th>
            <th>Action</th>
        </tr>
        <tfoot><td><button type="button" name="add" id="dynamic-question" class="btn btn-outline-primary">Add Question</button></td></tfoot>
        <button type="submit" class="btn btn-outline-success btn-block">Save</button>
    </form>
</div>
</body>
<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript -->
<script type="text/javascript">
    var topic = 0;
    var i = 0;
    $("#dynamic-add-topic").on('click' , function () {
        ++topic;
        var t = prompt("Please enter your topic");
        $("#dynamic-form").append('<table class="table table-bordered" name="addMoreTopic[' + topic + '][topic]" class="form-control" id="dynamic-topic"/><tr><th>Topic</th><th>Action</th></tr><tfoot><td><button type="button" name="add" id="dynamic-question" class="btn btn-outline-primary">Add Question</button></td></tfoot>' );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });

    $("#dynamic-question").on('click',function () {
        ++i;
        $("#dynamic-topic").append('<tr><td><input type="text" name="addMoreInputFields[' + i + '][question]" placeholder="Enter question" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();

    });


</script>
