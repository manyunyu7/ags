<?php

namespace App\Http\Controllers;

use App\Models\QuizAnswe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveQuizController extends Controller
{
    public function store(Request $request){
        $check = QuizAnswe::where("user_id","=",$request->user_id)->get()->count();
        $one = $request->score1;
        $two = $request->score2;
        $three = $request->score3;
        $_4 = $request->score4;
        $_5 = $request->score5;
        $_6 = $request->score6;
        $_7 = $request->score7;
        $_8 = $request->score8;
        $_9 = $request->score9;
        $_10 = $request->score10;

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

        if ($_4!=null){
            $data->score4 = $_4;
        }

        if ($_5!=null){
            $data->score5 = $_5;
        }

        if ($_6!=null){
            $data->score6 = $_6;
        }

        if ($_7!=null){
            $data->score7 = $_7;
        }

        if ($_8!=null){
            $data->score8 = $_8;
        }


        if ($_9!=null){
            $data->score9 = $_9;
        }


        if ($_10!=null){
            $data->score10 = $_10;
        }


        if ($data->save()){
            return "comform";
        }else{
            return "buki";
        }
    }

    public function getScores(Request $request)
    {
        return
        // Get the scores for the user
        $scores = QuizAnswe::where('user_id', $request->user_id)->first();
        // Return the scores as a JSON response
        return response()->json($scores);
    }
}
