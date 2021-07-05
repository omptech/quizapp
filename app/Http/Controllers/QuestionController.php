<?php

namespace App\Http\Controllers;

use App\Category;
use App\Completed;
use App\Done;
use App\Http\Resources\Question\QuestionResource;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    /**
     * Display a listing of easy Questions
     *
     * @return \Illuminate\Http\Response
     */
    public function easyQuestions(Category $category)
    {
        $easyQuestions = $category->questions->where('level', 'easy');
        return QuestionResource::collection($easyQuestions);
    }

    /**
     * Display a listing of medium Questions
     *
     * @return \Illuminate\Http\Response
     */
    public function mediumQuestions(Category $category)
    {
        $mediumQuestions = $category->questions->where('level', 'medium');
        return QuestionResource::collection($mediumQuestions);
    }

    /**
     * Display a listing of hard Questions
     *
     * @return \Illuminate\Http\Response
     */
    public function hardQuestions(Category $category)
    {
        $hardQuestions = $category->questions->where('level', 'hard');
        return QuestionResource::collection($hardQuestions);
    }

    /**
     * Display a listing of expert Questions
     *
     * @return \Illuminate\Http\Response
     */
    public function expertQuestions(Category $category)
    {
        $expertQuestions = $category->questions->where('level', 'expert');
        return QuestionResource::collection($expertQuestions);
    }

    /**
     * Display a listing of expert Questions
     *
     * @return \Illuminate\Http\Response
     */
    public function makeQuizPassed(Request $request)
    {
        Completed::create([
            'player_id'=>$request->player_id,
            'category_id'=>$request->category_id,
            'category_level'=>$request->category_level,
            'points'=>$request->points,
            'total_quiz_points'=>$request->total_quiz_points,
        ]);
        $result['success'] = 'quizCompleted';
        $result['message'] = 'This quiz is completed';
        echo json_encode($result);
    }

    /**
     * Display a listing of expert Questions
     *
     * @return \Illuminate\Http\Response
     */
    public function checkIfQuizCompleted(Request $request)
    {
        $completed = Completed::where(['player_id'=>$request->player_id, 'category_id'=>$request->category_id, 'category_level'=>$request->category_level])->first();
        if ($completed) {
            $result['success'] = 'quizCompleted';
            echo json_encode($result);
        }
    }

    /**
     * Display a listing of expert Questions
     *
     * @return \Illuminate\Http\Response
     */
    public function checkIfQuizContainsQuestions(Request $request)
    {
        $questions = Question::where(['category_id'=>$request->category_id, 'level'=>$request->level])->first();
        if ($questions) {
            $result['success'] = 'questionsExists';
            echo json_encode($result);
        } else {
            $result['success'] = 'noQuestions';
            echo json_encode($result);
        }
    }


}
