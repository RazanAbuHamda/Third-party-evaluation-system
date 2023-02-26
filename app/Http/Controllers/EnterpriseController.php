<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class EnterpriseController extends Controller
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
        $active='enterAc';
        $data = Enterprise::orderBy('id','DESC')->paginate(5);
        return view('enterprises.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5)->with('active',$active);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active='enterAc';
        $enterprises = Enterprise::pluck('enterprise_name','id')->all();
//        dd($enterprises);
        $roles = Role::pluck('name','name')->all();
        return view('enterprises.create',compact(['roles','enterprises']))->with('active',$active);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $active='enterAc';
        $this->validate($request, [
            'enterprise_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'status' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $enterprise = Enterprise::create($input);
        $enterprise->status = $request->input('status');

        return redirect('enterprises/index')
            ->with('success','Enterprise created successfully')->with('active',$active);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $active='enterAc';
        $enterprise = Enterprise::find($id);
        return view('enterprises.show',compact('enterprise'))->with('active',$active);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $active='enterAc';
        $enterprise = Enterprise::find($id);
        return view('enterprises.edit',compact('enterprise',))->with('active',$active);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $active='enterAc';
        $this->validate($request, [
            'enterprise_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'status' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $enterprise = Enterprise::find($id);
        $enterprise->update($input);

        return redirect('enterprises/index')
            ->with('success','Enterprise updated successfully')->with('active',$active);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $active='enterAc';
        Enterprise::find($id)->delete();
        return redirect('enterprises/index')
            ->with('success','Enterprise deleted successfully')->with('active',$active);
    }
}
