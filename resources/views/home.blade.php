


@extends('layouts.app')

@section('content')

    <script>

        function mostrar(){

            if(document.getElementById('credito').checked){

                document.getElementById("parcelas").style.display = "block";
            }
            else{
                document.getElementById("parcelas").style.display = "none";
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


                        <input    onclick="mostrar();" type="radio" checked {{old('tipo')==$taxas[0]['debito']?'checked':''}}  name="tipo" value="{{$taxas[0]['debito']}}"  /> Debito
                        <input id="credito" onclick="mostrar();" type="radio"  {{old('tipo')==$taxas[0]['credito']?'checked':''}} name="tipo" value="{{$taxas[0]['credito']}}"  /> Credito


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
                    <form method="get" action="/home">

                    <tr>
                        <th width="18px">
                            Pesquisar por data:
                        </th>
                        <th>

                            <input type="text" value=" {{request()->get('data1')}}" class="data1" id="data1" name="data1"> até <input type="text" value="{{request()->get('data1')}}" id="data2" name="data2">
                        </th>


                        <th width="40%">

                            <button style="margin-left: 30px;" type="submit" class="btn btn-info">
                                Buscar
                        </th>

                        <th>
                          <h1>  <span class="label label-primary">R$ {{ money_format('%n', $total ) }}</span></h1>



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
                           R$ {{ money_format('%n', $payament->valorvenda) }}


                        </td>

                        <td>
                            R$ {{ money_format('%n', $payament->valor ) }}

                            <span  id="tooltipex"  title="" class="alert-success"> {{ $payament->parcelas>0? ' parcelado em: ' .$payament->parcelas. ' vezes':'' }}</span>

                        </td>
                        <td>


                            <button class="btn btn-danger" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete">
                               Excluir
                            </button>

                            <form id="delete-form" method="post" action="{{route('home.destroy',[$payament->id])}}"
                             style="display: none" >

                                <input type="hidden" name="_method" value="delete">

                                {{csrf_field()}}

                            </form>




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
    //Javascript
    $(function()
    {
        $( "#nome" ).autocomplete({
            source: "search/autocomplete",
            minLength: 3,
            select: function(event, ui) {
                $('#q').val(ui.item.value);
            }
        });
    });
</script>