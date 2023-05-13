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
                            <th>Score</th>
                        </tr>
                        @foreach ($result->result_json['form'] as $section)
                            <tr>
                                <td rowspan="{{ count($section['questions']) + 1 }}">{{ $section['name'] }}</td>
                            </tr><br>
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
                                    <td>{{ $question['credit'] }}</td>
                                </tr>

                            @endforeach
                            <tr>
                                <td colspan="3" align="right"><strong>Total Credit:</strong></td>
                                <td>{{ $section['credit'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><strong>Total Weight:</strong></td>
                                <td>{{ $section['weight'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><strong>Result Grade:</strong></td>
                                <td>{{ $result->result_json['result_grade'] }}</td>
                            </tr>
                            <tr style="height: 40px;"></tr>
                            <tr style="height: 20px;"></tr>
                        @endforeach

                        <tr style="height: 40px;"></tr>
                    </table>
                    <hr>
                </div>
            </div>
        @endforeach

    @else
        <p>No evaluation results found.</p>
    @endif
@endsection
