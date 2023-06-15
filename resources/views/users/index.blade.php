@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success rounded-pill" href="{{ route('users.create') }}"
                   style="background-color: #F7C049; border-radius: 50px;border-color:#F7C049 ">
                    <i class="fa fa-plus" style="margin-right: 5px"></i> Add User
                </a>
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
            <th>Email</th>
            <th>Roles</th>
            <th>Status</th>
            <th>Enterprise id</th>
            <th>Enterprise name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>
                    <a class="btn btn-info"
                       style="background-color: #FFFFFF;color: #0c0c0c;border-color: white; width: 10px"
                       href="{{ route('users.show', $user->id) }}">
                    {{ ++$i }}
                    </a>
                </td>
                <td>
                    <a class="btn btn-info"
                       style="background-color: #FFFFFF;color: #0c0c0c;border-color: white; width: 100px"
                       href="{{ route('users.show', $user->id) }}">
                        {{ $user->name }}
                    </a>
                </td>
                <a class="btn btn-info"
                   style="background-color: #FFFFFF;color: #0c0c0c;border-color: white; width: 150px"
                   href="{{ route('users.show', $user->id) }}">
                    <td>{{ $user->email }}</td>
                </a>
                <a class="btn btn-info"
                   style="background-color: #FFFFFF;color: #0c0c0c;border-color: white; width: 150px"
                   href="{{ route('users.show', $user->id) }}">

                    <td>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->roles_name as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                </a>
                <a class="btn btn-info"
                   style="background-color: #FFFFFF;color: #0c0c0c;border-color: white; width: 150px"
                   href="{{ route('users.show', $user->id) }}">
                    <td>{{ $user->status }}</td>
                </a>
                <td>
                    {{ $user->enterprise_id }}
                    @if(empty($user->enterprise_id))
                        {{"..."}}
                    @endif
                </td>
                <td>
                    @if(!empty($user->enterprise_id))
                        @foreach($enterprises as $key => $enterprise)
                            @if($enterprise->id == (int)$user->enterprise_id)
                                {{ $enterprise->enterprise_name }}
                            @endif
                        @endforeach
                    @endif
                    @if(empty($user->enterprise_id))
                        {{"..."}}
                    @endif
                </td>
                <td>
                    <a class="btn btn-primary" style="background-color: #FFFFFF;color: #0c0c0c"
                       href="{{ route('users.edit', $user->id) }}">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline','id'=>'delete-user-form']) !!}
                    {!! Form::button('<i class="fas fa-trash"></i> Delete', ['class' => 'btn btn-danger delete-button','id'=>'delete-user-btn']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach

    </table>



    {!! $data->render() !!}

@endsection

