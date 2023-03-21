<?php

namespace App\Http\Controllers;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FormController extends Controller
{
   public function index(Request $request)
   {
       $active ='formAct';
       $user = Auth::user();
       $forms = Form::orderBy('id','DESC')->where('user_id',$user->id)->paginate(5);
       return view('forms.index',compact('forms'))->with('i', ($request->input('page', 1) - 1) * 5)->with('active',$active);
   }
    public function create(Request $request)
    {
        $active ='formAct';
        return view('forms.create')->with('active',$active);;
    }

    public function store(Request $request)
    {
        $active = 'formAct';
        $user = Auth::user();
        $this->validate($request, [
//            'name'=> 'required'
        ]);

        $form = new Form;
        $form->name = $request['form_name'];
        $form->user_id= $user->id;
        $form->save();

        return redirect()->route('forms.edit.{id}',['id' => $form->id])
            ->with('success', 'Form created successfully')
            ->with('active', $active);
    }

    public function survey (Request $request,$id) {
        $active ='formAct';
        return view('forms.survey')->with('active',$active)->with('id',$id);
    }

    public function update(Request $request, $id)
    {
        // Retrieve the formJson data from the request
        $formJson = $request['formJson'];

        // Decode the JSON string into a PHP array or object
        $formData = json_decode($formJson);
        $form = Form::find($id);
        $form->form_data = json_encode($formData);
        $form->save();
        return response()->json(['message' => 'Form received successfully!']);
    }


}
