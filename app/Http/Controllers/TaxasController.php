<?php

namespace App\Http\Controllers;

use App\Taxas;
use Illuminate\Http\Request;

class TaxasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxas = Taxas::all();

        return view('taxas.index', compact('taxas'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxas  $taxas
     * @return \Illuminate\Http\Response
     */
    public function show(Taxas $taxas)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taxas  $taxas
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxas $taxas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taxas  $taxas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $t = Taxas::find($id);

        if(empty($t))
            Taxas::create($request->all());
        else
        $t->update($request->all());
        return redirect()->route('taxas.index')->with(['message' => 'Taxas alterada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taxas  $taxas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxas $taxas)
    {
        //
    }
}
