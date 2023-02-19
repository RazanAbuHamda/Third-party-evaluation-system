@extends('layouts.system-layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User </a>
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
            {{--is a key of array from compact php function used in controller--}}
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->roles_name as  $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td>{{$user->status}}</td>
                <td>
                    {{$user->enterprise_id}}
                    @if(empty($user->enterprise_id))
                        {{"..."}}
                    @endif
                </td>

                <td>

                    @if(!empty($user->enterprise_id))
                        @foreach($enterprises as $key => $enterprise)
                            @if($enterprise->id == (int)$user->enterprise_id)
                                {{$enterprise->enterprise_name}}
                            @endif

                        @endforeach
                    @endif
                    @if(empty($user->enterprise_id))
                        {{"..."}}
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>



    {!! $data->render() !!}

@endsection
