<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('questionnaire.index')->with('questionnaire', User::find( Auth::user()->id )->Questionnaire);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find( Auth::user()->id );
        $questionnaire = $user->questionnaire;
        
        $questionnaire->qst_1 = $request['qst_1'] ?? '';
        $questionnaire->qst_2 = $request['qst_2'] ?? '';
        $questionnaire->qst_3_1 = $request['qst_3_1'] ?? 0;
        $questionnaire->qst_3_2 = $request['qst_3_2'] ?? 0;
        $questionnaire->qst_3_3 = $request['qst_3_3'] ?? 0;
        $questionnaire->qst_3_4 = $request['qst_3_4'] ?? 0;
        $questionnaire->qst_3_5 = $request['qst_3_5'] ?? 0;
        $questionnaire->qst_3_6 = $request['qst_3_6'] ?? 0;
        $questionnaire->qst_4 = $request['qst_4'] ?? '';
        $questionnaire->qst_4_desc = $request['qst_4_desc'] ?? '';
        $questionnaire->qst_5 = $request['qst_5'] ?? '';
        $questionnaire->qst_6 = $request['qst_6'] ?? '';
        $questionnaire->qst_7 = $request['qst_7'] ?? '';
        $questionnaire->qst_8 = $request['qst_8'] ?? '';
        $questionnaire->qst_9 = $request['qst_9'] ?? '';
        $questionnaire->qst_10 = $request['qst_10'] ?? '';
        $questionnaire->qst_11 = $request['qst_11'] ?? '';
        $questionnaire->qst_12 = $request['qst_12'] ?? '';
        $questionnaire->qst_13 = $request['qst_13'] ?? '';
        $questionnaire->qst_14 = $request['qst_14'] ?? 0;
        $questionnaire->qst_15 = $request['qst_15'] ?? '';
        $questionnaire->qst_16 = $request['qst_16'] ?? '';
        $questionnaire->qst_17 = $request['qst_17'] ?? '';
        
        $questionnaire->save();
        
        $user->register = 'TRUE';
        $user->save();
        
        return redirect()
                    ->route('home',
                                ['success' => 'Cuestionario enviado. ¡Muchas Gracias!']
                            );
    }
}
