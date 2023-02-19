@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Enterprises Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('enterprises/create') }}"> Create New Enterprise </a>
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
            <th>Enterprise Name</th>
            <th>Enterprise Email</th>
            <th>Status</th>

        </tr>
        @foreach ($data as $key => $enterprise)
            {{--is a key of array from compact php function used in controller--}}
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $enterprise->enterprise_name }}</td>
                <td>{{ $enterprise->email }}</td>
                <td>{{$enterprise->status}}</td>
                <td>
                    <a class="btn btn-info" href="{{ url('enterprises/show/'.$enterprise->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ url('enterprises/edit/'.$enterprise->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','url' => ['enterprises/destroy/'. $enterprise->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>



    {!! $data->render() !!}

@endsection
