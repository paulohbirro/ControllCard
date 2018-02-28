<?php

namespace App\Http\Controllers;

use App\Http\Requests\indexRequest;
use App\Http\Requests\storeRequest;
use App\Payaments;
use App\Taxas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        if($request->has('data1') && $request->has('data2'))
        {
            $data1 = Carbon::createFromFormat('d/m/Y',$request->get('data1'));
            $data2 = Carbon::createFromFormat('d/m/Y',$request->get('data2'));

            $payaments = $payaments->whereBetween('created_at', [$data1->format('Y-m-d H:i:s'),$data2->format('Y-m-d H:i:s')]);

            $total= $payaments->whereBetween('created_at', [$data1->format('Y-m-d H:i:s'),$data2->format('Y-m-d H:i:s')]);

        }

        $total = $payaments->sum('valor');

    if($request->has('data1') && $request->has('data2'))
        $payaments = $payaments->orderBy('created_at')->paginate();
    else
        $payaments = $payaments->where('created_at','<=',now())->orderBy('created_at')->paginate();

        $taxas = Taxas::all();


        return view('home')->with(compact('payaments','total','taxas'));
    }


    public function store(storeRequest $request)
    {



       if($request->has('parcelas'))
       {

          $request['ref'] = Hash::make(str_random(8));



           for($i=1;$i<$request->get('parcelas');$i++) {

               $pagamentos = Payaments::create($request->all());
               $dt = $pagamentos->created_at;
               $update= Payaments::find($pagamentos->id);

               $update->created_at = $dt->addMonth($i);
               $update->save();
           }

       }




           Payaments::create($request->all());




        return redirect()->back()->with(['message' => 'Cadastrado com sucesso!']);
    }

    public function destroy($id)
    {
        $payaments_del  = Payaments::find($id);
        $payaments_del->delete();
        return redirect()->back()->with(['message' => 'Produto removido com sucesso!']);
    }


}
