@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Enterprise</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" style="background-color: #F7C049; border-radius: 50px;border-color:#F7C049" href="{{ url('enterprises/index') }}">
                    <i class="fas fa-arrow-left" style="margin-right: 5px"></i> Back
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $enterprise->enterprise_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $enterprise->email }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $enterprise->status }}
            </div>
        </div>
    </div>
@endsection
