@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $formName }} Form</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('forms/index') }}"> Browse Forms </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>User_id</th>
            <th>Topic Name</th>
            <th>Topic's Questions text & it's Score</th>
            <th>Topic's Total Score</th>
        </tr>

        @foreach ($evaluationResults as $key => $evaluationResult)
            @php
                $resultJson = $evaluationResult->result_json;

                if (is_array($resultJson)) {
                } else {
                  $resultJson = json_decode($resultJson, true);
                  if ($resultJson === null) {
                    continue;
                  }
                }

                $topics = $resultJson['topics'];
            @endphp

            @foreach ($topics as $topic)
                @php
                    $topicName = $topic['name'];
                    $topicTotalScore = $topic['topicTotalScore'];
                    $elements = $topic['elements'];
                    $questionScores = [];
                @endphp

                @foreach ($elements as $element)
                    @php
                        $questionText = $element['questionText'];
                        $scores = isset($element['elementsScore']) ? $element['elementsScore'] : [];
                        $questionScore = is_array($scores) ? array_sum($scores) : $scores;
                        $questionAnswers = implode(', ', $element['questionAnswers']);

                        $questionScores[] = [
                            'text' => $questionText,
                            'score' => $questionScore,
                            'answers' => $questionAnswers,
                             ];
                    @endphp
                @endforeach

                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $evaluationResult->user_id }}</td>
                    <td>{{ $topicName }}</td>
                    <td>
                        @foreach ($questionScores as $questionScore)
                            {{ $questionScore['text'] }}:<br> answers: {{ $questionScore['answers'] }} <br>
                            Score: {{ $questionScore['score'] }}<br><hr>
                        @endforeach
                    </td>
                    <td>{{ $topicTotalScore }}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
@endsection
