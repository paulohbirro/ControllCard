<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeRequest;
use App\Payaments;
use Illuminate\Http\Request;

class PayamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Payaments $payaments)
    {


        $payaments = $payaments->orderBy('nome')->paginate();

        return view('home')->with(compact('payaments'));
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
    public function store(storeRequest $request)
    {
        Payaments::create($request->all());
        return redirect()->back()->with(['message' => 'Cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payaments  $payaments
     * @return \Illuminate\Http\Response
     */
    public function show(Payaments $payaments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payaments  $payaments
     * @return \Illuminate\Http\Response
     */
    public function edit(Payaments $payaments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payaments  $payaments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payaments $payaments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payaments  $payaments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payaments $payaments)
    {
        //
    }
}
