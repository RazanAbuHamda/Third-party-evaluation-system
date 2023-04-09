<?php

namespace App\Http\Traits;

use App\Models\Form;

trait SurveyQuestionTrait
{
    public function getSurveyQuestions($id)
    {
        // Retrieve survey questions for the specified topic ID from the database or wherever they are stored
        $formData = Form::find($id)->form_data;
        $dataArray = json_decode($formData, true);

        // Get the elements array for all pages
        $surveyQuestions = array();
        foreach ($dataArray['pages'] as $page) {
            $surveyQuestions = array_merge($surveyQuestions, $page['elements']);
        }

        return response()->json($surveyQuestions);

    }
}
