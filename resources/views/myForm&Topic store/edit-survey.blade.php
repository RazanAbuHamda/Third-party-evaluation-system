<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 Add/Remove Multiple Input Fields Example</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/survey-jquery/modern.min.css" type="text/css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .container {
            max-width: 600px;
        }
    </style>
</head>
<body>

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
            <form action="{{ url('forms/update/'.$id) }}" id="dynamic-form" method="POST">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <button type="button" name="add" id="dynamic-add-topic" class="btn btn-outline-primary">Add
                            Topic
                        </button>

                        <button type="button" class="btn btn-outline-success btn-block" id="save-button">Save</button>
                    </div>
                </div>
                <br>

                <div class="row" id="topics-container">
                    <?php $editedTopicId = 0; ?>
                    @foreach($formData as $value)
                        @foreach($value['pages'] as $value2)
                            <div class="col-12">
                                <table class="table table-bordered" data-topic="{{$editedTopicId}}"
                                       data-topic-name="{{$value2['name']}}" id="topic[{{$editedTopicId}}]"
                                       class="dynamic-topic">
                                    <thead>
                                    <tr>
                                        <th colspan="2" style="text-align: center;">{{$value2['name']}}</th>
                                    </tr>
                                    </thead>

                                    <tbody id="editedsurveyContainer{{$editedTopicId}}">
                                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                    <script type="text/javascript"
                                            src="https://unpkg.com/survey-jquery@1.9.77/survey.jquery.js"></script>

                                    <script>
                                        // Retrieve the JSON representation of the saved survey from the database
                                        var elements_{{$editedTopicId}} = {!! json_encode($value2['elements']) !!};
                                        if (elements_{{$editedTopicId}}) {
                                            var surveyElements = {
                                                pages: [{
                                                    elements: elements_{{$editedTopicId}}
                                                }]
                                            };
                                            // Create a new survey object with the saved data
                                            var survey = new Survey.Model(surveyElements);
                                            var $j = jQuery.noConflict();
                                            $j("#editedsurveyContainer{{$editedTopicId}}").Survey({model: survey});
                                        } else {
                                            console.log('Error retrieving survey questions.');
                                        }

                                    </script>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <button type="button" class="btn btn-outline-primary dynamic-question"
                                                    data-bs-toggle="modal" data-bs-target="#addQuestionModal">Add
                                                Question
                                            </button>
                                            <button type="button" class="btn btn-outline-danger">Delete Topic</button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                                <?php $editedTopicId++; ?>
                        @endforeach
                    @endforeach


                    <!-- Modal -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="addQuestionModal"
                         aria-labelledby="addQuestionModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Question</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form id="addQuestionForm">
                                        <div class="form-group">
                                            <label>Type</label><br>
                                            <select name="type" class="form-control">
                                                <option value="text">Short Answer</option>
                                                <option value="rating">Rating</option>
                                                <option value="radiogroup">Choose One</option>
                                                <option value="checkbox">Choose Many</option>
                                            </select>
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label>Question Title</label>
                                            <input type="text" name="title" class="form-control">
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label>Question Text</label>
                                            <input type="text" name="question" class="form-control">
                                        </div>


                                        <div id="radioGroup" style="display: none;">
                                            <hr>
                                            <br>
                                            <div class="form-group">
                                                <label>Options (comma separated)</label>
                                                <input type="text" name="radioOptions" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Correct Option</label>
                                                <input type="text" name="correctOption" class="form-control">
                                            </div>
                                        </div>


                                        <div id="checkboxGroup" style="display: none;">
                                            <hr>
                                            <br>
                                            <div class="form-group">
                                                <label>Number of options</label>
                                                <input type="number" name="checkboxOptionsNo" class="form-control"
                                                       style="max-width: 90%; display: inline-block;">
                                                <button type="button" id="addCheckboxOptions"><i>+</i></button>
                                            </div>
                                            <br>
                                            <div id="checkboxOptions">
                                                <!-- <div class="form-group">
                                                    <input type="text" name="checkboxOption[]" class="form-control" style="display: inline-block; max-width: 70%;" placeholder="Option">
                                                    <input type="number" name="checkboxWeight[]" class="form-control" style="display: inline-block; max-width: 25%;" placeholder="Weight">
                                                </div> -->
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <hr>
                                            <br>
                                            <label>Weight </label>
                                            <input type="number" name="weight" class="form-control">
                                        </div>
                                    </form>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="saveQuestion">Save</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                        </div>
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
<script type="text/javascript" src="https://unpkg.com/survey-jquery@1.9.77/survey.jquery.js"></script>


