@extends('layouts.system-layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Form Results</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('forms/index') }}">Browse Forms</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($evaluationResults && !$evaluationResults->isEmpty())
        @php
            $totalResults = count($evaluationResults);
            $totalGrade = 0;
        @endphp

        @foreach ($evaluationResults as $result)
            <div class="card mb-4">
                <br><br>
                <div class="card-header">
                    <h3 class="mb-0">{{ $result->form->name }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Topic Name</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th></th>
                            <th></th>
                            <th>Score</th>
                        </tr>
                        @foreach ($result->result_json['form'] as $section)
                            <tr>
                                <td rowspan="{{ count($section['questions']) + 1 }}">{{ $section['name'] }}</td>
                            </tr>
                            @foreach ($section['questions'] as $question)
                                <tr>
                                    <td>{{ $question['title'] }}</td>
                                    <td>
                                        @if (is_array($question['answer']))
                                            @foreach ($question['answer'] as $answer)
                                                {{ $answer }}<br>
                                            @endforeach
                                        @else
                                            {{ $question['answer'] }}
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $question['credit'] }}</td>
                                </tr>
                            @endforeach
{{--                            <tr>--}}
{{--                                <td colspan="6"><strong>Topic report</strong></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td></td>--}}
{{--                                <td colspan="3" align="right" style="border: 1px solid grey;"><strong>Topic Total--}}
{{--                                        Credit:</strong></td>--}}
{{--                                <td style="border: 1px solid black;">{{ $section['credit'] }}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td></td>--}}
{{--                                <td colspan="3" align="right" style="border: 1px solid grey;"><strong>Topic Total--}}
{{--                                        Weight:</strong></td>--}}
{{--                                <td style="border: 1px solid black;">{{ $section['weight'] }}</td>--}}
{{--                            </tr>--}}

                            <tr style="height: 40px;"></tr>
                            <tr style="height: 20px;"></tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td colspan="3" align="right" style="border: 1px solid black;"><strong>Form Result
                                    Grade:</strong></td>
                            <td style="border: 1px solid black;">{{ $result->result_json['result_grade'] }}%</td>
                        </tr>
                        <tr style="height: 40px;"></tr>
                    </table>
                    <hr>
                </div>
            </div>
            @php
                $totalGrade += $result->result_json['result_grade'];
            @endphp
        @endforeach

        @php
            $averageGrade = ($totalResults > 0) ? ($totalGrade / $totalResults) : 0;
        @endphp

        <div class="mt-4">
            <h3 align="right">Average Form Results Grade: {{ $averageGrade }}%</h3>
        </div>
    @else
        <p>No evaluation results found.</p>
    @endif
@endsection

