@extends('layouts.system-layout')
@section('content')
    <div class="row" style="margin-bottom:  5px">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a  style=" border-radius: 50px;color:black; bs-link-hover-color: #F7C049  "
                   href="{{ route('users.index') }}">
                <i class="fas fa-angle-left"></i>
                </a>
                <h3>users/Add New User</h3>
            </div>
        </div>
    </div>
    <br><br>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong>Something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Enterprise Name:</strong>
                {!! Form::select('enterprise_id', $enterprises, [],['class' => 'form-control']) !!}

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status">
                    <option>enabled</option>
                    <option>disabled</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"
                    style="background-color: #F7C049; border-radius: 50px;border-color:#F7C049; width: 180px;height: 40px; font-weight: bold;font-size: 20px">
                <i class="fas fa-check" style="margin-right: 5px"></i> Save
            </button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
