<?php

namespace App\Http\Controllers;

use App\Models\QuizAnswe;
use Illuminate\Http\Request;

class SaveQuizController extends Controller
{
    public function store(Request $request){
        $check = QuizAnswe::where("user_id","=",$request->user_id)->get()->count();
        $one = $request->score1;
        $two = $request->score2;
        $three = $request->score3;

        $data = QuizAnswe::first();
        //id the data exist
        if ($check!=0){
            $data = QuizAnswe::where("user_id","=",$request->user_id)->first();
        }else{
            $data = new QuizAnswe();
            $data->user_id=$request->user_id;
        }

        if ($one!=null){
            $data->score1 = $one;
        }

        if ($two!=null){
            $data->score2 = $two;
        }

        if ($three!=null){
            $data->score3 = $three;
        }

        if ($data->save()){
            return "comform";
        }else{
            return "buki";
        }
    }

    public function getScores(Request $request)
    {
        // Get the scores for the user
        $scores = QuizAnswe::where('user_id', $request->user_id)->first();
        // Return the scores as a JSON response
        return response()->json($scores);
    }
}
