<?php

namespace App\Http\Controllers;

use App\Helpers\EvaluationResultCalculator;
use App\Http\Traits\SurveyQuestion;
use App\Models\Enterprise;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use App\Models\EvaluationResult;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Show forms|Add form|Edit users|Delete form|Show enterprise forms', ['only' => ['index','store','edit','destroy','showEnterpriseForms']]);
    }


    protected $fillable = [
        'name',
        'enterprise_id',
    ];

    public function index(Request $request)
    {
        $active = 'formAct';
        $user = Auth::user();

        $forms = Form::orderBy('id', 'DESC')
            ->with('enterprise');


        // Apply filter by enterprise name if provided
        if ($request->has('enterprise_name')) {
            $forms->whereHas('enterprise', function ($query) use ($request) {
                $query->where('enterprise_name', 'LIKE', '%' . $request->input('enterprise_name') . '%');
            });
        }

        // Retrieve the count of forms for each enterprise
        $enterpriseFormsCount = Enterprise::withCount('forms')->get();
        $enterprises = Enterprise::pluck('enterprise_name', 'id'); // Retrieve the list of enterprise names

        $forms = $forms->paginate(5);

        return view('forms.index', compact('forms', 'enterpriseFormsCount', 'enterprises'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('active', $active);
    }

    public function create(Request $request)
    {
        $active = 'formAct';

        $enterprises = Enterprise::pluck('enterprise_name', 'id')->all();
        return view('forms.create', compact('enterprises'))->with('active', $active);
    }

    public function show($id, Request $request)
    {
        $active = 'formAct';
        $user = Auth::user();

        $evaluationResults = EvaluationResult::where('form_id', $id)->paginate(10);
        $formName = Form::find($id)->name;

        return view('forms.evaluation-results')
            ->with('active', $active)
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('id', $id)
            ->with('evaluationResults', $evaluationResults)
            ->with('formName', $formName);
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
        if($request->input("enterprise_id")){
            $form->enterprise_id = $request->input("enterprise_id");
        }else{
            $form->enterprise_id =$user->enterprise_id;
        }
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

    public function createCoordinatorForm($id)
    {
        $formData = Form::find($id)->form_data;
        $formName = Form::find($id)->name;
        return view('forms.coordinator-survey')->with('formData', $formData, true)->with('id', $id)->with('formName',$formName);
    }

    public function storeEvaluationResults(Request $request, $id)
    {
        $formEvaluation = new EvaluationResult;
        $user = Auth::user();
        $formEvaluation->form_id = $id;
        $formEvaluation->user_id = $user->id;
        // Retrieve the formJson data from the request
        $results = json_decode(request('resultsJson'), true);

        $formEvaluation->result_json = EvaluationResultCalculator::calculateEvaluationResultCredit($results);
        $formEvaluation->save();

        return redirect()->route('forms.index')->with('success', 'Evaluation results stored successfully');
    }


    public function deleteTopic($id)
    {
        $topicsName = json_decode(request('deletedTopics'), true);
        $form = Form::find($id);
        $formData = $form->form_data;

        // Filter the form_data array based on the topic name
        $formData = array_filter($formData, function ($topic) use ($topicsName) {
            return !in_array($topic['pages'][0]['name'], $topicsName);
        });

        $form->form_data = $formData;
        $form->save();

        return response()->json(['success' => true]);
    }

    public function showEnterpriseForms()
    {
        $active = 'formAct';
        $user = Auth::user();

        $enterpriseForms = Form::orderBy('id', 'DESC')
            ->with('enterprise')
            ->where('user_id', $user->id)
            ->paginate(5);

        $enterpriseFormsCount = Enterprise::withCount('forms')->get();
        $enterprises = Enterprise::pluck('enterprise_name', 'id');

        return view('forms.index', compact('enterpriseForms', 'enterpriseFormsCount', 'enterprises'))
            ->with('i', request()->input('page', 1) - 1)
            ->with('active', $active);
    }

    public function destroy($id)
    {
        Form::find($id)->delete();
        return redirect('forms/index')
            ->with('success','Form deleted successfully');
    }

}
