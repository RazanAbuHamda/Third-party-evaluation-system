@extends('layouts.system-layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                @can('Show enterprises')
                    <h2>Forms List</h2>
                @else
                    @can('Show enterprise forms')
                        <h2>" {{$enterpriseName->enterprise_name}} " Enterprise Forms List</h2>
                    @endcan
                @endcan
            </div>
            <div class="pull-right">
                @can('Add form')
                    <a class="btn btn-success rounded-pill" href="{{ url('forms/create') }}"
                       style="background-color: #F7C049; border-radius: 50px;border-color:#F7C049 ">
                        <i class="fa fa-plus" style="margin-right: 5px"></i> Add Form
                    </a>
                @endcan
            </div>
        </div>
        @can('Show enterprises')
            <div class="mb-3 pull-right">
                <form action="{{ url('forms/index') }}" method="GET">
                    <div class="pull-right input-group-append">
                        <button class="btn btn-success" type="submit"
                                style="background-color: #151516; border-radius: 50px;border-color:#151516 ">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                    </div>
                    <div class="input-group">
                        <select class="form-control" name="enterprise_name" style="border-radius: 50px">
                            <option value="">All Enterprises</option>
                            @foreach ($enterprises as $enterpriseId => $enterpriseName)
                                <option
                                    value="{{ $enterpriseName }}" {{ request('enterprise_name') == $enterpriseName ? 'selected' : '' }}>
                                    {{ $enterpriseName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        @endcan
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @can('Show enterprises')
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
                        <a class="btn btn-primary" style="background-color: #FFFFFF;color: #0c0c0c"
                           href="{{ url('forms/edit', $form->id) }}">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form method="POST" action="{{ url('forms/destroy', $form->id) }}" style="display:inline"
                              class="delete-form-form">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger delete-button" id="delete-form-btn">
                                <i class="fas fa-trash" style="margin-right: 5px"></i>Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else

        @can('Show enterprise forms')
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                </tr>
                @foreach ($enterpriseForms as $key => $form)
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
                        <td>
                            @can('Edit forms')
                                <a class="btn btn-primary" style="background-color: #FFFFFF;color: #0c0c0c"
                                   href="{{ url('forms/edit', $form->id) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endcan
                            @can('Delete form')
                                <form method="POST" action="{{ url('forms/destroy', $form->id) }}"
                                      style="display:inline"
                                      class="delete-form-form">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger delete-button" id="delete-form-btn">
                                        <i class="fas fa-trash" style="margin-right: 5px"></i>Delete
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
        @endcan
    @endcan
    <script>
        // Get all the delete buttons on the page
        var deleteButtons = document.getElementsByClassName('delete-button');

        // Attach event handlers to each delete button
        for (var i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', function (e) {
                e.preventDefault();

                // Get the parent form element of the clicked delete button
                var parentForm = this.closest('.delete-form-form');

                // Confirm the deletion with the user
                if (confirm('Are you sure you want to delete this Form?')) {
                    // Submit the form
                    parentForm.submit();
                }
            });
        }
    </script>
    {{--    {!! $forms->appends(['enterprise_name' => request('enterprise_name')])->render() !!}--}}
@endsection
