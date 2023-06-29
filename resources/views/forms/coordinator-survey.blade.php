<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('dashboardPublic/img/favicon.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    <title>Rate Mentor System/Coordinator Page</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            /*background-color: #F4F4F4;*/
            justify-content: center;
            align-items: center;
            height: 100vh;
            max-width: 800px;
            margin: 0 auto;
        }

        #dynamic-form {
            background-color: #FFFFFF;
            border-style: solid;
            border-color: #0000;
        }

        .thName {
            background-color: #0000;
            border-style: solid;
            border-top-color: lightgrey;
            border-bottom-color: #0000;
        }

        .ratings i {
            color: #cecece;
            font-size: 32px;
        }

        .rating-color {
            color: #fbc634 !important;
        }

        .small-ratings i {
            color: #cecece;
        }

        table {
            border-collapse: collapse;
        }

        td, th, tr {
            border: none;
        }

        .btn-color-ch:hover {
            color: black;
            background-color: #F7C049;
            border-radius: 50px;
            border-color: #F7C049;
            font-weight: bold;
        }
        .fa-angle-left:hover{
            color: #F7C049;
            font-weight: bold;
        }
        .pull-left {
            display: flex;
            align-items: center;
        }

        .pull-left a {
            text-decoration: none;
            color: black;
            border-radius: 50px;
            bs-link-hover-color: #F7C049;
            margin-right: 10px; /* Adjust the margin as needed */
        }

        .pull-left h3 {
            margin: 0;
        }

        .dynamic-topic {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 20px;
        }
        td {
            padding-left: 10px;
            font-size: 18px;
        }
        .border-bottom-input {
            border: none;
            border-bottom: 1px solid #000;
            transition: border-bottom-color 0.3s;
            width: 90%;
        }

        .border-bottom-input:focus {
            outline: none;
            border-bottom-color: #F7C049;
            border-width: 1px;
        }

    </style>
</head>
<body>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="d-flex align-items-center" style="margin-left: -200px;margin-top:20px;margin-bottom: -20px">
            @canany(['Show forms','Show enterprise forms'])
            <a style="border-radius: 50px; color: black; bs-link-hover-color: #F7C049" href="{{ url('forms/index') }}">
                <i class="fas fa-angle-left" style="margin-right: 20px"></i>
            </a>
            @endcan
            <h2 class="ml-3">{{$formName}} Form</h2>
        </div>
    </div>
</div>
<br><br>
<div class="container">
    <form action="{{ url('evaluation/store/'.$id) }}" id="dynamic-form" method="POST">
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
        <div class="row" id="topics-container">
            @foreach ($formData as $surveyModel)
                <div class="col-12">
                    <table class="table table-bordered dynamic-topic">
                        <thead>
                        <tr class="thName">
                            <th style="border:none;text-align: left;color: #F7C049;font-size: 24px; padding-left: 10px"
                                ;><i class="fas fa-square"
                                     style="margin-right: 5px"></i> {{ $surveyModel['pages'][0]['name'] }}</th>
                        </tr>
                        </thead>

                        <tbody style="margin-left: 20px">
                        @php
                            $counter = 1;
                        @endphp

                        @foreach($surveyModel['pages'][0]['elements'] as $questionIndex => $question)
                            <tr>
                                <td style="font-weight: bold"><span style="color: #f1a417">{{ $questionIndex + 1 }}. </span> {{ $question['title'] }}</td>
                            </tr>

                            <tr>
                                <td>
                                    @if($question['type'] == 'radiogroup')
                                        @foreach($question['choices'] as $choice)
                                            <input type="radio" name="{{ $question['name'] }}" value="{{ $choice }}"
                                                   class="radio-choice">
                                            {{ $choice }}
                                            <br>
                                        @endforeach
                                    @elseif($question['type'] == 'checkbox')
                                        @foreach($question['choices'] as $choice)
                                            <input type="checkbox" name="{{ $question['name'] }}" value="{{ $choice }}">
                                            {{ $choice }}
                                            <br>
                                        @endforeach
                                    @elseif($question['type'] == 'rating')
                                        <div class="rating-question">
                                            <input type="hidden" name="{{ $question['name'] }}" value="0">

                                            <div class="stars">
                                                <i class="fa fa-star" data-rating="{{$question['name']}}-1"></i>
                                                <i class="fa fa-star" data-rating="{{$question['name']}}-2"></i>
                                                <i class="fa fa-star" data-rating="{{$question['name']}}-3"></i>
                                                <i class="fa fa-star" data-rating="{{$question['name']}}-4"></i>
                                                <i class="fa fa-star" data-rating="{{$question['name']}}-5"></i>
                                            </div>
                                        </div>
                                    @else
                                        <input type="text" name="{{ $question['name'] }}" class="border-bottom-input">
                                    @endif
                                    <br><br> <!-- Add a line break after each question -->
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <br><br>
                </div>
                @endforeach
                </tbody>
        </div>
        <button type="button" class="btn btn-outline-success btn-block btn-color-ch" id="save-button"
                style="background-color: #F7C049; border-radius: 50px;border-color:#F7C049;color: black">
            <i class="fas fa-check" style="margin-right: 5px"></i>Save
        </button>
    </form>
