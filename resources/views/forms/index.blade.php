@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Forms Management</h2>
            </div>
            <div class="pull-right">
{{--                <a class="btn btn-success" href="{{ route('forms.create') }}"> Create New User </a>--}}
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
            <th>Name</th>
        </tr>
        @foreach ($forms as $key => $form)
            {{--is a key of array from compact php function used in controller--}}
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $form->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('forms.show',$form->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('forms.edit',$form->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['forms.destroy', $form->id],'style'=>'display:inline','id'=>'delete-user-form']) !!}
                    {!! Form::button('Delete', ['class' => 'btn btn-danger','id'=>'delete-user-btn']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>



    {!! $forms->render() !!}

@endsection

