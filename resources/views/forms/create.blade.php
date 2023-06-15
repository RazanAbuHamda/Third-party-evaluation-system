@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a  style=" border-radius: 50px;color:black; bs-link-hover-color: #F7C049  "
                    href="{{ url('forms/index') }}">
                    <i class="fas fa-angle-left"></i>
                </a>
                <h3>forms/Add New Form</h3>
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


    {!! Form::open(array('url' => 'forms/store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Form Name:</strong>
                {!! Form::text('form_name', null, array('placeholder' => 'Form Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Enterprise Name:</strong>
                {!! Form::select('enterprise_id', $enterprises, [],['class' => 'form-control']) !!}

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
