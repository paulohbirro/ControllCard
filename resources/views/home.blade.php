


@extends('layouts.app')

@section('content')

    <script>

        function mostrar(){

            if(document.getElementById('credito').checked){

                document.getElementById("parcelas").style.display = "block";
            }
            else{
                document.getElementById("parcelas").style.display = "block";
            }

        }

    </script>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    ATENÇÃO!
                </div>
                <div class="modal-body">
                    Deseja realmente excluir ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a onclick="document.getElementById('delete-form').submit();" class="btn btn-danger btn-ok">sim</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Controle de cartão
                </h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form role="form" method="post" action="/cadastrar">
                    {{ csrf_field() }}




                    <div class="form-group">


                        <input    onclick="mostrar();" type="radio" checked {{old('tipo')==$taxas[0]['debito']?'checked':''}}  name="tipo" value="2"  /> Debito
                        <input id="credito" onclick="mostrar();" type="radio"  {{old('tipo')==$taxas[0]['credito']?'checked':''}} name="tipo" value="5"  /> Credito

                        <input type="text" value=" {{request()->get('datav1')}}" class="data1" id="datav1" name="datav1">

                    </div>


                    <div id="parcelas" style="display:none" class="form-group">

                        <label for="exampleInputPassword1">
                            Parcelas
                        </label>
                        <select name="parcelas">

                            <option value="">selecione parcelas</option>
                            @for ($i = 1; $i < 13; $i++)
                             <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>


                    <div class="form-group">

                        {{--<label for="exampleInputEmail1">--}}
                            {{--Produto--}}
                        {{--</label>--}}
                        {{--<input type="text" id="nome" name="nome" value="{{old('nome')}}" class="form-control"  />--}}
                    </div>
                    <div class="form-group">

                        <label for="exampleInputPassword1">
                            Valor
                        </label>
                        <input id="valor" type="text" value="{{old('valor')}}" name="valor" class="form-control"  />
                    </div>

                    <button type="submit" class="btn btn-success">
                        Enviar
                    </button>

                </form>

                <br>

                <div class="row">
                    <div class="col-md-12">

                <table class="table table-info table-responsive">

                    <thead>
                    <form id="formdata" method="get" action="/home">

                    <tr>
                        <th width="18px">
                            Pesquisar por data:
                        </th>
                        <th>

                            <input type="text" value="{{request()->get('data1')}}" class="data1" id="data1" name="data1"> até <input type="text" value="{{request()->get('data1')}}" id="data2" name="data2">
                        </th>


                        <th width="40%">

                            <button style="margin-left: 30px;" type="submit" class="btn btn-info">
                                Buscar
                        </th>

                        <th>

                          <h1>  <span class="label label-primary">{{  'R$ '.number_format($total, 2, ',', '.') }}</span></h1>



                        </th>



                    </tr>
                    </form>
                    </thead>
                </table>
                        <br>


                        <div class="table-responsive">
                <table class="table table-hover " >
                    <thead>


                    <tr>
                        <th>
                            #
                        </th>
                        {{--<th>--}}
                            {{--Produto--}}
                        {{--</th>--}}
                        <th>
                            Data pagamento
                        </th>
                        <th>
                            Tipo Pagamento
                        </th>
                        <th>
                            Valor de venda
                        </th>
                        <th>
                            Valor com taxa
                        </th>
                        <th>
                            Ação
                        </th>
                    </tr>


                    </thead>
                    <tbody>

                    @forelse($payaments as $payament)



                    <tr>
                        <td>
                            {{$payament->id}}
                        </td>
                        {{--<td>--}}
                            {{--{{$payament->nome}}--}}
                        {{--</td>--}}
                        <td>
                            {{ date( 'd/m/Y H:i:' , strtotime($payament->created_at))}}
                        </td>

                        <td>

                            @if($payament->parcelas==1)
                                Credito-Avista

                             @elseif($payament->parcelas>1)
                                Credito
                             @else
                                Debito
                             @endif

                        </td>


                        <td>

                            {{  'R$ '.number_format($payament->valorvenda, 2, ',', '.') }}


                        </td>

                        <td>

                            <span  id="tooltipex"  title="" class="alert-success"> {{ $payament->parcelas>0? ' parcelado em: ' .$payament->parcelas. ' x':'' }}</span>    {{  'R$ '.number_format($payament->valor, 2, ',', '.') }}

                            @if($payament->parcelas>1)
                                <a  class="btn" href="{{route('home.history',$payament->id)}}" data-target="#detail">Visualizar</a>

                            @endif
                            {{--<a href="{{route('home.history',$payament->id)}}">Visualizar</a>--}}


                        </td>
                        <td>


                      <a href="{{route('home.destroy',$payament->id)}}">Excluir</a>






                        </td>
                    </tr>





                    @empty
                        <tr>
                            <td colspan="11">Nenhuma pedido encontrado</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>

                    <div>
                        <div>
                            <div>

                <div class="right-align">
                    {{ $payaments->appends(request()->query())->render() }}
                </div>
            </div>
        </div>
    </div>



@endsection

<script>


    $(window).load(function(){
        $('#detail').modal('show');
    });



</script>