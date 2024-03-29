<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Add user|Edit users|Show users|Delete user|Add Enterprise', ['only' => ['index','store','edit','update','destroy']]);
        $this->middleware('permission:Edit users', ['only' => ['index','show']]);
        $this->middleware('permission:Delete user', ['only' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active ='userAct';
        $enterprises = Enterprise::select('*')->get();
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data','enterprises'))
            ->with('i', ($request->input('page', 1) - 1) * 5)->with('active',$active);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active ='userAct';
        $enterprises = Enterprise::pluck('enterprise_name','id')->all();
//        dd($enterprises);
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact(['roles','enterprises']))->with('active',$active);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $active ='userAct';
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'required',
            'status' => 'required',
            'enterprise_id' =>'nullable'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $user->status = $request->input('status');
        $user->enterprise_id = $request->input("enterprise_id");
        return redirect()->route('users.index')
            ->with('success','User created successfully')->with('active',$active);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $active ='userAct';
        $user = User::find($id);
        return view('users.show',compact('user'))->with('active',$active);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $active ='userAct';
        $enterprises = Enterprise::pluck('enterprise_name','id')->all();
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole','enterprises'))->with('active',$active);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $active ='userAct';
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles_name' => 'required',
            'status' => 'required',
            'enterprise-id' =>'nullable'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User updated successfully')->with('active',$active);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $active ='userAct';
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully')->with('active',$active);
    }
}
