@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Forms Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('forms/create') }}"> Create New Form </a>
            </div>
        </div>
    </div>
{{-- الكود لعرض عدد الفورمات لكل enterprise--}}
{{--    <div class="mt-2">--}}
{{--        <ul class="list-group">--}}
{{--            @foreach ($enterpriseFormsCount as $enterprise)--}}
{{--                <li class="list-group-item">--}}
{{--                    {{ $enterprise->enterprise_name }}: {{ $enterprise->forms_count }} forms--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
    <div class="mb-3 pull-right">
        <form action="{{ url('forms/index') }}" method="GET">
            <div class="input-group">
                <select class="form-control" name="enterprise_name">
                    <option value="">All Enterprises</option>
                    @foreach ($enterprises as $enterpriseId => $enterpriseName)
                        <option value="{{ $enterpriseName }}" {{ request('enterprise_name') == $enterpriseName ? 'selected' : '' }}>
                            {{ $enterpriseName }}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Filter</button>
                </div>
            </div>
        </form>
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
                <td>{{ ++$i }}</td>
                <td>{{ $form->name }}</td>
                <td>{{ $form->enterprise->enterprise_name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ url('forms/show',$form->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ url('forms/edit',$form->id) }}">Edit</a>
                    <form method="POST" action="{{ url('forms/destroy', $form->id) }}" style="display:inline"
                          id="delete-user-form">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" id="delete-user-btn">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>



    {!! $forms->appends(['enterprise_name' => request('enterprise_name')])->render() !!}
@endsection
