<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormController extends Controller
{
    public function index(Request $request)
    {
        $active = 'formAct';
        $user = Auth::user();
        $forms = Form::orderBy('id', 'DESC')->where('user_id', $user->id)->paginate(5);
        return view('forms.index', compact('forms'))->with('i', ($request->input('page', 1) - 1) * 5)->with('active', $active);
    }

    public function create(Request $request)
    {
        $active = 'formAct';
        return view('forms.create')->with('active', $active);;
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
        $form->user_id = $user->id;
        $form->save();

        return redirect()->route('forms.edit', ['id' => $form->id])
            ->with('success', 'Form created successfully')
            ->with('active', $active);
    }

    public function survey($id)
    {
        $formData = Form::find($id)->form_data;

        if (!$formData) {
            return view('forms.survey')->with('id', $id);

        } else {
//            dd($formData);
            return view('forms.edit-survey')->with('formData', $formData, true)->with('id', $id);

        }
    }



    public function update($id)
    {
        // Retrieve the formJson data from the request
        $formJson = request('formJson');

        // Decode the JSON string into a PHP array or object
        $formData = json_decode($formJson, true);
        $form = Form::find($id);
        $form->form_data = $formData;
        $form->save();

        return response()->json(['message' => 'Form received successfully!']);
    }


}
