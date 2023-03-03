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
    <br>
    <div class="container-fluid">

        <!-- status -->
        <div class="row">
            <div class="col-12">
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
            </div>
        </div>


        <!-- form -->
        <div class="row">
            <div class="col-12">
                <form action="{{ url('store-input-fields') }}" id="dynamic-form" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <button type="button" name="add" id="dynamic-add-topic" class="btn btn-outline-primary">Add Topic</button>

                            <button type="submit" class="btn btn-outline-success btn-block">Save</button>
                        </div>
                    </div><br>

                    <div class="row" id="topics-container">
                        <div class="col-12">
                           <table class="table table-bordered" data-topic=0 id="topic[0]" class="dynamic-topic">
                              <thead>
                                 <tr>
                                    <th colspan="2" style="text-align: center;">topicName</th>
                                 </tr>
                                 <tr>
                                    <th>Question</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>

                              </tbody>
                              <tfoot>
                                 <tr>
                                    <td colspan="2"><button type="button" class="btn btn-outline-primary dynamic-question">Add Question</button> <button type="button" class="btn btn-outline-danger">Delete Topic</button></td>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript -->
<script type="text/javascript">


    $(document).ready(function () {
        var topic = 0;

        $('#dynamic-add-topic').on('click', function () {
            var topicName = prompt("Please enter topic name");

            if (topicName) {
                $('#topics-container').append('<div class="col-12"><table class="table table-bordered" data-topic=' + topic + ' id="topic[' + topic + ']" class="dynamic-topic"><thead><tr><th colspan="2" style="text-align: center;">' + topicName + '</th></tr><tr><th>Question</th><th>Action</th></tr></thead><tbody></tbody><tfoot><tr><td colspan="2"><button type="button" class="btn btn-outline-primary dynamic-question">Add Question</button> <button type="button" class="btn btn-outline-danger">Delete Topic</button></td></tr></tfoot></table></div>');
            }

            ++topic;
        });



        $('#dynamic-form').on('click', '.dynamic-question', function () {
            var questionTxt = prompt("Please enter question text");
            var question = new Date().getTime();
            var topic = $(this).parent().parent().parent().parent().data('topic');
//form-div-div-div
            //The .data() method allows us to attach data of any type to DOM elements
            // in a way that is safe from circular references and therefore from memory leaks.
            if (questionTxt) {
                $(this).parent().parent().parent().parent().children('tbody').append('<tr data-question=' + question + ' id="question[' + topic + '][' + question + ']"><td>' + questionTxt + '</td><td><button type="button" class="btn btn-outline-danger">Delete Question</button></td></tr>');
                // children() method allows us to search through the children of these
                // elements in the DOM tree and construct a new jQuery object from the matching elements
            }
        });
    });


</script>
