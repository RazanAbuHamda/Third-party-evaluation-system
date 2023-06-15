@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Enterprises List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success rounded-pill" href="{{  url('enterprises/create') }}" style="background-color: #F7C049; border-radius: 50px;border-color:#F7C049 ">
                    <i class="fa fa-plus" style="margin-right: 5px"></i>  Add Enterprise
                </a>
            </div>
        </div>
    </div>
    <br><br>
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
                <td>
                    <a class="btn btn-info"
                       style="background-color: #FFFFFF;color: #0c0c0c;border-color: white; width: 10px"
                       href="{{ url('enterprises/show/'.$enterprise->id) }} }}">
                    {{ ++$i }}
                    </a>
                </td>
                <td>
                    <a class="btn btn-info"
                       style="background-color: #FFFFFF;color: #0c0c0c;border-color: white; width: 150px"
                       href="{{ url('enterprises/show/'.$enterprise->id) }} }}">
                    {{ $enterprise->enterprise_name }}
                    </a>
                </td>
                <td>{{ $enterprise->email }}</td>
                <td>{{$enterprise->status}}</td>
                <td>
                    <a class="btn btn-primary" style="background-color: #FFFFFF;color: #0c0c0c"  href="{{ url('enterprises/edit/'.$enterprise->id) }}">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    {!! Form::open(['method' => 'DELETE','url' => ['enterprises/destroy/'. $enterprise->id],'style'=>'display:inline','id'=>'delete-user-form']) !!}
                    {!! Form::button('<i class="fas fa-trash"></i> Delete', ['class' => 'btn btn-danger delete-button','id'=>'delete-entr-btn']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    {!! $data->render() !!}

@endsection
