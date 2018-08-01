<?php

namespace App\Http\Controllers;

use App\Data;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type==='ADMIN') {
            return view('data.index')
                        ->with('users', User::where('type', '=', 'USER')->get());
        }
        else {
            $history = User::find( Auth::user()->id )->data;
            $data = $history->where('calculation_date', '=', date('Y-m-d'))->first();
            
            if($data==null)
                $data = new Data();
            
            return view('home')
                        ->with(['data' => $data, 'history' => $history]);
        }
    }
}