</div>
<script>


    $(document).ready(function () {
        /**
         * rating styling and value
         */

            // Set rating questions and color
        var ratingQuestions = document.querySelectorAll('.rating-question');
        var ratingColor = 'gold';

        // Fill stars function
        function fillStars(stars, index) {
            rating = index + 1;
            for (let i = 0; i < stars.length; i++) {
                if (i <= index) {
                    stars[i].style.color = ratingColor;
                } else {
                    stars[i].style.color = '';
                }
            }
        }

        function emptyStars(stars) {
            for (let i = 0; i < stars.length; i++) {
                if (stars[i].getAttribute('data-selected') === 'true') {
                    stars[i].style.color = ratingColor;
                } else {
                    stars[i].style.color = '';
                }
            }
        }


        // Initialize rating system
        function initRatingSystem(ratingQuestion) {
            var stars = ratingQuestion.querySelectorAll('.stars i');
            let starClicked = false;
            let rating = 0;

            stars.forEach((star, index) => {
                star.addEventListener('mouseenter', () => {
                    fillStars(stars, index);
                });
                star.addEventListener('mouseleave', () => {
                    emptyStars(stars);
                });
                star.addEventListener('click', () => {
                    rating = index + 1;
                    starClicked = true;

                    // set rating value to the hidden input
                    $(ratingQuestion).children('input').val(rating)

                    // Save selected rating to data attribute
                    stars.forEach((star, index) => {
                        if (index < rating) {
                            star.setAttribute('data-selected', 'true');
                        } else {
                            star.setAttribute('data-selected', 'false');
                        }
                    });
                });
            });

            // Reset stars on mouseleave of the question container
            ratingQuestion.addEventListener('mouseleave', () => {
                emptyStars(stars);
                rating = 0;
                starClicked = false;
            });
        }

        // Fill stars with selected rating on page load
        function fillStarsOnLoad(ratingQuestion) {
            const stars = ratingQuestion.querySelectorAll('.stars i');
            const rating = parseFloat(ratingQuestion.dataset.rating);

            if (!isNaN(rating) && rating > 0 && rating <= 5) {
                fillStars(stars, rating - 1);
            }
        }

        // Initialize rating systems and fill stars on page load for all rating questions
        ratingQuestions.forEach((ratingQuestion) => {
            initRatingSystem(ratingQuestion);
            fillStarsOnLoad(ratingQuestion);
        });


        /**
         * Struct evaluation result and save it
         */

        $('#save-button').on('click', function () {
            var formData = {!! json_encode($formData) !!};
            // console.log(formData)

            var results = [];

            for (var index in formData) {
                var surveyModel = formData[index]
                var topicName = surveyModel.pages[0].name;
                var questions = surveyModel.pages[0].elements;

                for (var i = 0; i < questions.length; i++) {
                    var question = questions[i];
                    var answer = null;

                    if (question.type == 'text') {
                        answer = $(`#dynamic-form input[name="${question.name}"]`).val();
                        if (!answer) answer = '';
                    } else if (question.type == 'rating') {
                        answer = parseFloat($(`#dynamic-form input[name="${question.name}"]`).val());
                        if (!answer) answer = 0;
                    } else if (question.type == 'radiogroup') {
                        answer = $(`#dynamic-form input[name="${question.name}"]:checked`).val();
                        if (!answer) answer = null;
                    } else if (question.type == 'checkbox') {
                        answer = $(`#dynamic-form input[name="${question.name}"]:checked`).map(function () {
                            return $(this).val();
                        }).get();
                        if (!answer) answer = [];
                    }

                    questions[i].answer = answer;
                }

                results.push({
                    name: topicName,
                    questions: questions
                })
            }

            console.log(results)
            $.ajax({
                url: '/evaluation/store/' + "{{$id}}",
                type: 'POST',
                // contentType: 'application/json',
                data: {resultsJson: JSON.stringify(results), _token: "{{ csrf_token() }}"},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                }
            });
        });
    })
</script>

</body>
</html>
