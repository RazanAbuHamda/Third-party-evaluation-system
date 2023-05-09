<?php

namespace App\Helpers;

class EvaluationResultCalculator
{
    public static function calculateEvaluationResultCredit($result)
    {
        # compute credit of each question
        foreach ($result as &$topic) {
            foreach ($topic['questions'] as &$question) {
                $question['credit'] = self::calculateQuestionCredit($question);
            }
        }

        # compute weight and credit of each topic
        foreach ($result as &$topic) {
            $topic['weight'] = self::calculateTopicWeight($topic);
            $topic['credit'] = self::calculateTopicCredit($topic);
        }

        # compute final credit
        $finalCredit = self::calculateResultFinalCredit($result);
        $totalWeight = self::calculateResultTotalWeight($result);

        return [
            'form'          => $result,
            'credit'        => $finalCredit,
            'weight'        => $totalWeight,
            'result_grade'  => (($finalCredit / $totalWeight) * 100),
        ];
    }

    private static function calculateResultTotalWeight($result)
    {
        $totalWeight = 0;

        foreach ($result as $topic) {
            foreach ($topic['questions'] as $question) {
                $totalWeight += $question['weight'];
            }
        }

        return $totalWeight;
    }

    private static function calculateResultFinalCredit($result)
    {
        $finalCredit = 0;

        foreach ($result as $topic) {
            foreach ($topic['questions'] as $question) {
                $finalCredit += $question['credit'];
            }
        }

        return $finalCredit;
    }

    private static function calculateTopicWeight($topic)
    {
        $topicWeight = 0;

        foreach ($topic['questions'] as $question) {
            $topicWeight += $question['weight'];
        }

        return $topicWeight;
    }

    private static function calculateTopicCredit($topic)
    {
        $topicCredit = 0;

        foreach ($topic['questions'] as $question) {
            $topicCredit += $question['credit'];
        }

        return $topicCredit;
    }

    private static function calculateQuestionCredit($question)
    {
        if ($question['type'] == 'text') {
            return self::calculateTextCredit($question);
        } else if ($question['type'] == 'rating') {
            return self::calculateRatingCredit($question);
        } else if ($question['type'] == 'radiogroup') {
            return self::calculateRadioCredit($question);
        } else if ($question['type'] == 'checkbox') {
            return self::calculateCheckboxCredit($question);
        }
    }

    private static function calculateTextCredit($question)
    {
        return ($question['answer']) ? $question['weight'] : 0;
    }

    private static function calculateRatingCredit($question)
    {
        return ($question['answer']) ? (($question['answer'] * $question['weight']) / 5) : 0;
    }

    private static function calculateRadioCredit($question)
    {
        if (!$question['answer']) {
            return 0;
        }

        return $question['answer'] == $question['correctAnswer'] ? $question['weight'] : 0;
    }

    private static function calculateCheckboxCredit($question)
    {
        if (!$question['answer']) {
            return 0;
        }

        $totalChoicesWeight = collect($question['choicesWeights'])->sum();

        $weights = [];
        for ($i = 0 ; $i < count($question['choices']) ; $i++) {
            $weights[$question['choices'][$i]] = $question['choicesWeights'][$i] ?? 0;
        }

        $choicesCredit = 0;
        foreach ($question['answer'] as $answer) {
            $choicesCredit += $weights[$answer];
        }

        ##########

        $credit = ($choicesCredit * $question['weight']) / $totalChoicesWeight;

        return $credit;
    }
}
