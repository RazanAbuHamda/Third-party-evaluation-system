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
                <script>
                    ++topicId;//هان اسألي بتطلعلك بالأول null

                    results[topicId] = {
                        topics: [
                            {
                                name: "{{ $surveyModel['pages'][0]['name'] }}",
                                // elements:[],
                                elementsScore: [],
                                topicTotalScore: 0
                            }
                        ]
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

                        @foreach($surveyModel['pages'][0]['elements'] as $questions)
                            <tr>
                                <td style="font-weight: bold">{{ $counter }}. {{ $questions['name'] }}</td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
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
                                            var radioButtons = document.getElementsByName("{{ $questions['name'] }}");
                                            var selectedValue = null;
                                            for (var i = 0; i < radioButtons.length; i++) {
                                                radioButtons[i].addEventListener('click', function () {
                                                    selectedValue = this.value;
                                                    console.log(selectedValue !== null ? selectedValue : "No option selected");
                                                    if (selectedValue === "{{$questions['correctAnswer']}}") {
                                                        results[topicId].topics[0].topicTotalScore +=  {{ $questions['weight'] }};
                                                        //هان بيربط بين النصوص لما بدي أحط السكور تبع الاسئلة شوفيه قصته
                                                        results[topicId].topics[0].elementsScore +=  {{ $questions['weight'] }};
                                                    } else {
                                                        results[topicId].topics[0].elementsScore = 0;
                                                    }
                                                });
                                            }
                                        </script>

                                        <hr>
                                    @elseif($questions['type'] == 'checkbox')
                                        {{-- if question type is checkbox --}}
                                        @foreach($questions['choices'] as $choice)
                                            <input type="checkbox" name="{{ $questions['name'] }}"
                                                   value="{{ $choice }}">
                                            {{ $choice }}
                                            <br>
                                        @endforeach
                                        <script>
                                            var checkboxes = document.getElementsByName("{{ $questions['name'] }}");
                                            var choicesWeights = {!! json_encode($questions['choicesWeights']) !!}.map(function (x) {
                                                return parseInt(x);
                                            });

                                            for (var i = 0; i < checkboxes.length; i++) {
                                                var selectedValuesScore = 0;
                                                var totalCheckboxValues = 0;
                                                totalCheckboxValues += choicesWeights[i];
                                                checkboxes[i].addEventListener('click', function () {
                                                    selectedValuesScore = 0;

                                                    for (var j = 0; j < checkboxes.length; j++) {
                                                        if (checkboxes[j].checked) {
                                                            selectedValuesScore += choicesWeights[j];
                                                        }
                                                    }
                                                    console.log(totalCheckboxValues);
                                                    console.log(selectedValuesScore > 0 ? selectedValuesScore : "No option selected");

                                                    if (selectedValuesScore > 0) {
                                                        var ans =(selectedValuesScore * {{ $questions['weight'] }}) / totalCheckboxValues;
                                                        results[topicId].topics[0].elementsScore = ans;
                                                        results[topicId].topics[0].topicTotalScore += ans;
                                                    } else {
                                                        results[topicId].topics[0].elementsScore = 0;
                                                    }
                                                });

                                            }

                                            console.log("total = " + total);

                                        </script>
                                        <hr>
                                    @elseif($questions['type'] == 'rating')
                                        {{-- if question type is rating stars--}}
                                        <div class="small-ratings">
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <hr>
                                    @else
                                        {{-- if question type is short text --}}
                                        <input type="text" name="{{ $questions['name'] }} required">
                                        <script>//هان لازم تاكدي انه ما يعيطيه درجة الا لما يكون كاتب اشي اوك
                                            var shortText = document.getElementsByName("{{ $questions['name'] }}");
                                            results[topicId].topics[0].elementsScore.push("{{ $questions['weight'] }}");
                                            total += {{ $questions['weight'] }};
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
            @endforeach
            <script>
            </script>
        </div>
        <button type="button" class="btn btn-outline-success btn-block" id="save-button">Save</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        const stars = document.querySelectorAll('.small-ratings i');
        const ratingColor = 'gold';

        function fillStars(index) {
            for (let i = 0; i <= index; i++) {
                stars[i].style.color = ratingColor;
            }
        }

        function emptyStars() {
            for (let i = 0; i < stars.length; i++) {
                stars[i].style.color = '';
            }
        }

        stars.forEach((star, index) => {
            star.addEventListener('mouseenter', () => {
                fillStars(index);
            });
            star.addEventListener('mouseleave', () => {
                emptyStars();
            });
            star.addEventListener('click', () => {
                var stars = index;
                alert(`You rated this ${index + 1} stars!`);
                fillStars(stars);
            });
        });
    });
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
