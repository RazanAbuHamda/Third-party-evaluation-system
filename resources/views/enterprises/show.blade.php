@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a style=" border-radius: 50px;color:black; bs-link-hover-color: #F7C049  "
                       href="{{ url('enterprises/index') }}">
                        <i class="fas fa-angle-left"></i>
                    </a>
                    <h3>enterprises/Show Enterprise</h3>
                </div>
            </div>
        </div>
    </div>
<br><br>

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
