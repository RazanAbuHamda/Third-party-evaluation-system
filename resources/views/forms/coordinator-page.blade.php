<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coordinator Form Page</title>
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
            background-color: #eef3f4;
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
            background-color: #eef3f4;
            border-style: solid;
            border-color: #0c0c0c;
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
    </style>
</head>
<body>

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
            <script>
                var topicId = 0;
                var results = [];
                var total = 0;
            </script>
            @foreach ($formData as $surveyModel)
                @php $questionId = 0; @endphp

                <script>
                    if (typeof results === "undefined") {
                        var results = {};
                        topicId = 0;
                    } else {
                        topicId = Object.keys(results).length;
                    }
                    results[topicId] = {
                        topics: [
                            {
                                name: "{{ $surveyModel['pages'][0]['name'] }}",
                                elements: {},
                                topicTotalScore: 0
                            }
                        ]
                    };
                    results[topicId].topics[0].elements[{{$questionId}}] = {
                        questionText: " ",
                        questionAnswers: [],
                        elementsScore: [],
                    };
                </script>
                <div class="col-12">
                    <table class="table table-bordered dynamic-topic" data-topic="{{ $loop->index }}"
                           data-topic-name="{{ $surveyModel['pages'][0]['name'] }}" id="{{ $loop->index }}">
                        <thead>
                        <tr class="thName">
                            <th colspan="2"
                                style="font-size: 20px;text-align: center;">{{ $surveyModel['pages'][0]['name'] }}</th>
                        </tr>
                        </thead>

                        <tbody id="surveyContainer{{ $loop->index }}">
                        @php
                            $counter = 1;
                        @endphp

                        @foreach($surveyModel['pages'][0]['elements'] as $questionIndex => $questions)
                            <tr>
                                <td style="font-weight: bold">{{ $counter }}. {{ $questions['name'] }}</td>
                                @php
                                    $counter++;
                                @endphp
                                <script>
                                    results[topicId].topics[0].elements[{{$questionIndex}}] = {
                                        questionText: "{{ $questions['name'] }}",
                                        questionAnswers: []
                                    };
                                </script>
                            </tr>

                            <tr>

                                <td>

                                    @if($questions['type'] == 'radiogroup')
                                        {{-- if question type is radio group --}}
                                        @foreach($questions['choices'] as $choice)
                                            <input type="radio" name="{{ $questions['name'] }}" value="{{ $choice }}"
                                                   class="radio-choice">
                                            {{ $choice }}
                                            <br>
                                        @endforeach
                                        <script>
                                            var selectedValue = null;
                                            var radioButtons = document.getElementsByName("{{ $questions['name'] }}");
                                            for (var i = 0; i < radioButtons.length; i++) {
                                                radioButtons[i].addEventListener('click', function () {
                                                    selectedValue = this.value;
                                                    console.log(selectedValue !== null ? selectedValue : "No option selected");
                                                    if (selectedValue === "{{$questions['correctAnswer']}}") {
                                                        results[topicId].topics[0].topicTotalScore += {{ $questions['weight'] }};
                                                        results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore = results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore || [];
                                                        results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore.push({{ $questions['weight'] }});
                                                        results[topicId].topics[0].elements[{{$questionIndex}}].questionAnswers.push(selectedValue);
                                                    }
                                                });
                                            }
                                        </script>
                                        <hr>
                                    @elseif($questions['type'] == 'checkbox')
                                        {{-- if question type is checkbox --}}
                                        @php
                                            $totalCheckboxValues = array_sum($questions['choicesWeights']);
                                            $questionName = $questions['name'];
                                            $choicesWeights = json_encode($questions['choicesWeights']);
                                        @endphp
                                        @foreach($questions['choices'] as $index => $choice)
                                            <input type="checkbox" name="{{ $questionName }}@if($loop->last)[]@endif" value="{{ $choice }}">
                                            {{ $choice }}
                                            <br>
                                        @endforeach
                                        <script>
                                            var questionName = "{{ $questionName }}";
                                            var checkboxes = document.getElementsByName(questionName + "[]");
                                            var choicesWeights = {!! $choicesWeights !!}.map(parseFloat);

                                            for (var i = 0; i < checkboxes.length; i++) {
                                                checkboxes[i].addEventListener('click', function () {
                                                    var selectedValuesScore = 0;
                                                    var totalCheckboxValues = 0;
                                                    var selectedCheckboxValues = [];

                                                    for (var j = 0; j < checkboxes.length; j++) {
                                                        if (checkboxes[j].checked) {
                                                            selectedValuesScore += choicesWeights[j];
                                                            selectedCheckboxValues.push(checkboxes[j].value);
                                                        }
                                                        totalCheckboxValues += choicesWeights[j];
                                                    }

                                                    console.log(totalCheckboxValues);
                                                    console.log(selectedValuesScore > 0 ? selectedValuesScore : "No option selected");

                                                    if (selectedValuesScore > 0) {
                                                        var ans = (selectedValuesScore * {{ $questions['weight'] }}) / totalCheckboxValues;
                                                        results[topicId] = results[topicId] || {topics: [{topicTotalScore: 0}]};
                                                        results[topicId].topics[0].topicTotalScore += ans;
                                                        results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore = ans;
                                                        results[topicId].topics[0].elements[{{$questionIndex}}].questionAnswers = selectedCheckboxValues;
                                                    } else {
                                                        results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore = 0;
                                                        results[topicId].topics[0].elements[{{$questionIndex}}].questionAnswers = [];
                                                    }
                                                });
                                            }
                                        </script>
                                        <hr
                                    @elseif($questions['type'] == 'rating')
                                        {{-- if question type is rating stars--}}
                                        <div class="rating-question">
                                            <div class="stars">
                                                <i class="fa fa-star" data-rating="{{$questions['name']}}-1"></i>
                                                <i class="fa fa-star" data-rating="{{$questions['name']}}-2"></i>
                                                <i class="fa fa-star" data-rating="{{$questions['name']}}-3"></i>
                                                <i class="fa fa-star" data-rating="{{$questions['name']}}-4"></i>
                                                <i class="fa fa-star" data-rating="{{$questions['name']}}-5"></i>
                                            </div>
                                        </div>
                                        <hr>
                                        <script>
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
                                                        var questionCredit = ({{ $questions['weight'] }} * rating) / 5;
                                                        results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore = results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore || [];
                                                        results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore=questionCredit;
                                                        //اتأكذي من النتيحة الي بيحفظها هان
                                                        results[topicId].topics[0].topicTotalScore += questionCredit;

                                                        console.log(questionCredit);
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

                                        </script>
                                        </hr>

                                    @else
                                        {{-- if question type is short text --}}
                                        <input type="text" name="{{ $questions['name'] }}" id="my-input">
                                        <script>
                                            var shortText = document.getElementsByName("{{ $questions['name'] }}")[0];
                                            results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore = results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore || [];
                                            results[topicId].topics[0].elements[{{$questionIndex}}].elementsScore.push({{ $questions['weight'] }});
                                            //انتبهي هان ما بحفظ الفاليو تعت الانبوت
                                            results[topicId].topics[0].elements[{{$questionIndex}}].questionAnswers = shortText;
                                            results[topicId].topics[0].topicTotalScore += {{ $questions['weight'] }};
                                        </script>
                                        <hr>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </tbody>
                    </table>
                </div>
               <script> ++topicId;</script>
            @endforeach
        </div>
        <button type="button" class="btn btn-outline-success btn-block" id="save-button">Save</button>
    </form>
</div>
<script>


    $('#save-button').on('click', function () {
        var reultsJson = JSON.stringify(results);
        // Send the AJAX request with the reultsJson data
        $.ajax({
            url: '/evaluation/store/' + "{{$id}}",
            type: 'POST',
            data: {reultsJson: reultsJson, _token: "{{ csrf_token() }}"},
            dataType: 'json',
            success: function (response) {
                console.log(response);
            }
        });
    });
</script>

</body>
</html>
