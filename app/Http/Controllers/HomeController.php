<?php

namespace App\Http\Controllers;

use App\Payaments;
use Illuminate\Http\Request;

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
    public function index(Request $request, Payaments $payaments)
    {



        $payaments = $payaments->orderBy('nome')->paginate();

        return view('home')->with(compact('payaments'));
    }
}
