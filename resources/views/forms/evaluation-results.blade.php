@extends('layouts.system-layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a style="border-radius: 50px; color: black; bs-link-hover-color: #F7C049"
                   href="{{ url('forms/index') }}">
                    <i class="fas fa-angle-left"></i>
                </a>
                <h3>Form Results</h3>
            </div>
        </div>
    </div>
    <br><br>

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
                    <h3 class="mb-0" style="color: #f1a417; margin-left: 15px">{{ $result->form->name }}</h3><br>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th><span style="color: #f1a417">#</span> Topic Name</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th style="border: none"></th>
                            <th>Score</th>
                        </tr>
                        @foreach ($result->result_json['form'] as $section)
                            <tr>
                                <td rowspan="{{ count($section['questions']) + 1 }}"><span style="color: #f1a417">{{ ++$i . ".   " }}</span>{{ $section['name'] }}</td>
                            </tr>
                            @foreach ($section['questions'] as $question)
                                <tr>
                                    <td>{{ $question['title'] }}</td>
                                    <td colspan="2">
                                        @if (is_array($question['answer']))
                                            @foreach ($question['answer'] as $answer)
                                                {{ $answer }}<br>
                                            @endforeach
                                        @else
                                            {{ $question['answer'] }}
                                        @endif
                                    </td>
                                    <td>{{ $question['credit'] }}</td>
                                </tr>
                            @endforeach
                            <tr style="height: 40px;"></tr>
                            <tr style="height: 20px;"></tr>
                        @endforeach
                        <tr>
                            <td style="border: none"></td>
                            <td colspan="3" align="right" style="border: 1px solid black;"><strong>Form Result
                                    Grade:</strong></td>
                            <td style="border: 1px solid black;">{{ number_format($result->result_json['result_grade'],4) }}%</td>
                        </tr>
                        <tr style="height: 40px; border: none"></tr>
                    </table>
                </div>
            </div>
            @php
                $totalGrade += $result->result_json['result_grade'];
            @endphp
        @endforeach

        @php
            $averageGrade = ($totalResults > 0) ? ($totalGrade / $totalResults) : 0;
        @endphp

        <div class="mt-4" style="border: 1px solid lightgrey; margin: 300px; margin-top: 40px; padding: 30px;">
            <h3 style="color: #f1a417; text-align: center; margin: 10px">
                Form Results Grade: {{ number_format($averageGrade, 4) }}%
            </h3>
        </div>

    @else
        <p>No evaluation results found.</p>
    @endif
@endsection
