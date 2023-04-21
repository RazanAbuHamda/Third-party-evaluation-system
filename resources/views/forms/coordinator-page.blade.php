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
        <div class="row" id="topics-container">
            @foreach ($formData as $surveyModel)
                <div class="col-12">
                    <table class="table table-bordered dynamic-topic" data-topic="{{ $loop->index }}"
                           data-topic-name="{{ $surveyModel['pages'][0]['name'] }}" id="{{ $loop->index }}">
                        <thead>
                        <tr class="thName">
                            <th colspan="2" style="font-size: 20px;text-align: center;">{{ $surveyModel['pages'][0]['name'] }}</th>
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
                                            <input type="radio" name="{{ $questions['name'] }}" value="{{ $choice }}">
                                            {{ $choice }}
                                            <br>
                                        @endforeach
                                        <hr>
                                    @elseif($questions['type'] == 'checkbox')
                                        {{-- if question type is checkbox --}}
                                        @foreach($questions['choices'] as $choice)
                                            <input type="checkbox" name="{{ $questions['name'] }}[]"
                                                   value="{{ $choice}}">
                                            {{ $choice }}
                                            <br>
                                        @endforeach
                                        <hr>
                                    @elseif($questions['type'] == 'rating')
                                        {{-- if question type is rating --}}
                                            <div class="small-ratings">
                                                <i class="fa fa-star rating-color"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        <hr>
                                    @else
                                        {{-- if question type is text input --}}
                                        <input type="text" name="{{ $questions['name'] }}">
                                        <hr>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-outline-success btn-block">Save</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        const stars = document.querySelectorAll('.small-ratings i');

        function fillStars(index) {
            for (let i = 0; i <= index; i++) {
                stars[i].classList.add('rating-color');
            }
        }

        function emptyStars() {
            for (let i = 0; i < stars.length; i++) {
                stars[i].classList.remove('rating-color');
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
                alert(`You rated this ${index + 1} stars!`);
            });
        });
    });

</script>

</body>
</html>