<!-- JavaScript -->
<script type="text/javascript">
    $(document).ready(function () {

        var formData = {!! json_encode($formData) !!};
        prompt(formData); // print formData to console
        var topicId = formData.length - 1;
        var surveyModels = formData;
        /**
         * Action of add topic
         */
        $('#dynamic-add-topic').on('click', function () {
            var topicName = prompt("Please enter topic name");

            if (topicName) {
                $('#topics-container').append('<div class="col-12"><table class="table table-bordered" data-topic=' + topicId + ' data-topic-name="' + topicName + '" id="topic[' + topicId + ']" class="dynamic-topic"><thead><tr><th colspan="2" style="text-align: center;">' + topicName + '</th></tr</thead><tbody id="surveyContainer' + topicId + '"></tbody><tfoot><tr><td colspan="2"><button type="button" class="btn btn-outline-primary dynamic-question" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Add Question</button> <button type="button" class="btn btn-outline-danger">Delete Topic</button></td></tr></tfoot></table></div>');
            }

            surveyModels[topicId] = {
                pages: [
                    {
                        name: topicName,
                        elements: []
                    }
                ]
            };

            ++topicId;
        });


        /**
         * Action of add question
         */

        $('#dynamic-form').on('click', '.dynamic-question', function () {
            var topicId = $(this).parent().parent().parent().parent().data('topic');
            var topicName = $(this).parent().parent().parent().parent().data('topic-name');
            $('#addQuestionModal').data('topic', topicId);
            $('#addQuestionModal').data('topic-name', topicName);
        });


        /**
         * Configure modal
         */

        $('#saveQuestion').on('click', function () {
            var questionId = new Date().getTime();
            var topicId = $('#addQuestionModal').data('topic');
            var topicName = $('#addQuestionModal').data('topic-name');

            var questionType = $('#addQuestionForm [name="type"]').val();
            var questionTitle = $('#addQuestionForm [name="title"]').val();
            var questionText = $('#addQuestionForm [name="question"]').val();
            var questionWeight = $('#addQuestionForm [name="weight"]').val();

            var newQuestionJson = {
                type: questionType,
                name: questionTitle,
                title: questionText,
                weight: questionWeight
            };

            if (questionType == 'radiogroup') {
                var questionChoises = $('#addQuestionForm [name="radioOptions"]').val();
                var correctAnswer = $('#addQuestionForm [name="correctOption"]').val();
                newQuestionJson.choices = questionChoises.split(',');
                newQuestionJson.correctAnswer = correctAnswer;
            } else if (questionType == 'checkbox') {
                var questionChoises = [];
                var questionWeights = [];

                $('#addQuestionForm [name="checkboxOption[]"]').each(function () {
                    questionChoises.push($(this).val());
                });

                $('#addQuestionForm [name="checkboxWeight[]"]').each(function () {
                    questionWeights.push($(this).val());
                });

                newQuestionJson.choices = questionChoises;
                newQuestionJson.choicesWeights = questionWeights;

            }

            var surveyJsonElements = surveyModels[topicId].pages[0].elements;
            surveyJsonElements.push(newQuestionJson);
            surveyModels[topicId].pages[0].elements = surveyJsonElements;

            const survey = new Survey.Model(surveyModels[topicId]);
            $(function () {
                $("#surveyContainer" + topicId).Survey({model: survey});
            });


            // clear modal
            $('#addQuestionForm [name="type"]').val('text');
            $('#addQuestionForm [name="title"]').val('');
            $('#addQuestionForm [name="question"]').val('');
            $('#addQuestionForm [name="weight"]').val('');
            $('#addQuestionForm [name="radioOptions"]').val('');
            $('#addQuestionForm [name="correctOption"]').val('');
            $('[name="checkboxOptionsNo"]').val('');
            $('#checkboxOptions').empty();
            $('#checkboxGroup').hide();
            $('#radioGroup').hide();

            $('#addQuestionModal').modal('toggle');

            console.log(surveyModels);
        });


        $('#addQuestionForm [name="type"]').on('change', function () {
            var questionType = $(this).val();

            if (questionType == 'radiogroup') {
                $('#radioGroup').show();
                $('#checkboxGroup').hide();
            } else if (questionType == 'checkbox') {
                $('#checkboxGroup').show();
                $('#radioGroup').hide();
            } else {
                $('#checkboxGroup').hide();
                $('#radioGroup').hide();
            }
        });


        $('#addCheckboxOptions').on('click', function () {
            var checkboxOptionsNo = $('[name="checkboxOptionsNo"]').val();

            for (i = 0; i < checkboxOptionsNo; i++) {
                $('#checkboxOptions').append('<div class="form-group"><input type="text" name="checkboxOption[]" class="form-control" style="display: inline-block; max-width: 70%;" placeholder="Option"><input type="number" name="checkboxWeight[]" class="form-control" style="display: inline-block; max-width: 25%;" placeholder="Weight %"></div>');
            }
        });

        $('#save-button').on('click', function () {
            var formJson = JSON.stringify(surveyModels);

            // Send the AJAX request with the formJson data
            $.ajax({
                url: '/forms/update/' + "{{$id}}",
                type: 'POST',
                data: {formJson: formJson, _token: "{{ csrf_token() }}"},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                }
            });
        });

    });


</script>
