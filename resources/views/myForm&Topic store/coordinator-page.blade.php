<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coordinator Form Page</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

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
                        <tr>
                            <th colspan="2" style="text-align: center;">{{ $surveyModel['pages'][0]['name'] }}</th>
                        </tr>
                        </thead>

                        <tbody id="surveyContainer{{ $loop->index }}">
                        @foreach($surveyModel['pages'][0]['elements'] as $questions)
                            <tr>
                                <td>
                                    {{ $questions['name'] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if($questions['type'] == 'radiogroup')
                                        {{-- if question type is radio group --}}
                                        @foreach($questions['choices'] as $choice)
                                            <input type="radio" name="{{ $questions['name'] }}" value="{{ $choice }}">
                                            {{ $choice }}
                                            <br>
                                        @endforeach
                                    @elseif($questions['type'] == 'checkbox')
                                        {{-- if question type is checkbox --}}
                                        @foreach($questions['choices'] as $choice)
                                            <input type="checkbox" name="{{ $questions['name'] }}[]"
                                                   value="{{ $choice}}">
                                            {{ $choice }}
                                            <br>
                                        @endforeach
                                    @elseif($questions['type'] == 'rating') {{-- if question type is rating --}}
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <input type="radio" name="rating" value="{{ $i }}" id="{{ $questions['name'] }}-{{ $i }}">
                                            <span class="star"></span>
                                        @endfor
                                    </div>
                                    @else
                                        {{-- if question type is text input --}}
                                        <input type="text" name="{{ $questions['name'] }}">
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
</body>
</html>
