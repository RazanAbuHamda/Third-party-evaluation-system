@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Enterprises Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('forms/index') }}"> Browse Forms  </a>
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
            <th>user_id</th>
            <th>topic Name</th>
            <th>topic's Questions Score</th>
            <th>topic's total Score</th>

        </tr>
{{--        @foreach ($data as $key => $enterprise)--}}
            {{--is a key of array from compact php function used in controller--}}
            <tr>
                <td>{{ ++$i }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
{{--        @endforeach--}}
    </table>


@endsection
