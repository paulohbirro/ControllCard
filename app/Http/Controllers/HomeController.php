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
        $payaments = $payaments->orderBy('created_at')
                               ->where('tipo','<>','0')
                               ->paginate();
    else
        $payaments = $payaments->where('created_at','<=',now())
                                ->where('tipo','<>','0')
                                ->orderBy('created_at')->paginate();

        $taxas = Taxas::all();

        return view('home')->with(compact('payaments','total','taxas'));
    }


    public function store(storeRequest $request, Taxas $taxas)
    {

      $valor =  str_replace(',','',$request->valor);
      $valorvenda =  str_replace(',','',$request->valor);

      $request['valorvenda'] = $valorvenda;

      $res =  $taxas->where('creditoavista','>=',0)->first();

      //caso credito mais de uma parcela
        if($request->parcelas>1) {

            $id = Hash::make(str_random(4));

            //pega data do form
            if(!is_null($request->get('datav1'))) {
                $data1 = Carbon::createFromFormat('d/m/Y', $request->get('datav1'));
            }
            for($i=1;$i<$request->get('parcelas');$i++) {
                $valores = $valor - ($valor / 100 * $res->credito);
                $request['valor'] = $valores/$request->get('parcelas');
                $request['ref'] = $id;
                $pagamentos = Payaments::create($request->all());


                $dt = !is_null($request->get('datav1'))?$data1:$pagamentos->created_at;
                $update= Payaments::find($pagamentos->id);
                $update->ref = $id;
                $update->tipo = 0;
                $update->created_at = $dt->addMonth($i);
                $update->save();
            }

        }
        else {
            //credito uma parcela = credito avista
            $request['valor'] = $valor - ($valor / 100 * $res->creditoavista);
        }
//       if($request->has('parcelas'))
//       {
//          $request['ref'] = Hash::make(str_random(8));
//
//       }
        // debito
       if($request->get('tipo')===2){
           $request['valor'] = $valor - ($valor / 100 * $res->debito);
       }


       if($request->parcelas<=1 && $request->tipo==5)
               $request['tipo']=$res->creditoavista;



        $pagamentos = Payaments::create($request->all());


      if(!is_null($request->get('datav1'))) {
          //pegar data
          $data1 = Carbon::createFromFormat('d/m/Y', $request->get('datav1'));
          $update = Payaments::find($pagamentos->id);
          $update->created_at = $data1;
          $update->save();
      }


        return redirect()->back()->with(['message' => 'Cadastrado com sucesso!']);
    }

    public function destroy($id)
    {
        $payaments  = Payaments::find($id);

        $payaments_del = Payaments::where('ref',$payaments->ref)->get() ;

        foreach ($payaments_del as $paydel){

            $paydel->delete();

        }



        return redirect()->back()->with(['message' => 'Produto removido com sucesso!']);
    }


    public  function history(Request $request, $id, Payaments $payaments){

        $pagamentos = Payaments::find($id);

        $history = $payaments->where('ref',$pagamentos->ref)->get();

        return view('history')->with(compact('history'));


    }


}
