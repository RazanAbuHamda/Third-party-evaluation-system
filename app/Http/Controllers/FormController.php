<?php

namespace App\Http\Controllers;

use App\Http\Traits\SurveyQuestion;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormController extends Controller
{
//    use SurveyQuestionTrait;
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
//            dd(json_encode($formData));
//            $array = json_decode($formData, true);
//            $formData = json_encode($array);
            return view('forms.edit-survey-new')->with('formData', $formData, true)->with('id', $id);

        }
    }

//    public function getSurveyQuestions($id)
//    {
//        // Retrieve survey questions for the specified topic ID from the database or wherever they are stored
//        $formData = Form::find($id)->form_data;
//        $dataArray = json_decode($formData, true);
//
//        // Get the elements array for all pages
//        $surveyQuestions = array();
//        foreach ($dataArray['pages'] as $page) {
//            $surveyQuestions = array_merge($surveyQuestions, $page['elements']);
//        }
//
//        return response()->json($surveyQuestions);
//    }


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
