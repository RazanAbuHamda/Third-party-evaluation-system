<?php

namespace App\Http\Controllers;

use App\Http\Traits\SurveyQuestion;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use App\Models\EvaluationResult;

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

        $formEvaluationsCount = [];
        foreach ($forms as $form) {
            $formEvaluationsCount[$form->id] = EvaluationResult::where('form_id', $form->id)->count();
        }

        return view('forms.index', compact('forms', 'formEvaluationsCount'))->with('i', ($request->input('page', 1) - 1) * 5)->with('active', $active);
    }


    public function create(Request $request)
    {
        $active = 'formAct';
        return view('forms.create')->with('active', $active);
    }

    public function show($id,Request $request){
        $active = 'formAct';
//        $evaluationResults = EvaluationResult::where('form_id', $id)->limit(1)->paginate(5);
        $evaluationResults = EvaluationResult::with('form')->where('form_id', 'form.id')->limit(1)->paginate(5);
//        dd($evaluationResults);
        return view('forms.evaluation-results')->with('active', $active)->with('i', ($request->input('page', 1) - 1) * 5)->with('id',$id)->with('evaluationResults',$evaluationResults);
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
            return view('forms.edit-survey-new')->with('formData', $formData, true)->with('id', $id);

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

    public function createCoordinatorForm($id){
        $formData = Form::find($id)->form_data;
            return view('forms.coordinator-page')->with('formData', $formData, true)->with('id', $id);
    }

    public function storeEvaluationResults(Request $request, $id)
    {
        $formEvaluation = new EvaluationResult;
        $user = Auth::user();
        $formEvaluation->form_id = $id;
        $formEvaluation->user_id = $user->id;
        // Retrieve the formJson data from the request
        $results = request('reultsJson');
        // Decode the JSON string into a PHP array or object
        $result = json_decode($results, true);

        $formEvaluation->result_json = $result;
        $formEvaluation->save();

        return view('forms.evaluation-results');
    }



}
