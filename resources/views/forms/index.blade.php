@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Forms List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success rounded-pill" href="{{  url('forms/create') }}" style="background-color: #F7C049; border-radius: 50px;border-color:#F7C049 ">
                    <i class="fa fa-plus" style="margin-right: 5px"></i>  Add Enterprise
                </a>
            </div>
        </div>

    <div class="mb-3 pull-right">
        <form action="{{ url('forms/index') }}" method="GET">
            <div class="pull-right input-group-append">
                <button class="btn btn-success" type="submit" style="background-color: #151516; border-radius: 50px;border-color:#151516 ">
                    <i class="fa fa-filter"></i> Filter </button>
            </div>
            <div class="input-group">
                <select class="form-control" name="enterprise_name" style="border-radius: 50px">
                    <option value="">All Enterprises</option>
                    @foreach ($enterprises as $enterpriseId => $enterpriseName)
                        <option value="{{ $enterpriseName }}" {{ request('enterprise_name') == $enterpriseName ? 'selected' : '' }}>
                            {{ $enterpriseName }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
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
            <th>Enterprise name</th>
            <th></th>
        </tr>
        @foreach ($forms as $key => $form)
            <tr>
                <td>
                    <a class="btn btn-info"
                       style="background-color: #FFFFFF;color: #0c0c0c;border-color: white; width: 50px"
                       href="{{ url('forms/show',$form->id) }}">
                    {{ ++$i }}
                    </a>
                </td>
                <td>
                    <a class="btn btn-info"
                       style="background-color: #FFFFFF;color: #0c0c0c;border-color: white; width: 150px"
                       href="{{ url('forms/show',$form->id) }}">
                    {{ $form->name }}
                    </a>
                </td>
                <td>{{ $form->enterprise->enterprise_name }}</td>
                <td>
                    <a class="btn btn-primary" style="background-color: #FFFFFF;color: #0c0c0c"  href="{{ url('forms/edit',$form->id) }}">
                        <i class="fas fa-edit"></i>  Edit
                    </a>
                    <form method="POST" action="{{ url('forms/destroy', $form->id) }}" style="display:inline"
                          id="delete-user-form">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger delete-button" id="delete-form-btn">
                            <i class="fas fa-trash" style="margin-right: 5px"></i>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>



    {!! $forms->appends(['enterprise_name' => request('enterprise_name')])->render() !!}
@endsection
